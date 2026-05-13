<?= $this->extend('Layout/app') ?>

<?= $this->section('title') ?>Accueil Employé<?= $this->endSection() ?>
<?= $this->section('page_title') ?>Tableau de bord<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-4 mb-3">
        <div class="card text-bg-primary shadow">
            <div class="card-body">
                <h5 class="card-title"><i class="fas fa-wallet me-2"></i>Solde restant</h5>
                <p class="display-6 mb-0"><?= $solde ?? '—' ?> jours</p>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card text-bg-warning shadow">
            <div class="card-body">
                <h5 class="card-title"><i class="fas fa-clock me-2"></i>Demandes en attente</h5>
                <p class="display-6 mb-0"><?= $en_attente ?? 0 ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card text-bg-success shadow">
            <div class="card-body">
                <h5 class="card-title"><i class="fas fa-check-circle me-2"></i>Demandes approuvées</h5>
                <p class="display-6 mb-0"><?= $approuvees ?? 0 ?></p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <div class="card shadow h-100">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-coins me-2"></i>Solde par type de congé</h5>
            </div>
            <div class="card-body">
                <?php if (!empty($soldes)): ?>
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>Attribués</th>
                            <th>Pris</th>
                            <th>Reste</th>
                            <th>Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($soldes as $s): ?>
                        <tr>
                            <td><?= esc($s['libelle']) ?></td>
                            <td><?= (int) $s['jours_attribues'] ?></td>
                            <td><?= (int) $s['jours_pris'] ?></td>
                            <td>
                                <strong><?= (int) $s['reste'] ?></strong>
                            </td>
                            <td>
                                <?php $pct = (int) $s['jours_attribues'] > 0 ? round(((int) $s['jours_pris'] / (int) $s['jours_attribues']) * 100) : 0; ?>
                                <div class="progress" style="height: 8px;">
                                    <div class="progress-bar bg-<?= $pct >= 100 ? 'danger' : ($pct >= 75 ? 'warning' : 'success') ?>" style="width: <?= $pct ?>%"></div>
                                </div>
                                <small class="text-muted"><?= $pct ?>% utilisé</small>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php else: ?>
                <p class="text-muted mb-0">Aucun solde trouvé.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-3">
        <div class="card shadow h-100">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-list me-2"></i>Mes dernières demandes</h5>
            </div>
            <div class="card-body">
                <?php if (!empty($demandes)): ?>
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>Du</th>
                            <th>Au</th>
                            <th>Jours</th>
                            <th>Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($demandes as $d): ?>
                        <tr>
                            <td><?= esc($d['libelle']) ?></td>
                            <td><?= date('d/m/Y', strtotime($d['date_debut'])) ?></td>
                            <td><?= date('d/m/Y', strtotime($d['date_fin'])) ?></td>
                            <td><?= (int) $d['nb_jours'] ?></td>
                            <td>
                                <span class="badge bg-<?= $d['statut'] === 'approuvee' ? 'success' : ($d['statut'] === 'refusee' ? 'danger' : ($d['statut'] === 'annulee' ? 'secondary' : 'warning text-dark')) ?>">
                                    <?= $d['statut'] ?>
                                </span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php else: ?>
                <p class="text-muted mb-0">Aucune demande pour le moment.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
