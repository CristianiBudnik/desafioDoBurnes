<?php
    if (!isset($pagina)) exit;

    if (!empty($id)) {
        //selecionar a categoria selecionada
        $sql = "select * from categoria where id = :id limit 1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":id", $id);
        $consulta->execute();

        $dadosCategoria = $consulta->fetch(PDO::FETCH_OBJ);
    }

    $id = $dadosCategoria->id ?? NULL;
    $categoria = $dadosCategoria->categoria ?? NULL;
?>
<div class="card shadow">
    <div class="card-header">
        <div class="float-start">
            <h2>Cadastro de Categoria
        </div>
        <div class="float-end">
            <a href="cadastrar/categoria" class="btn btn-success">
                Novo Registro
            </a>
            <a href="listar/categoria" class="btn btn-info">
                Listar
            </a>
        </div>
    </div>
    <div class="card-body">
        <form name="formCadastrar" method="post" action="salvar/categoria" data-parsley-validate>
            <div class="row">
                <div class="col-12 col-md-2">
                    <label for="id">ID:</label>
                    <input type="text" name="id" id="id" class="form-control" readonly
                    value="<?= $id ?>">
                </div>
                <div class="col-12 col-md-10">
                    <label for="categoria">Nome da Categoria:</label>
                    <input type="text" name="categoria" id="categoria"
                    class="form-control" required
                    data-parsley-required-message="Preencha este campo"
                    value="<?= $categoria ?>">
                </div>
            </div>
            <br>
            <button type="submit" class="btn btn-success float-end">
                Salvar Registro
            </button>
        </form>
    </div>
</div>