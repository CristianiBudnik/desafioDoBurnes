<?php
    if (!isset($pagina)) exit;

    //verificar se foi dado POST
    if ($_POST) {

        //recuperar as variaveis
        $id = htmlspecialchars(trim($_POST["id"] ?? NULL));
        $titulo = htmlspecialchars(trim($_POST["titulo"] ?? NULL));
        $original = htmlspecialchars(trim($_POST["original"] ?? NULL));
        $ano = htmlspecialchars(trim($_POST["ano"] ?? NULL));
        $categoria_id = htmlspecialchars(trim($_POST["categoria_id"] ?? NULL));
        $youtube = htmlspecialchars(trim($_POST["youtube"] ?? NULL));
        $sinopse = htmlspecialchars(trim($_POST["sinopse"] ?? NULL));

        $capa = NULL;

        if (!empty($_FILES["capa"]["name"])) {

            $capa = time();
            $capa = "{$capa}.jpg";
            if (!move_uploaded_file($_FILES["capa"]["tmp_name"], "../arquivos/{$capa}")) {
                mensagem("Erro", "Erro ao copiar arquivo para o servidor","error");
            }

            redimensionarImagem("../arquivos/{$capa}", 600, 800, 100);

        }

        //se o id estiver vazio - insert
        //se o campo capa estiver vazio - update sem a capa
        //senao update com a capa
        if (empty($id)) {
            $sql = "insert into filme 
            (id, titulo, original, ano, categoria_id,
            youtube, sinopse, capa) values
            (NULL, :titulo, :original, :ano, :categoria_id, :youtube, :sinopse, :capa)";

            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(":titulo", $titulo);
            $consulta->bindParam(":original", $original);
            $consulta->bindParam(":ano", $ano);
            $consulta->bindParam(":categoria_id", $categoria_id);
            $consulta->bindParam(":youtube", $youtube);
            $consulta->bindParam(":sinopse", $sinopse);
            $consulta->bindParam(":capa", $capa);

        } else if (empty($capa)) {

            $sql = "update filme set titulo = :titulo,
            original = :original, ano = :ano, categoria_id = :categoria_id, youtube = :youtube, sinopse = :sinopse
            where id = :id limit 1";

            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(":titulo", $titulo);
            $consulta->bindParam(":original", $original);
            $consulta->bindParam(":ano", $ano);
            $consulta->bindParam(":categoria_id", $categoria_id);
            $consulta->bindParam(":youtube", $youtube);
            $consulta->bindParam(":sinopse", $sinopse);
            $consulta->bindParam(":id", $id);

        } else {

            $sql = "update filme set titulo = :titulo,
            original = :original, ano = :ano, categoria_id = :categoria_id, youtube = :youtube, sinopse = :sinopse, capa = :capa
            where id = :id limit 1";

            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(":capa", $capa);
            $consulta->bindParam(":titulo", $titulo);
            $consulta->bindParam(":original", $original);
            $consulta->bindParam(":ano", $ano);
            $consulta->bindParam(":categoria_id", $categoria_id);
            $consulta->bindParam(":youtube", $youtube);
            $consulta->bindParam(":sinopse", $sinopse);
            $consulta->bindParam(":id", $id);

        }

        //verificar se vai executar
        if ($consulta->execute()){
            mensagem("Sucesso!","Registro salvo","success");
        } else {
            mensagem("Erro","Erro ao gravar","error");
        }

    } else {
        mensagem("Erro","Requisição inválida", "error");
    }