<?php
    if (!isset($pagina)) exit;
?>
<div class="card shadow">
    <div class="card-header">
        <div class="float-start">
            <h2>Listagem de Categoria
        </div>
        <div class="float-end">
            <a href="cadastrar/categoria" class="btn btn-success">
                Novo Registro
            </a>
            <a href="listar/categoria" class="btn btn-info">
                Listar
            </a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Nome da Categoria</td>
                    <td>Opções</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    //selecionar as categoria
                    $sql = "select * from categoria
                        order by categoria";
                    //preparar para execução
                    $consulta = $pdo->prepare($sql);
                    $consulta->execute();

                    while ($dados = $consulta->fetch(PDO::FETCH_OBJ)){
                        ?>
                        <tr>
                            <td><?= $dados->id ?></td>
                            <td><?= $dados->categoria ?></td>
                            <td>
                                <a href="cadastrar/categoria/<?= $dados->id ?>" class="btn btn-info btn-sm">
                                    Editar
                                </a>

                                <a href="javascript:excluir(<?= $dados->id ?>)" class="btn btn-danger btn-sm">
                                    Excluir
                                </a>
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
        if (confirm("Deseja mesmo excluir?")) {
            location.href="excluir/categoria/" + id;
        }
    }
</script>