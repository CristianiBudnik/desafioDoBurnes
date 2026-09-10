<?php
    //header para definir que é um JSON
    header('Content-Type: application/json; charset=utf-8');

    //arquivo de conexão com banco
    require "../config.php";

    //sql a ser executado
    $sql = "select * from filme
        order by titulo";
    //preparar o sql para execução
    $consulta = $pdo->prepare($sql);
    //executar
    $consulta->execute();

    //recuperar os dados do SQL
    $dadosFilmes = $consulta->fetchAll(PDO::FETCH_OBJ);

    echo json_encode($dadosFilmes);
    