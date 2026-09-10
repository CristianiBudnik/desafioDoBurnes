<?php
    if (!isset($pagina)) exit;

    if (!empty($id)) {
        $sql = "select * from usuario where id = :id limit 1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":id", $id);
        $consulta->execute();
        $dadosUsuario = $consulta->fetch(PDO::FETCH_OBJ);
    }

    $id = $dadosUsuario->id ?? NULL;
    $nome = $dadosUsuario->nome ?? NULL;
    $email = $dadosUsuario->email ?? NULL;
    $salario = $dadosUsuario->salario ?? NULL;
    $cpf = $dadosUsuario->cpf ?? NULL;
    $datanascimento = $dadosUsuario->datanascimento ?? NULL;
    $ativo = $dadosUsuario->ativo ?? NULL;
?>
<div class="card shadow">
    <div class="card-header">
        <div class="float-start">
            <h2>Cadastro de Usuário
        </div>
        <div class="float-end">
            <a href="cadastrar/usuario" class="btn btn-success">
                Novo Registro
            </a>
            <a href="listar/usuario" class="btn btn-info">
                Listar
            </a>
        </div>
    </div>
    <div class="card-body">
        <form name="formCadastro" method="post" action="salvar/usuario"
        data-parsley-validate>
            <div class="row">
                <div class="col-12 col-md-1">
                    <label for="id">ID:</label>
                    <input type="text" name="id" id="id" class="form-control"
                    value="<?= $id ?>" readonly>
                </div>
                <div class="col-12 col-md-6">
                    <label for="nome">Nome do Usuário:</label>
                    <input type="text" name="nome" id="nome" class="form-control"
                    value="<?= $nome ?>" required
                    data-parsley-required-message="Preencha este campo">
                </div>
                <div class="col-12 col-md-5">
                    <label for="email">E-mail do Usuário:</label>
                    <input type="email" name="email" id="email" class="form-control"
                    value="<?= $email ?>" required
                    data-parsley-required-message="Preencha este campo"
                    data-parsley-type-message="Digite um e-mail válido">
                </div>
                <div class="col-12 col-md-6">
                    <label for="senha">Digite uma senha:</label>
                    <input type="password" name="senha" id="senha" class="form-control"
                    required data-parsley-required-message="Preencha a senha">
                </div>
                <div class="col-12 col-md-6">
                    <label for="senha2">Redigite a senha:</label>
                    <input type="password" name="senha2" id="senha2" class="form-control"
                    required data-parsley-required-message="Preencha a senha"
                    data-parsley-equalto="#senha"
                    data-parsley-equalto-message="As senhas não são iguais">
                </div>
                <div class="col-12 col-md-3">
                    <label for="cpf">CPF:</label>
                    <input type="text" name="cpf" id="cpf" class="form-control"
                    required data-parsley-required-message="Preencha o campo"
                    value="<?= $cpf ?>">
                </div>
                <div class="col-12 col-md-3">
                    <label for="salario">Salário:</label>
                    <input type="text" name="salario" id="salario" class="form-control"
                    required data-parsley-required-message="Preencha o campo"
                    value="<?= $salario ?>">
                </div>
                <div class="col-12 col-md-3">
                    <label for="datanascimento">Data de Nascimento:</label>
                    <input type="text" name="datanascimento" id="datanascimento""
                    class="form-control" required
                    data-parsley-required-message="Preencha o campo"
                    value="<?= $datanascimento ?>">
                </div>
                <div class="col-12 col-md-3">
                    <label for="ativo">Ativo:</label>
                    <select name="ativo" id="ativo" class="form-control"
                    required data-parsley-required-message="Selecione">
                        <option value=""></option>
                        <option value="Sim">Sim</option>
                        <option value="Não">Não</option>
                    </select>
                    <script>
                        $("#ativo").val("<?= $ativo ?>");
                    </script>
                </div>
            </div>
            <br>
            <button type="submit" class="btn btn-success float-end">
                Salvar Registro
            </button>
        </form>
    </div>
</div>
<script>
    $("#cpf").inputmask('999.999.999-99');
    $("#datanascimento").inputmask("99/99/9999");
    $("#salario").mask('000.000,00', {
        reverse: true
    });
</script>