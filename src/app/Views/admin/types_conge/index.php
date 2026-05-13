<?= $this->extend('Layout/app') ?>

<?= $this->section('title') ?>Types de congé<?= $this->endSection() ?>
<?= $this->section('page_title') ?>Gestion des types de congé<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="content-header">
    <h5>Liste des types de congé</h5>
    <a href="<?= base_url('admin/types-conge/creer') ?>" class="btn btn--primary btn--sm">
        <i class="fas fa-plus"></i>Nouveau type
    </a>
</div>

<div class="card card-table">
    <div class="card-body">
        <?php if (empty($types)): ?>
        <div class="empty-state">
            <span class="empty-icon"><i class="fas fa-tags"></i></span>
            <p class="empty-title">Aucun type de congé.</p>
        </div>
        <?php else: ?>
        <div class="table-wrapper">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Libellé</th>
                        <th>Jours annuels</th>
                        <th>Déductible</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($types as $t): ?>
                    <tr>
                        <td><?= esc($t['libelle']) ?></td>
                        <td class="text-monospace"><?= (int) $t['jours_annuels'] ?></td>
                        <td>
                            <span class="badge badge--<?= $t['deductible'] ? 'active' : 'inactive' ?>">
                                <?= $t['deductible'] ? 'Oui' : 'Non' ?>
                            </span>
                        </td>
                        <td class="text-end">
                            <div class="actions-group justify-content-end">
                                <a href="<?= base_url('admin/types-conge/' . $t['id']) ?>" class="btn btn--ghost btn--sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="<?= base_url('admin/types-conge/supprimer/' . $t['id']) ?>" method="POST" class="d-inline">
                                    <?= csrf_field() ?>
                                    <button type="submit" class="btn btn--ghost btn--sm"
                                            onclick="return confirm('Supprimer ce type de congé ?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>
