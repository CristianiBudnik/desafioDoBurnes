<?php
    $sql = "select f.*, c.categoria from filme f
        inner join categoria c on (c.id = f.categoria_id)
        where f.id = :id limit 1";
    $consulta = $pdo->prepare($sql);
    $consulta->bindParam(":id", $id);
    $consulta->execute();

    $dados = $consulta->fetch(PDO::FETCH_OBJ);
?>
<div class="container p-5">
    <h2><?= $dados->titulo ?></h2>
    <div class="row">
        <div class="col-12 col-md-4">
            <img src="arquivos/<?= $dados->capa ?>" class="w-100 rounded" alt="<?= $dados->titulo ?>">
        </div>
        <div class="col-12 col-md-8">
            <iframe width="100%" height="490" src="https://www.youtube.com/embed/<?= $dados->youtube ?>" class="rounded"></iframe>
        </div>
    </div>

    <p class="mt-5"><strong><?= $dados->original ?> (<?= $dados->ano ?>)</strong></p>
    <p>
        <?= $dados->sinopse ?>
    </p>
    <p>
        <a href="categoria/<?= $dados->categoria_id ?>" class="btn btn-warning btn-sm">
            Ver outros filmes de <?= $dados->categoria ?>
        </a>
    </p>
</div>