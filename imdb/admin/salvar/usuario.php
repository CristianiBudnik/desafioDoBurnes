<?php
    if (!isset($pagina)) exit;

    // Verificar se foi enviado via POST
    if ($_POST) {
        $id             = trim($_POST["id"] ?? "");
        $nome           = trim($_POST["nome"] ?? "");
        $email          = trim($_POST["email"] ?? "");
        $senha          = trim($_POST["senha"] ?? "");
        $senha2         = trim($_POST["senha2"] ?? "");
        $cpf            = trim($_POST["cpf"] ?? "");
        $salario        = trim($_POST["salario"] ?? "");
        $datanascimento = trim($_POST["datanascimento"] ?? "");
        $ativo          = trim($_POST["ativo"] ?? "");

        // Validações básicas de campos vazios
        if (empty($nome) || empty($email) || empty($cpf) || empty($salario) || empty($datanascimento) || empty($ativo)) {
            mensagem("Erro", "Por favor, preencha todos os campos obrigatórios.", "error");
            exit;
        }

        // Validação de e-mail
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            mensagem("Erro", "E-mail inválido.", "error");
            exit;
        }

        // Validação de CPF
        if (!validarCPF($cpf)) {
            mensagem("Erro", "CPF inválido.", "error");
            exit;
        }

        // Verificação de unicidade do e-mail
        if (empty($id)) {
            $sqlEmail = "select id from usuario where email = :email limit 1";
            $consEmail = $pdo->prepare($sqlEmail);
            $consEmail->bindParam(":email", $email);
        } else {
            $sqlEmail = "select id from usuario where email = :email and id <> :id limit 1";
            $consEmail = $pdo->prepare($sqlEmail);
            $consEmail->bindParam(":email", $email);
            $consEmail->bindParam(":id", $id);
        }
        $consEmail->execute();
        if ($consEmail->fetch()) {
            mensagem("Erro", "Este e-mail já está cadastrado para outro usuário.", "error");
            exit;
        }

        // Formatação do Salário (ex: "3.500,00" -> 3500.00)
        $salarioFormatado = str_replace(".", "", $salario);
        $salarioFormatado = str_replace(",", ".", $salarioFormatado);
        $salarioFormatado = (float) $salarioFormatado;

        // Formatação da Data de Nascimento (ex: "22/07/1980" -> "1980-07-22")
        $dataPartes = explode("/", $datanascimento);
        if (count($dataPartes) === 3) {
            $dataSql = "{$dataPartes[2]}-{$dataPartes[1]}-{$dataPartes[0]}";
        } else {
            $dataSql = $datanascimento;
        }

        // INSERT (Novo Usuário)
        if (empty($id)) {
            if (empty($senha)) {
                mensagem("Erro", "A senha é obrigatória para novo cadastro.", "error");
                exit;
            }

            if ($senha !== $senha2) {
                mensagem("Erro", "As senhas digitadas não coincidem.", "error");
                exit;
            }

            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

            $sql = "insert into usuario (id, nome, email, senha, cpf, salario, datanascimento, ativo)
                    values (NULL, :nome, :email, :senha, :cpf, :salario, :datanascimento, :ativo)";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(":nome", $nome);
            $consulta->bindParam(":email", $email);
            $consulta->bindParam(":senha", $senhaHash);
            $consulta->bindParam(":cpf", $cpf);
            $consulta->bindParam(":salario", $salarioFormatado);
            $consulta->bindParam(":datanascimento", $dataSql);
            $consulta->bindParam(":ativo", $ativo);

        } else {
            // UPDATE (Edição de Usuário)
            if (!empty($senha)) {
                if ($senha !== $senha2) {
                    mensagem("Erro", "As senhas digitadas não coincidem.", "error");
                    exit;
                }

                $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

                $sql = "update usuario set nome = :nome, email = :email, senha = :senha,
                        cpf = :cpf, salario = :salario, datanascimento = :datanascimento, ativo = :ativo
                        where id = :id limit 1";
                $consulta = $pdo->prepare($sql);
                $consulta->bindParam(":nome", $nome);
                $consulta->bindParam(":email", $email);
                $consulta->bindParam(":senha", $senhaHash);
                $consulta->bindParam(":cpf", $cpf);
                $consulta->bindParam(":salario", $salarioFormatado);
                $consulta->bindParam(":datanascimento", $dataSql);
                $consulta->bindParam(":ativo", $ativo);
                $consulta->bindParam(":id", $id);
            } else {
                // Atualiza sem alterar a senha
                $sql = "update usuario set nome = :nome, email = :email,
                        cpf = :cpf, salario = :salario, datanascimento = :datanascimento, ativo = :ativo
                        where id = :id limit 1";
                $consulta = $pdo->prepare($sql);
                $consulta->bindParam(":nome", $nome);
                $consulta->bindParam(":email", $email);
                $consulta->bindParam(":cpf", $cpf);
                $consulta->bindParam(":salario", $salarioFormatado);
                $consulta->bindParam(":datanascimento", $dataSql);
                $consulta->bindParam(":ativo", $ativo);
                $consulta->bindParam(":id", $id);
            }
        }

        if ($consulta->execute()) {
            mensagem("Sucesso!", "Usuário salvo com sucesso.", "success", "listar/usuario");
        } else {
            mensagem("Erro", "Não foi possível salvar o usuário.", "error");
        }

    } else {
        mensagem("Erro", "Requisição inválida.", "error");
    }
