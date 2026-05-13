<?= $this->extend('Layout/app') ?>
<?= $this->section('title') ?>Accueil RH<?= $this->endSection() ?>
<?= $this->section('page_title') ?>Tableau de bord RH<?= $this->endSection() ?>
<?= $this->section('breadcrumb') ?>Accueil<?= $this->endSection() ?>
<?= $this->section('page_actions') ?>
<a href="<?= base_url('rh/demandes') ?>" class="btn-forest" style="padding:7px 14px;font-size:.82rem">
    <i class="fas fa-inbox"></i> Voir les demandes
</a>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="metrics">
    <div class="metric">
        <div class="metric-top"><div class="metric-icon mi-amber"><i class="fas fa-hourglass-half"></i></div></div>
        <div class="metric-val"><?= $en_attente ?? 0 ?></div>
        <div class="metric-label">Demandes en attente</div>
    </div>
    <div class="metric">
        <div class="metric-top"><div class="metric-icon mi-green"><i class="fas fa-check-circle"></i></div></div>
        <div class="metric-val"><?= $approuvees_mois ?? 0 ?></div>
        <div class="metric-label">Approuvées ce mois</div>
        <div class="metric-sub up"><i class="fas fa-arrow-up"></i> Ce mois</div>
    </div>
    <div class="metric">
        <div class="metric-top"><div class="metric-icon mi-forest"><i class="fas fa-users"></i></div></div>
        <div class="metric-val"><?= $nb_employes ?? 0 ?></div>
        <div class="metric-label">Employés actifs</div>
    </div>
</div>

<div class="data-card">
    <div class="data-card-head">
        <h3>Absences du mois (<?= strftime('%B %Y') ?>)</h3>
        <a href="<?= base_url('rh/demandes') ?>" style="font-size:.8rem;color:var(--forest);text-decoration:none">Voir tout →</a>
    </div>
    <?php if (!empty($absences)): ?>
    <table class="tbl">
        <thead>
            <tr><th>Employé</th><th>Type</th><th>Du</th><th>Au</th><th>Jours</th></tr>
        </thead>
        <tbody>
            <?php foreach ($absences as $a): ?>
            <tr>
                <td class="td-name"><?= esc($a['prenom'] . ' ' . $a['nom']) ?></td>
                <td><span class="type-badge t-<?= strpos($a['type_libible'] ?? $a['libelle'] ?? '', 'annuel') !== false ? 'annuel' : (strpos($a['type_libelle'] ?? $a['libelle'] ?? '', 'maladie') !== false ? 'maladie' : 'special') ?>"><?= esc($a['type_libelle'] ?? $a['libelle'] ?? '') ?></span></td>
                <td class="td-muted td-mono"><?= date('d/m/Y', strtotime($a['date_debut'])) ?></td>
                <td class="td-muted td-mono"><?= date('d/m/Y', strtotime($a['date_fin'])) ?></td>
                <td class="td-mono"><?= (int) $a['nb_jours'] ?> jour(s)</td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
    <div class="empty">
        <i class="fas fa-calendar-check"></i>
        <p>Aucune absence ce mois. Tous les employés sont présents.</p>
    </div>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>
