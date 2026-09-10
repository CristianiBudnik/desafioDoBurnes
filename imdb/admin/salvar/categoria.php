<?php
    if (!isset($pagina)) exit;

    //verificar se foi dado um POST
    if ($_POST) {

        //recuperar as variaveis enviadas do form
        $categoria = htmlspecialchars(trim($_POST["categoria"] ?? NULL));
        $id = htmlspecialchars(trim($_POST["id"] ?? NULL));

        if (empty($categoria)) {
            echo "<script>alert('Preencha a categoria');history.back();</script>";
        } else if (empty($id)) {
            //insert
            $sql = "insert into categoria (id, categoria)
                values (NULL, :categoria)";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(":categoria", $categoria);
        } else {
            //update
            $sql = "update categoria set categoria = :categoria
                where id = :id limit 1";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(":categoria", $categoria);
            $consulta->bindParam(":id", $id);
        }

        if ($consulta->execute()) {
            echo "<script>alert('Salvo com sucesso!');location.href='listar/categoria';</script>";
        } else {
            echo "<script>alert('Erro ao salvar');history.back();</script>";
        }

    } else {
        //erro
        echo "<script>alert('Requisição inválida');history.back();</script>";
    }