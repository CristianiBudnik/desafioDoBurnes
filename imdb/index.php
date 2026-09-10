<?php
    include "config.php";
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iMDB</title>

    <base href="http://<?= $_SERVER["SERVER_NAME"] . $_SERVER["SCRIPT_NAME"] ?>">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <link href="css/style.css" rel="stylesheet">
    <link href="imgs/icone.jpeg" rel="icon">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-dark shadow">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <img src="imgs/logo.svg" alt="IMDB" width="150px">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="filmes">Filmes</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Categorias
                        </a>
                        <ul class="dropdown-menu">
                            <?php
                                $sqlCategoria = "select * from categoria order by categoria";
                                $consultaCategoria = $pdo->prepare($sqlCategoria);
                                $consultaCategoria->execute();

                                $dadosCategoria = $consultaCategoria->fetchAll(PDO::FETCH_OBJ);

                                foreach($dadosCategoria as $dados) {
                                    ?>
                                    <li><a class="dropdown-item" href="categoria/<?= $dados->id ?>"><?= $dados->categoria ?></a></li>
                                    <?php
                                }
                            ?>
                        </ul>
                    </li>
                </ul>
                <form class="d-flex" role="search" method="post" action="buscar">
                    <input class="form-control me-2" name="busca" type="search" placeholder="Palavra-chave" aria-label="Search" />
                    <button class="btn btn-outline-warning" type="submit">Buscar</button>
                </form>
            </div>
        </div>
    </nav>

    <main>
        <?php
            if (isset($_GET["param"])) {
                $param = explode("/", $_GET["param"]);
            }

            $page = $param[0] ?? "home";
            $id = $param[1] ?? NULL;

            $page = "pages/{$page}.php";

            if (file_exists($page)) include $page;
            else include "pages/erro.php";
        ?>
    </main>

    <footer class="bg-dark p-3">
        <p class="text-center"><?= date("Y") ?> iMDB BR - Todos os direitos reservados</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>