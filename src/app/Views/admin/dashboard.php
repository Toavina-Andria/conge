<?= $this->extend('Layout/app') ?>

<?= $this->section('title') ?>Accueil Admin<?= $this->endSection() ?>
<?= $this->section('page_title') ?>Tableau de bord Admin<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="kpi-grid">
    <div class="kpi-card kpi-primary">
        <span class="kpi-value"><?= $nb_employes ?? 0 ?></span>
        <span class="kpi-label"><i class="fas fa-users kpi-icon me-1"></i>Employés</span>
    </div>
    <div class="kpi-card kpi-success">
        <span class="kpi-value"><?= $nb_departements ?? 0 ?></span>
        <span class="kpi-label"><i class="fas fa-building kpi-icon me-1"></i>Départements</span>
    </div>
    <div class="kpi-card kpi-warning">
        <span class="kpi-value"><?= $en_attente ?? 0 ?></span>
        <span class="kpi-label"><i class="fas fa-inbox kpi-icon me-1"></i>Demandes en attente</span>
    </div>
    <div class="kpi-card kpi-info">
        <span class="kpi-value"><?= $absences_mois ?? 0 ?></span>
        <span class="kpi-label"><i class="fas fa-calendar-check kpi-icon me-1"></i>Absences du mois</span>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5>Absences du mois (<?= strftime('%B %Y') ?>)</h5>
    </div>
    <div class="card-body">
        <?php if (!empty($absences)): ?>
        <div class="table-wrapper">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Employé</th>
                        <th>Type</th>
                        <th>Du</th>
                        <th>Au</th>
                        <th>Jours</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($absences as $a): ?>
                    <tr>
                        <td><?= esc($a['prenom'] . ' ' . $a['nom']) ?></td>
                        <td><?= esc($a['type_libelle'] ?? $a['libelle'] ?? '') ?></td>
                        <td class="text-monospace"><?= date('d/m/Y', strtotime($a['date_debut'])) ?></td>
                        <td class="text-monospace"><?= date('d/m/Y', strtotime($a['date_fin'])) ?></td>
                        <td class="text-monospace"><?= (int) $a['nb_jours'] ?> jour(s)</td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php else: ?>
        <div class="empty-state">
            <span class="empty-icon"><i class="fas fa-calendar-check"></i></span>
            <p class="empty-title">Aucune absence ce mois</p>
            <p class="empty-subtitle">Tous les employés sont présents.</p>
        </div>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>
