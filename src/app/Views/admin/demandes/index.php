<?= $this->extend('Layout/app') ?>
<?= $this->section('title') ?>Toutes les demandes<?= $this->endSection() ?>
<?= $this->section('page_title') ?>Vue globale des demandes<?= $this->endSection() ?>
<?= $this->section('breadcrumb') ?><a href="<?= base_url('admin') ?>">Admin</a> <i class="fas fa-chevron-right" style="font-size:.6rem"></i> Demandes<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="pill-filters">
    <a href="<?= base_url('admin/demandes') ?>" class="pill-filter <?= !$filtre_statut ? 'active' : '' ?>">Tous</a>
    <a href="<?= base_url('admin/demandes?statut=en_attente') ?>" class="pill-filter <?= $filtre_statut === 'en_attente' ? 'active' : '' ?>">En attente</a>
    <a href="<?= base_url('admin/demandes?statut=approuvee') ?>" class="pill-filter <?= $filtre_statut === 'approuvee' ? 'active' : '' ?>">Approuvées</a>
    <a href="<?= base_url('admin/demandes?statut=refusee') ?>" class="pill-filter <?= $filtre_statut === 'refusee' ? 'active' : '' ?>">Refusées</a>
    <a href="<?= base_url('admin/demandes?statut=annulee') ?>" class="pill-filter <?= $filtre_statut === 'annulee' ? 'active' : '' ?>">Annulées</a>
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
            <tr><th>Employé</th><th>Département</th><th>Type</th><th>Du</th><th>Au</th><th>Jours</th><th>Motif</th><th>Statut</th><th>Soumise le</th><th>Traité par</th></tr>
        </thead>
        <tbody>
            <?php foreach ($demandes as $d): ?>
            <tr>
                <td>
                    <div class="profile-row">
                        <div class="avatar av-green avatar-xs"><?= strtoupper(substr($d['prenom'] ?? '', 0, 1) . substr($d['nom'] ?? '', 0, 1)) ?></div>
                        <span class="td-name" style="font-size:.84rem"><?= esc($d['prenom'] . ' ' . $d['nom']) ?></span>
                    </div>
                </td>
                <td class="td-muted"><?= esc($d['departement_nom'] ?? '—') ?></td>
                <td><span class="type-badge t-<?= strpos($d['type_libelle'], 'annuel') !== false ? 'annuel' : (strpos($d['type_libelle'], 'maladie') !== false ? 'maladie' : (strpos($d['type_libelle'], 'spécial') !== false || strpos($d['type_libelle'], 'special') !== false ? 'special' : 'sans-solde')) ?>"><?= esc($d['type_libelle']) ?></span></td>
                <td class="td-muted td-mono"><?= date('d/m/Y', strtotime($d['date_debut'])) ?></td>
                <td class="td-muted td-mono"><?= date('d/m/Y', strtotime($d['date_fin'])) ?></td>
                <td class="td-mono"><?= (int) $d['nb_jours'] ?></td>
                <td class="td-muted" style="max-width:120px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap"><?= esc(mb_strimwidth($d['motif'] ?? '—', 0, 25, '...')) ?></td>
                <td><span class="statut s-<?= $d['statut'] === 'en_attente' ? 'attente' : ($d['statut'] === 'approuvee' ? 'approuvee' : ($d['statut'] === 'refusee' ? 'refusee' : 'annulee')) ?>"><?= $d['statut'] === 'en_attente' ? 'en attente' : ($d['statut'] === 'approuvee' ? 'approuvée' : ($d['statut'] === 'refusee' ? 'refusée' : 'annulée')) ?></span></td>
                <td class="td-muted td-mono"><?= date('d/m/Y', strtotime($d['created_at'])) ?></td>
                <td class="td-muted"><?= esc($d['traite_nom'] ?? '—') ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
    <div class="empty">
        <i class="fas fa-calendar-check"></i>
        <p>Aucune demande trouvée.</p>
    </div>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>
