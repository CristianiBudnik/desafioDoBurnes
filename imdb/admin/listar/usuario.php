<?php
    if (!isset($pagina)) exit;
?>
<div class="card shadow">
    <div class="card-header">
        <div class="float-start">
            <h2>Cadastro de Usuário
        </div>
        <div class="float-end">
            <a href="cadastrar/usuario" class="btn btn-success">
                Novo Registro
            </a>
            <a href="listar/usuario" class="btn btn-info">
                Listar
            </a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Nome do Usuário</td>
                    <td>Opções</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    //selecionar os usuarios
                    $sql = "select * from usuario
                        order by nome";
                    //preparar para execução
                    $consulta = $pdo->prepare($sql);
                    $consulta->execute();

                    while ($dados = $consulta->fetch(PDO::FETCH_OBJ)){
                        ?>
                        <tr>
                            <td><?= $dados->id ?></td>
                            <td><?= $dados->nome ?></td>
                            <td>
                                <a href="cadastrar/usuario/<?= $dados->id ?>" class="btn btn-info btn-sm">
                                    Editar
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