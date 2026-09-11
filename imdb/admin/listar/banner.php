<?php
if (!isset($pagina)) exit;
?>
<div class="card shadow">
    <div class="card-header">
        <div class="float-start">
            <h2>Listagem de Banners</h2>
        </div>
        <div class="float-end">
            <a href="cadastrar/banner" class="btn btn-success">
                Novo Registro
            </a>
            <a href="listar/banner" class="btn btn-info">
                Listar
            </a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped align-middle">
            <thead>
                <tr>
                    <th style="width: 120px;">Banner</th>
                    <th>Descrição</th>
                    <th style="width: 100px;">Ativo</th>
                    <th style="width: 160px;">Opções</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT id, banner, descricao, ativo 
                        FROM banner 
                        ORDER BY id DESC";

                $consulta = $pdo->prepare($sql);
                $consulta->execute();

                $dadosBanners = $consulta->fetchAll(PDO::FETCH_OBJ);

                foreach ($dadosBanners as $dados) {
                ?>
                    <tr>
                        <td>
                            <?php if (!empty($dados->banner)): ?>
                                <img src="../arquivos/<?= $dados->banner ?>" 
                                     alt="Banner" class="img-fluid rounded" style="max-height: 60px;">
                            <?php else: ?>
                                <span class="badge bg-secondary">Sem imagem</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?= strip_tags($dados->descricao) ?>
                        </td>
                        <td>
                            <?= ($dados->ativo == 'S') ? '<span class="badge bg-success">Sim</span>' : '<span class="badge bg-danger">Não</span>' ?>
                        </td>
                        <td>
                            <a href="cadastrar/banner/<?= $dados->id ?>" 
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
        if (confirm("Deseja mesmo excluir?")) {
            location.href="excluir/banner/" + id;
        }
    }
</script>
