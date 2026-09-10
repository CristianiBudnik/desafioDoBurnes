<div class="container p-5">
    <div class="banner mb-5 shadow">
        <img src="imgs/banner.jpeg" alr="Banner IMDB" class="w-100">
    </div>

    <h2>Destaques de Hoje:</h2>

    <div class="row">
        <?php
            $sqlDestaques = "select f.id, f.titulo, f.ano, f.original, f.capa, c.categoria
                from filme f
                inner join categoria c on (c.id = f.categoria_id)
                order by rand() limit 4";
            $consulta = $pdo->prepare($sqlDestaques);
            $consulta->execute();

            $dadosDestaques = $consulta->fetchAll(PDO::FETCH_OBJ);

            foreach ($dadosDestaques as $dados) {
                ?>
                <div class="col-12 col-md-3">
                    <div class="card shadow">
                        <img src="arquivos/<?= $dados->capa ?>" alt="<?= $dados->titulo ?>" class="w-100">
                        <div class="card-body">
                            <h3><?= $dados->titulo ?></h3>
                            <p><i><?= $dados->original ?></i> (<?= $dados->ano ?>)</p>
                            <p>Categoria: <?= $dados->categoria ?></p>
                            <p>
                                <a href="filme/<?= $dados->id ?>" title="Detalhes" class="btn btn-warning w-100">
                                    Detalhes
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
                <?php
            }
        ?>
    </div>

</div>