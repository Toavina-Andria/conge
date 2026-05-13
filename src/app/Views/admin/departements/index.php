<?= $this->extend('Layout/app') ?>
<?= $this->section('title') ?>Départements<?= $this->endSection() ?>
<?= $this->section('page_title') ?>Gestion des départements<?= $this->endSection() ?>
<?= $this->section('breadcrumb') ?><a href="<?= base_url('admin') ?>">Admin</a> <i class="fas fa-chevron-right" style="font-size:.6rem"></i> Départements<?= $this->endSection() ?>
<?= $this->section('page_actions') ?>
<a href="<?= base_url('admin/departements/creer') ?>" class="btn-forest" style="padding:7px 14px;font-size:.82rem">
    <i class="fas fa-plus"></i> Nouveau département
</a>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="data-card">
    <div class="data-card-head">
        <h3>Liste des départements</h3>
        <span class="td-muted" style="font-size:.82rem"><?= count($departements) ?> département(s)</span>
    </div>
    <?php if (empty($departements)): ?>
    <div class="empty">
        <i class="fas fa-building"></i>
        <p>Aucun département.</p>
    </div>
    <?php else: ?>
    <table class="tbl">
        <thead>
            <tr><th>Nom</th><th>Description</th><th>Employés</th><th>Actions</th></tr>
        </thead>
        <tbody>
            <?php foreach ($departements as $d): ?>
            <tr>
                <td class="td-name"><?= esc($d['nom']) ?></td>
                <td class="td-muted"><?= esc($d['description'] ?? '-') ?></td>
                <td class="td-mono"><?= $nbEmployes[$d['id']] ?? 0 ?></td>
                <td>
                    <div class="action-btns">
                        <a href="<?= base_url('admin/departements/' . $d['id']) ?>" class="btn-sm btn-edit"><i class="fas fa-pencil-alt"></i> Éditer</a>
                        <form action="<?= base_url('admin/departements/supprimer/' . $d['id']) ?>" method="POST" class="d-inline" onsubmit="return confirm('Supprimer ce département ?')">
                            <?= csrf_field() ?>
                            <button type="submit" class="btn-sm btn-del"><i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>
