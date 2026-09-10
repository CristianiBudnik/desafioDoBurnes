<?php
if (!isset($pagina)) exit;
?>
<div class="card shadow">
    <div class="card-header">
        <div class="float-start">
            <h2>Listagem de Filme</h2>
        </div>
        <div class="float-end">
            <a href="cadastrar/filme" class="btn btn-success">
                Novo Registro
            </a>
            <a href="listar/filme" class="btn btn-info">
                Listar
            </a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <td>Imagem</td>
                    <td>Título do Filme</td>
                    <td>Categoria</td>
                    <td>Opções</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "select f.id, f.titulo, c.categoria, f.capa 
                        from filme f
                        inner join categoria c on (c.id = f.categoria_id)
                        order by f.titulo";
                //preparar para execução
                $consulta = $pdo->prepare($sql);
                //executar a consulta
                $consulta->execute();

                //recebimento dos dados
                $dadosFilmes = $consulta->fetchAll(PDO::FETCH_OBJ);

                foreach ($dadosFilmes as $dados) {
                ?>
                    <tr>
                        <td>
                            <img src="../arquivos/<?= $dados->capa ?>"
                                alt="<?= $dados->titulo ?>" width="75px">
                        </td>
                        <td>
                            <?= $dados->titulo ?>
                        </td>
                        <td>
                            <?= $dados->categoria ?>
                        </td>
                        <td>
                            <a href="cadastrar/filme/<?= $dados->id ?>"
                                class="btn btn-success btn-sm">Editar</a>

                            <a href="javascript:excluir(<?= $dados->id ?>)"
                                class="btn btn-danger btn-sm">Excluir</a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    function excluir(id) {
        Swal.fire({
            title: "Você tem certeza de que deseja excluir este registro?",
            showCancelButton: true,
            confirmButtonText: "Excluir",
            cancelButtonText: "Cancelar"
        }).then((result) => {
            
            if (result.isConfirmed) 
                location.href="excluir/filme/"+id;
            
        });
    }
</script>