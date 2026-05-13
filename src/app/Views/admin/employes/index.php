<?= $this->extend('Layout/app') ?>
<?= $this->section('title') ?>Gestion des employés<?= $this->endSection() ?>
<?= $this->section('page_title') ?>Gestion des employés<?= $this->endSection() ?>
<?= $this->section('breadcrumb') ?><a href="<?= base_url('admin') ?>">Admin</a> <i class="fas fa-chevron-right" style="font-size:.6rem"></i> Employés<?= $this->endSection() ?>
<?= $this->section('page_actions') ?>
<a href="<?= base_url('admin/employes/creer') ?>" class="btn-forest" style="padding:7px 14px;font-size:.82rem">
    <i class="fas fa-user-plus"></i> Ajouter
</a>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="data-card">
    <div class="data-card-head">
        <h3>Tous les employés</h3>
        <span class="td-muted" style="font-size:.82rem"><?= count($employes) ?> employé(s)</span>
    </div>
    <?php if (empty($employes)): ?>
    <div class="empty">
        <i class="fas fa-users"></i>
        <p>Aucun employé.</p>
    </div>
    <?php else: ?>
    <table class="tbl">
        <thead>
            <tr><th>Employé</th><th>Département</th><th>Rôle</th><th>Statut</th><th>Actions</th></tr>
        </thead>
        <tbody>
            <?php foreach ($employes as $emp): ?>
            <tr>
                <td>
                    <div class="profile-row">
                        <div class="avatar av-green avatar-sm"><?= strtoupper(substr($emp['prenom'] ?? '', 0, 1) . substr($emp['nom'] ?? '', 0, 1)) ?></div>
                        <div class="profile-info">
                            <div class="pname"><?= esc($emp['prenom'] . ' ' . $emp['nom']) ?></div>
                            <div class="pdept"><?= esc($emp['email']) ?></div>
                        </div>
                    </div>
                </td>
                <td class="td-muted"><?= esc($emp['departement_nom'] ?? '-') ?></td>
                <td><span class="type-badge" style="background:#f1efe8;color:#444441"><?= $emp['role'] ?></span></td>
                <td><span class="statut s-<?= $emp['actif'] ? 'actif' : 'inactif' ?>" style="font-size:.68rem"><?= $emp['actif'] ? 'actif' : 'inactif' ?></span></td>
                <td>
                    <div class="action-btns">
                        <a href="<?= base_url('admin/employes/' . $emp['id']) ?>" class="btn-sm btn-edit"><i class="fas fa-pencil-alt"></i> Éditer</a>
                        <form action="<?= base_url('admin/employes/toggle/' . $emp['id']) ?>" method="POST" class="d-inline" onsubmit="return confirm('<?= $emp['actif'] ? 'Désactiver' : 'Activer' ?> cet employé ?')">
                            <?= csrf_field() ?>
                            <button type="submit" class="btn-sm btn-del">
                                <i class="fas <?= $emp['actif'] ? 'fa-ban' : 'fa-check' ?>"></i>
                            </button>
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
