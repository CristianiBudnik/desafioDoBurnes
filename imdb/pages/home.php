<div class="container p-5">
    <?php
        $sqlBanner = "SELECT banner, descricao FROM banner WHERE ativo = 'S' ORDER BY id DESC";
        $consultaBanner = $pdo->prepare($sqlBanner);
        $consultaBanner->execute();
        $banners = $consultaBanner->fetchAll(PDO::FETCH_OBJ);

        if (!empty($banners)):
    ?>
        <div id="carouselBanners" class="carousel slide mb-5 shadow" data-bs-ride="carousel">
            <div class="carousel-inner rounded">
                <?php foreach ($banners as $index => $b): ?>
                    <div class="carousel-item <?= ($index === 0) ? 'active' : '' ?>">
                        <img src="arquivos/<?= $b->banner ?>" class="d-block w-100" alt="Banner">
                    </div>
                <?php endforeach; ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselBanners" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselBanners" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
            </button>
        </div>
    <?php else: ?>
        <div class="banner mb-5 shadow">
            <img src="imgs/banner.jpeg" alt="Banner Padrão" class="w-100 rounded">
        </div>
    <?php endif; ?>

    <h2>Destaques de Hoje:</h2>

    <div class="row">
        <?php
            $sqlDestaques = "SELECT f.id, f.titulo, f.ano, f.original, f.capa, c.categoria
                FROM filme f
                INNER JOIN categoria c ON (c.id = f.categoria_id)
                ORDER BY RAND() LIMIT 4";
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
