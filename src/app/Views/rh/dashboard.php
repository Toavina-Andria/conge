<?= $this->extend('Layout/app') ?>

<?= $this->section('title') ?>Accueil RH<?= $this->endSection() ?>
<?= $this->section('page_title') ?>Tableau de bord RH<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-4 mb-3">
        <div class="card text-bg-warning shadow">
            <div class="card-body">
                <h5 class="card-title"><i class="fas fa-inbox me-2"></i>Demandes en attente</h5>
                <p class="display-6 mb-0"><?= $en_attente ?? 0 ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card text-bg-success shadow">
            <div class="card-body">
                <h5 class="card-title"><i class="fas fa-check-circle me-2"></i>Approuvées ce mois</h5>
                <p class="display-6 mb-0"><?= $approuvees_mois ?? 0 ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card text-bg-info shadow">
            <div class="card-body">
                <h5 class="card-title"><i class="fas fa-users me-2"></i>Employés</h5>
                <p class="display-6 mb-0"><?= $nb_employes ?? 0 ?></p>
            </div>
        </div>
    </div>
</div>

<div class="card shadow mt-2">
    <div class="card-header">
        <h5 class="mb-0">Absences du mois (<?= date('F Y') ?>)</h5>
    </div>
    <div class="card-body">
        <?php if (!empty($absences)): ?>
        <table class="table table-hover">
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
                    <td><?= esc($a['libelle']) ?></td>
                    <td><?= date('d/m/Y', strtotime($a['date_debut'])) ?></td>
                    <td><?= date('d/m/Y', strtotime($a['date_fin'])) ?></td>
                    <td><?= (int) $a['nb_jours'] ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php else: ?>
        <p class="text-muted mb-0">Aucune absence ce mois.</p>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>
