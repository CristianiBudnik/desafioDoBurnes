<?php
    if (!isset($pagina)) exit;

    if (empty($id)) {
        mensagem("Erro", "Registro inválido", "error");
    } else {
        //selecionar a capa do filme
        $sql = "select capa from filme where id = :id limit 1";
        //preparar para execução
        $consulta = $pdo->prepare($sql);
        //passar o parametro para o sql
        $consulta->bindParam(":id", $id);
        //executar
        $consulta->execute();

        //recuperar os dados
        $dadosFilme = $consulta->fetch(PDO::FETCH_OBJ);
        $capa = "../arquivos/{$dadosFilme->capa}";

        //excluir o filme
        $sql = "delete from filme where id = :id limit 1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":id", $id);
        
        if ($consulta->execute()) {
            //excluir o arquivo
            unlink($capa);
            mensagem("Sucesso","Registro excluído","success");
        } else {
            mensagem("Erro","Erro ao excluir","error");
        }

    }
