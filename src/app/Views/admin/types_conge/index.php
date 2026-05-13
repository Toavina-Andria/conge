<?= $this->extend('Layout/app') ?>
<?= $this->section('title') ?>Types de congé<?= $this->endSection() ?>
<?= $this->section('page_title') ?>Gestion des types de congé<?= $this->endSection() ?>
<?= $this->section('breadcrumb') ?><a href="<?= base_url('admin') ?>">Admin</a> <i class="fas fa-chevron-right" style="font-size:.6rem"></i> Types de congé<?= $this->endSection() ?>
<?= $this->section('page_actions') ?>
<a href="<?= base_url('admin/types-conge/creer') ?>" class="btn-forest" style="padding:7px 14px;font-size:.82rem">
    <i class="fas fa-plus"></i> Nouveau type
</a>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="data-card">
    <div class="data-card-head">
        <h3>Liste des types de congé</h3>
        <span class="td-muted" style="font-size:.82rem"><?= count($types) ?> type(s)</span>
    </div>
    <?php if (empty($types)): ?>
    <div class="empty">
        <i class="fas fa-tags"></i>
        <p>Aucun type de congé.</p>
    </div>
    <?php else: ?>
    <table class="tbl">
        <thead>
            <tr><th>Libellé</th><th>Jours annuels</th><th>Déductible</th><th>Actions</th></tr>
        </thead>
        <tbody>
            <?php foreach ($types as $t): ?>
            <tr>
                <td class="td-name"><?= esc($t['libelle']) ?></td>
                <td class="td-mono"><?= (int) $t['jours_annuels'] ?></td>
                <td><span class="statut s-<?= $t['deductible'] ? 'actif' : 'inactif' ?>"><?= $t['deductible'] ? 'Oui' : 'Non' ?></span></td>
                <td>
                    <div class="action-btns">
                        <a href="<?= base_url('admin/types-conge/' . $t['id']) ?>" class="btn-sm btn-edit"><i class="fas fa-pencil-alt"></i> Éditer</a>
                        <form action="<?= base_url('admin/types-conge/supprimer/' . $t['id']) ?>" method="POST" class="d-inline" onsubmit="return confirm('Supprimer ce type de congé ?')">
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
