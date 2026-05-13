<?= $this->extend('Layout/app') ?>

<?= $this->section('title') ?>Départements<?= $this->endSection() ?>
<?= $this->section('page_title') ?>Gestion des départements<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0">Liste des départements</h5>
    <a href="<?= base_url('admin/departements/creer') ?>" class="btn btn-primary btn-sm">
        <i class="fas fa-plus me-1"></i>Nouveau département
    </a>
</div>

<div class="card shadow">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Employés</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($departements)): ?>
                <tr><td colspan="4" class="text-center text-muted py-3">Aucun département.</td></tr>
                <?php else: ?>
                <?php foreach ($departements as $d): ?>
                <tr>
                    <td><?= esc($d['nom']) ?></td>
                    <td><?= esc($d['description'] ?? '-') ?></td>
                    <td><?= $nbEmployes[$d['id']] ?? 0 ?></td>
                    <td class="text-end">
                        <a href="<?= base_url('admin/departements/' . $d['id']) ?>" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="<?= base_url('admin/departements/supprimer/' . $d['id']) ?>" method="POST" class="d-inline">
                            <?= csrf_field() ?>
                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                    onclick="return confirm('Supprimer ce département ?')">
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
