<?php
    //iniciar a sessao
    session_start();
    //apagar a sessao
    unset($_SESSION["imdb"]);
    //redireciono para o index
    echo "<script>location.href='index.php'</script>";
