<?php
    if (!isset($pagina)) exit;

    //verificar se esta vindo um id
    if (!empty($id)) {
        //sql para selecionar o filme daquele id
        $sql = "select * from filme
            where id = :id limit 1";
        //preparar para execução
        $consulta = $pdo->prepare($sql);
        //passar parametro id
        $consulta->bindParam(":id", $id);
        //executar o sql
        $consulta->execute();

        //recuperar os dados do resultado
        $dadosFilme = $consulta->fetch(PDO::FETCH_OBJ);
    }

    $id = $dadosFilme->id ?? NULL;
    $titulo = $dadosFilme->titulo ?? NULL;
    $original = $dadosFilme->original ?? NULL;
    $ano = $dadosFilme->ano ?? NULL;
    $categoria_id = $dadosFilme->categoria_id ?? NULL;
    $sinopse = $dadosFilme->sinopse ?? NULL;
    $youtube = $dadosFilme->youtube ?? NULL;
?>
<div class="card shadow">
    <div class="card-header">
        <div class="float-start">
            <h2>Cadastro de Filme</h2>
        </div>
        <div class="float-end">
            <a href="cadastrar/filme" class="btn btn-success">
                Novo Registro
            </a>
            <a href="listar/filme" class="btn btn-info">
                Listar
            </a>
        </div>
    </div>
    <div class="card-body">
        <form name="formCadastro" method="post"
        action="salvar/filme" data-parsley-validate
        enctype="multipart/form-data">
            <div class="row">
                <div class="col-12 col-md-2">
                    <label for="id">ID:</label>
                    <input type="text" name="id"
                    id="id" class="form-control"
                    readonly value="<?= $id ?>">
                </div>
                <div class="col-12 col-md-10">
                    <label for="titulo">Título do Filme:</label>
                    <input type="text" name="titulo"
                    id="titulo" class="form-control"
                    required value="<?= $titulo ?>"
                    data-parsley-required-message="Preencha este campo">
                </div>
                <div class="col-12 col-md-10">
                    <label for="original">Título Original:</label>
                    <input type="text" name="original"
                    id="original" class="form-control"
                    required value="<?= $original ?>"
                    data-parsley-required-message="Preencha este campo">
                </div>
                <div class="col-12 col-md-2">
                    <label for="ano">Ano Lançamento:</label>
                    <input type="number" name="ano"
                    id="ano" class="form-control"
                    required value="<?= $ano ?>"
                    data-parsley-required-message="Preencha este campo">
                </div>
                <div class="col-12 col-md-4">
                    <label for="categoria_id">Categoria:</label>
                    <select name="categoria_id"
                    id="categoria_id" class="form-control" required
                    data-parsley-required-message="Selecione uma categoria">
                        <option value=""></option>
                        <?php
                            //selecionar as categorias
                            $sql = "select * from categoria order by categoria";
                            $consulta = $pdo->prepare($sql);
                            $consulta->execute();
                           
                            $dadosCategoria = $consulta->fetchAll(PDO::FETCH_OBJ);

                            foreach($dadosCategoria as $dados) {
                                echo "<option value='{$dados->id}'>{$dados->categoria}</option>";
                            }
                        ?>
                    </select>
                    <script>
                        $("#categoria_id").val(<?= $categoria_id ?>);
                    </script>
                </div>
                <div class="col-12 col-md-4">
                    <label for="youtube">Código Youtube:</label>
                    <input type="text" name="youtube"
                    id="youtube" class="form-control"
                    required value="<?= $youtube ?>"
                    data-parsley-required-message="Preenche este campo">
                </div>
                <div class="col-12 col-md-4">
                    <label for="capa">Capa do Filme:</label>
                    <input type="file" name="capa"
                    id="capa" class="form-control"
                    accept=".jpg">
                </div>
                <div class="col-12 col-md-12">
                    <label for="sinopse">Sinopse do Filme:</label>
                    <textarea name="sinopse" id="sinopse"
                    class="form-control text" required
                    data-parsley-required-message="Preencha este campo"><?= $sinopse ?></textarea>
                </div>
            </div>

            <br>
            <button type="submit" class="btn btn-success float-end">Salvar Dados</button>
        </form>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.text').summernote();
    });
</script>