<?php
    if(!isset($pagina)) exit;

    if(!empty($id)) {
        $sql = "select * from banner where id = :id limit 1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":id", $id);
        $consulta->execute();

        $dadosBanner = $consulta->fetch(PDO::FETCH_OBJ);
    }

    $id = $dadosBanner->id ?? NULL;
    $banner = $dadosBanner->banner ?? NULL;
    $descricao = $dadosBanner->descricao ?? NULL;
    $ativo = $dadosBanner->ativo ?? NULL;
?>

<div class="card shadow">
    <div class="card-header">
        <div class="float-start">
            <h2>Cadastro de Banner</h2>
        </div>
        <div class="float-end">
            <a href="cadastrar/banner" class="btn btn-success">Novo Registro</a>
            <a href="listar/banner" class="btn btn-info">Listar</a>
        </div>
    </div>
    <div class="card-body">
        <form name="formCadastrar" method="post" action="salvar/banner" data-parsley-validate enctype="multipart/form-data">
            <div class="row">
                <div class="col-12 col-md-2">
                    <label for="id">ID:</label>
                    <input type="text" name="id" id="id" class="form-control" readonly value="<?= $id ?>">
                </div>
                <div class="col-12 col-md-6">
                    <label for="banner">Banner:</label>
                    <input type="file" name="banner" id="banner" class="form-control" 
                    <?= empty($id) ? 'required data-parsley-required-message="Escolha um banner"' : '' ?>>
                </div>
                <div class="col-12 col-md-4">
                    <label for="ativo">Ativo:</label>
                    <select name="ativo" id="ativo" class="form-control" required>
                        <option value="S">Sim</option>
                        <option value="N">Não</option>
                    </select>
                </div>
            </div>
            <div class="col-12 col-md-12">
                    <label for="descricao">Descrição:</label>
                    <textarea name="descricao" id="descricao"
                    class="form-control text" required
                    data-parsley-required-message="Preencha este campo"><?=$descricao ?></textarea>
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