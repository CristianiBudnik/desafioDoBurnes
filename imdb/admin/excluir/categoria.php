<?php
    if (!isset($pagina)) exit;

    //verificar se existe o ID
    if (empty($id)) {
        echo "<script>alert('Registro inválido');history.back();</script>";
    } else {

        //verificar se já existe um filme cadastrado com a categoria
        $sqlFilme = "select id from filme 
            where categoria_id = :id limit 1";
        $consulta = $pdo->prepare($sqlFilme);
        $consulta->bindParam(":id", $id);
        $consulta->execute();

        $dadosFilme = $consulta->fetch(PDO::FETCH_OBJ);

        if (!empty($dadosFilme->id)) {
            echo "<script>alert('Não é possível excluir esta categoria, pois ela possui filmes relacionados');history.back();</script>";
        } else {
            //excluir a categoria
            $sqlCategoria = "delete from categoria 
                where id = :id limit 1";
            $consulta = $pdo->prepare($sqlCategoria);
            $consulta->bindParam(":id", $id);

            if ($consulta->execute()) {
                echo "<script>location.href='listar/categoria';</script>";
            } else {
                echo "<script>alert('Erro ao excluir');history.back();</script>";
            }
        }

    }