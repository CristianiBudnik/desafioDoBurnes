<?php
    //iniciar sessao
    session_start();
    //conectar no banco
    include "../config.php";
    include "functions.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrativo</title>

    <base href="http://localhost/2ads/imdb/admin/">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="css/summernote-bs5.min.css"
    rel="stylesheet">
    <link href="css/sweetalert2.min.css"
    rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/jquery.inputmask.min.js"></script>
    <script src="js/parsley.min.js"></script>
    <script src="js/summernote-bs5.min.js"></script>
    <script src="js/sweetalert2.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
</head>
<body>
    <?php
        //verficar se nao foi dado POST e se esta logado
        if ((!$_POST) and (!isset($_SESSION["imdb"]))) {
            //incluir o arquivo do login
            include "pages/login.php";
        }
        //verificar se foi dado post e se esta logao
        else if (($_POST) and (!isset($_SESSION["imdb"]))) {
            //verificar se o email e senha estao corretos

            //recuperar os dados digitados
            $email = trim($_POST["email"] ?? NULL);
            $senha = trim($_POST["senha"] ?? NULL);

            //verifico se os dados estao corretos
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "<script>alert('E-mail inválido');history.back();</script>";
            } else {
                //buscar no banco o usuário com o e-mail
                $sql = "select * from usuario
                    where email = :email 
                    limit 1";
                //preparar para seu executado
                $consulta = $pdo->prepare($sql);
                //enviar o parametro
                $consulta->bindParam(":email", $email);
                //executo
                $consulta->execute();

                //recuperar os dados
                $dadosUsuario = $consulta->fetch(PDO::FETCH_OBJ);
                
                //verificar se existe usuario
                if (empty($dadosUsuario->id)) {
                    echo "<script>alert('Dados inválidos');history.back();</script>";
                }
                //verificar se a senha é verdade
                else if (!password_verify($senha, $dadosUsuario->senha)) {
                    echo "<script>alert('Dados inválidos');history.back();</script>";
                }
                else {
                    //registrar a variavel na sessao
                    $_SESSION["imdb"] = array(
                        "id" => $dadosUsuario->id,
                        "nome" => $dadosUsuario->nome,
                        "email" => $dadosUsuario->email
                    );
                    //redirecionar para home
                    echo "<script>location.href='home';</script>";
                }

            }
        }
        //mostrar a tela do sistema
        else {
            ?>
            <nav class="navbar navbar-expand-lg bg-dark">
                <div class="container-fluid">
                    <a class="navbar-brand" href="index.php">
                        <img src="../imgs/logo.svg"
                        alt="Logo Painel" width="130px">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cadastrar/categoria">Categoria</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cadastrar/filme">Filme</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cadastrar/usuario">Usuário</a>
                        </li>
                    </ul>
                    <div class="d-flex">
                        Olá 
                        <?= $_SESSION["imdb"]["nome"] ?>
                        -
                        <a href="sair.php" title="Sair">Sair</a>
                    </div>
                    </div>
                </div>
                </nav>
                <main class="container mt-5 mb-5">
                    <?php
                        // cadastrar/filme, listar/categoria
                        $param = $_GET["param"] ?? "pages/home";
                        //separar por / a strint $param
                        $param = explode("/", $param);

                        //print_r($param);

                        $pasta = $param[0] ?? "pages";
                        $arquivo = $param[1] ?? "home";
                        $id = $param[2] ?? NULL;

                        //variavel da pagina
                        $pagina = "{$pasta}/{$arquivo}.php";

                        //verificar se o arquivo existe
                        if (file_exists($pagina)) {
                            include $pagina;
                        } else {
                            include "pages/erro.php";
                        }
                    ?>
                </main>
            <?php
        }
    ?>
</body>
</html>
