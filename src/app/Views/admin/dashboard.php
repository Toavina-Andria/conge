<?= $this->extend('Layout/app') ?>
<?= $this->section('title') ?>Accueil Admin<?= $this->endSection() ?>
<?= $this->section('page_title') ?>Vue d'ensemble<?= $this->endSection() ?>
<?= $this->section('breadcrumb') ?>Administration<?= $this->endSection() ?>
<?= $this->section('page_actions') ?>
<a href="<?= base_url('admin/employes/creer') ?>" class="btn-forest" style="padding:7px 14px;font-size:.82rem">
    <i class="fas fa-user-plus"></i> Ajouter un employé
</a>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="metrics">
    <div class="metric">
        <div class="metric-top"><div class="metric-icon mi-forest"><i class="fas fa-users"></i></div></div>
        <div class="metric-val"><?= $nb_employes ?? 0 ?></div>
        <div class="metric-label">Employés actifs</div>
    </div>
    <div class="metric">
        <div class="metric-top"><div class="metric-icon mi-amber"><i class="fas fa-hourglass-half"></i></div></div>
        <div class="metric-val"><?= $en_attente ?? 0 ?></div>
        <div class="metric-label">Demandes en attente</div>
    </div>
    <div class="metric">
        <div class="metric-top"><div class="metric-icon mi-green"><i class="fas fa-calendar-check"></i></div></div>
        <div class="metric-val"><?= $absences_mois ?? 0 ?></div>
        <div class="metric-label">Absences du mois</div>
    </div>
    <div class="metric">
        <div class="metric-top"><div class="metric-icon mi-blue"><i class="fas fa-building"></i></div></div>
        <div class="metric-val"><?= $nb_departements ?? 0 ?></div>
        <div class="metric-label">Départements</div>
    </div>
</div>

<div class="content-grid-wide">
    <div class="data-card" style="margin:0">
        <div class="data-card-head">
            <h3>Absences du mois (<?= strftime('%B %Y') ?>)</h3>
            <a href="<?= base_url('admin/demandes') ?>" style="font-size:.8rem;color:var(--forest);text-decoration:none">Tout voir →</a>
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
                    <td><span class="type-badge t-<?= strpos($a['type_libelle'] ?? $a['libelle'] ?? '', 'annuel') !== false ? 'annuel' : (strpos($a['type_libelle'] ?? $a['libelle'] ?? '', 'maladie') !== false ? 'maladie' : 'special') ?>"><?= esc($a['type_libelle'] ?? $a['libelle'] ?? '') ?></span></td>
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

    <div style="display:flex;flex-direction:column;gap:1rem">
        <div class="data-card" style="margin:0">
            <div class="data-card-head"><h3><i class="fas fa-chart-pie" style="color:var(--muted);margin-right:5px"></i>Indicateurs</h3></div>
            <div style="padding:1rem 1.25rem;display:flex;flex-direction:column;gap:.75rem">
                <div>
                    <div style="display:flex;justify-content:space-between;font-size:.8rem;margin-bottom:4px">
                        <span>Employés actifs</span>
                        <span class="td-mono"><?= $nb_employes ?? 0 ?></span>
                    </div>
                    <div class="solde-bar"><div class="solde-fill" style="width:100%"></div></div>
                </div>
                <div>
                    <div style="display:flex;justify-content:space-between;font-size:.8rem;margin-bottom:4px">
                        <span>En attente / Total</span>
                        <span class="td-mono"><?= $en_attente ?? 0 ?></span>
                    </div>
                    <div class="solde-bar"><div class="solde-fill warn" style="width:<?= ($en_attente ?? 0) > 0 ? min(($en_attente ?? 0) * 10, 100) : 0 ?>%"></div></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
