<?= $this->extend('Layout/app') ?>
<?= $this->section('title') ?>Gestion des demandes<?= $this->endSection() ?>
<?= $this->section('page_title') ?>Demandes de congé<?= $this->endSection() ?>
<?= $this->section('breadcrumb') ?><a href="<?= base_url('rh') ?>">Accueil</a> <i class="fas fa-chevron-right" style="font-size:.6rem"></i> Demandes<?= $this->endSection() ?>
<?= $this->section('page_actions') ?>
<?php
$nb_attente = 0;
if (!empty($demandes)) {
    foreach ($demandes as $d) { if ($d['statut'] === 'en_attente') $nb_attente++; }
}
?>
<span style="font-size:.8rem;background:var(--warn-bg);border:1px solid var(--warn-br);border-radius:6px;padding:5px 10px;display:flex;align-items:center;gap:5px;color:var(--warn)">
    <i class="fas fa-hourglass-half"></i> <?= $nb_attente ?> en attente
</span>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="pill-filters">
    <a href="<?= base_url('rh/demandes') ?>" class="pill-filter <?= !$filtre_statut ? 'active' : '' ?>">Tous</a>
    <a href="<?= base_url('rh/demandes?statut=en_attente') ?>" class="pill-filter <?= $filtre_statut === 'en_attente' ? 'active' : '' ?>">En attente</a>
    <a href="<?= base_url('rh/demandes?statut=approuvee') ?>" class="pill-filter <?= $filtre_statut === 'approuvee' ? 'active' : '' ?>">Approuvées</a>
    <a href="<?= base_url('rh/demandes?statut=refusee') ?>" class="pill-filter <?= $filtre_statut === 'refusee' ? 'active' : '' ?>">Refusées</a>
    <form method="get" class="d-inline-flex align-items-center" style="margin-left:auto">
        <?php if ($filtre_statut): ?>
        <input type="hidden" name="statut" value="<?= $filtre_statut ?>">
        <?php endif; ?>
        <select name="departement_id" class="pill-select" onchange="this.form.submit()">
            <option value="">Tous les départements</option>
            <?php foreach ($departements as $d): ?>
            <option value="<?= $d['id'] ?>" <?= (int) $filtre_departement === (int) $d['id'] ? 'selected' : '' ?>><?= esc($d['nom']) ?></option>
            <?php endforeach; ?>
        </select>
    </form>
</div>

<div class="data-card">
    <div class="data-card-head"><h3>Toutes les demandes</h3></div>
    <?php if (!empty($demandes)): ?>
    <table class="tbl">
        <thead>
            <tr><th>Employé</th><th>Type</th><th>Période</th><th>Durée</th><th>Statut</th><th>Actions</th></tr>
        </thead>
        <tbody>
            <?php foreach ($demandes as $d): ?>
            <tr>
                <td>
                    <div class="profile-row">
                        <div class="avatar av-green avatar-sm"><?= strtoupper(substr($d['prenom'] ?? '', 0, 1) . substr($d['nom'] ?? '', 0, 1)) ?></div>
                        <div class="profile-info">
                            <div class="pname"><?= esc($d['prenom'] . ' ' . $d['nom']) ?></div>
                            <div class="pdept"><?= esc($d['departement_nom'] ?? '') ?></div>
                        </div>
                    </div>
                </td>
                <td><span class="type-badge t-<?= strpos($d['type_libelle'], 'annuel') !== false ? 'annuel' : (strpos($d['type_libelle'], 'maladie') !== false ? 'maladie' : (strpos($d['type_libelle'], 'spécial') !== false || strpos($d['type_libelle'], 'special') !== false ? 'special' : 'sans-solde')) ?>"><?= esc($d['type_libelle']) ?></span></td>
                <td class="td-muted" style="font-size:.8rem"><?= date('d/m', strtotime($d['date_debut'])) ?> – <?= date('d/m/Y', strtotime($d['date_fin'])) ?></td>
                <td class="td-mono"><?= (int) $d['nb_jours'] ?> j</td>
                <td><span class="statut s-<?= $d['statut'] === 'en_attente' ? 'attente' : ($d['statut'] === 'approuvee' ? 'approuvee' : ($d['statut'] === 'refusee' ? 'refusee' : 'annulee')) ?>"><?= $d['statut'] === 'en_attente' ? 'en attente' : ($d['statut'] === 'approuvee' ? 'approuvée' : ($d['statut'] === 'refusee' ? 'refusée' : 'annulée')) ?></span></td>
                <td>
                    <div class="action-btns">
                        <a href="<?= base_url('rh/demandes/' . $d['id']) ?>" class="btn-sm btn-view"><i class="fas fa-eye"></i> Voir</a>
                        <?php if ($d['statut'] === 'en_attente'): ?>
                        <a href="<?= base_url('rh/demandes/' . $d['id']) ?>" class="btn-sm btn-approve"><i class="fas fa-check"></i> Traiter</a>
                        <?php endif; ?>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
    <div class="empty">
        <i class="fas fa-inbox"></i>
        <p>Aucune demande trouvée.</p>
    </div>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>
