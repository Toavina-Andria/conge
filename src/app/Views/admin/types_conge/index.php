<?= $this->extend('Layout/app') ?>

<?= $this->section('title') ?>Types de congé<?= $this->endSection() ?>
<?= $this->section('page_title') ?>Gestion des types de congé<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0">Liste des types de congé</h5>
    <a href="<?= base_url('admin/types-conge/creer') ?>" class="btn btn-primary btn-sm">
        <i class="fas fa-plus me-1"></i>Nouveau type
    </a>
</div>

<div class="card shadow">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Libellé</th>
                    <th>Jours annuels</th>
                    <th>Déductible</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($types)): ?>
                <tr><td colspan="4" class="text-center text-muted py-3">Aucun type de congé.</td></tr>
                <?php else: ?>
                <?php foreach ($types as $t): ?>
                <tr>
                    <td><?= esc($t['libelle']) ?></td>
                    <td><?= (int) $t['jours_annuels'] ?></td>
                    <td>
                        <?php if ($t['deductible']): ?>
                            <span class="badge bg-success">Oui</span>
                        <?php else: ?>
                            <span class="badge bg-secondary">Non</span>
                        <?php endif; ?>
                    </td>
                    <td class="text-end">
                        <a href="<?= base_url('admin/types-conge/' . $t['id']) ?>" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="<?= base_url('admin/types-conge/supprimer/' . $t['id']) ?>" method="POST" class="d-inline">
                            <?= csrf_field() ?>
                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                    onclick="return confirm('Supprimer ce type de congé ?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
