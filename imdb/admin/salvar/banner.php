<?php
    if (!isset($pagina)) exit;

    if ($_POST) {

        $id = htmlspecialchars(trim($_POST["id"] ?? NULL));
        $ativo = htmlspecialchars(trim($_POST["ativo"] ?? 'S'));
        $descricao = trim($_POST["descricao"] ?? NULL);

        $banner = NULL;

        if (!empty($_FILES["banner"]["name"])) {

            $banner = time();
            $banner = "{$banner}.jpg";

            if (!move_uploaded_file($_FILES["banner"]["tmp_name"], "../arquivos/{$banner}")) {
                mensagem("Erro", "Erro ao copiar arquivo para o servidor", "error");
                exit;
            }

            redimensionarImagem("../arquivos/{$banner}", 1920, 800, 100);
        }

        if (empty($id)) {

            if (empty($banner)) {
                mensagem("Erro", "Selecione uma imagem para o banner", "error");
                exit;
            }

            $sql = "INSERT INTO banner (id, banner, descricao, ativo) 
                    VALUES (NULL, :banner, :descricao, :ativo)";

            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(":banner", $banner);
            $consulta->bindParam(":descricao", $descricao);
            $consulta->bindParam(":ativo", $ativo);

        } else if (empty($banner)) {
            $sql = "UPDATE banner 
                    SET descricao = :descricao, ativo = :ativo 
                    WHERE id = :id LIMIT 1";

            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(":descricao", $descricao);
            $consulta->bindParam(":ativo", $ativo);
            $consulta->bindParam(":id", $id);

        } else {
            $sql = "UPDATE banner 
                    SET banner = :banner, descricao = :descricao, ativo = :ativo 
                    WHERE id = :id LIMIT 1";

            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(":banner", $banner);
            $consulta->bindParam(":descricao", $descricao);
            $consulta->bindParam(":ativo", $ativo);
            $consulta->bindParam(":id", $id);
        }

        // Executar a consulta
        if ($consulta->execute()) {
            mensagem("Sucesso!", "Banner salvo com sucesso", "success");
        } else {
            mensagem("Erro", "Erro ao salvar banner", "error");
        }

    } else {
        mensagem("Erro", "Requisição inválida", "error");
    }
