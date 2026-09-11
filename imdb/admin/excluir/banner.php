<?php
    if (!isset($pagina)) exit;

    if (empty($id)) {
        mensagem("Erro", "Registro inválido", "error");
    } else {

        $sql = "SELECT banner FROM banner WHERE id = :id LIMIT 1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":id", $id);
        $consulta->execute();

        $dadosBanner = $consulta->fetch(PDO::FETCH_OBJ);

        $sqlDelete = "DELETE FROM banner WHERE id = :id LIMIT 1";
        $consultaDelete = $pdo->prepare($sqlDelete);
        $consultaDelete->bindParam(":id", $id);
        
        if ($consultaDelete->execute()) {
            if (!empty($dadosBanner->banner)) {
                $caminhoArquivo = "../arquivos/{$dadosBanner->banner}";
                if (file_exists($caminhoArquivo)) {
                    unlink($caminhoArquivo);
                }
            }

            mensagem("Sucesso", "Registro excluído com sucesso", "success");
        } else {
            mensagem("Erro", "Erro ao excluir registro", "error");
        }
    }
