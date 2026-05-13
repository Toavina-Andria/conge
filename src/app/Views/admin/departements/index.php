<?= $this->extend('Layout/app') ?>

<?= $this->section('title') ?>Départements<?= $this->endSection() ?>
<?= $this->section('page_title') ?>Gestion des départements<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="content-header">
    <h5>Liste des départements</h5>
    <a href="<?= base_url('admin/departements/creer') ?>" class="btn btn--primary btn--sm">
        <i class="fas fa-plus"></i>Nouveau département
    </a>
</div>

<div class="card card-table">
    <div class="card-body">
        <?php if (empty($departements)): ?>
        <div class="empty-state">
            <span class="empty-icon"><i class="fas fa-building"></i></span>
            <p class="empty-title">Aucun département.</p>
        </div>
        <?php else: ?>
        <div class="table-wrapper">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Description</th>
                        <th>Employés</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($departements as $d): ?>
                    <tr>
                        <td><?= esc($d['nom']) ?></td>
                        <td><?= esc($d['description'] ?? '-') ?></td>
                        <td class="text-monospace"><?= $nbEmployes[$d['id']] ?? 0 ?></td>
                        <td class="text-end">
                            <div class="actions-group justify-content-end">
                                <a href="<?= base_url('admin/departements/' . $d['id']) ?>" class="btn btn--ghost btn--sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="<?= base_url('admin/departements/supprimer/' . $d['id']) ?>" method="POST" class="d-inline">
                                    <?= csrf_field() ?>
                                    <button type="submit" class="btn btn--ghost btn--sm"
                                            onclick="return confirm('Supprimer ce département ?')">
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
