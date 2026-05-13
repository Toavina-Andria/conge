<?= $this->extend('Layout/app') ?>

<?= $this->section('title') ?>Accueil Employé<?= $this->endSection() ?>
<?= $this->section('page_title') ?>Tableau de bord<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="kpi-grid">
    <div class="kpi-card kpi-primary">
        <span class="kpi-value"><?= $solde ?? '—' ?> jours</span>
        <span class="kpi-label"><i class="fas fa-wallet kpi-icon me-1"></i>Solde restant</span>
    </div>
    <div class="kpi-card kpi-warning">
        <span class="kpi-value"><?= $en_attente ?? 0 ?></span>
        <span class="kpi-label"><i class="fas fa-clock kpi-icon me-1"></i>Demandes en attente</span>
    </div>
    <div class="kpi-card kpi-success">
        <span class="kpi-value"><?= $approuvees ?? 0 ?></span>
        <span class="kpi-label"><i class="fas fa-check-circle kpi-icon me-1"></i>Demandes approuvées</span>
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <div class="card h-100">
            <div class="card-header">
                <h5><i class="fas fa-coins me-2"></i>Solde par type de congé</h5>
            </div>
            <div class="card-body">
                <?php if (!empty($soldes)): ?>
                <div class="table-wrapper">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Type</th>
                                <th>Attribués</th>
                                <th>Pris</th>
                                <th>Reste</th>
                                <th>Utilisation</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($soldes as $s): ?>
                            <tr>
                                <td><?= esc($s['libelle']) ?></td>
                                <td class="text-monospace"><?= (int) $s['jours_attribues'] ?></td>
                                <td class="text-monospace"><?= (int) $s['jours_pris'] ?></td>
                                <td class="text-monospace"><strong><?= (int) $s['reste'] ?></strong></td>
                                <td>
                                    <?php $pct = (int) $s['jours_attribues'] > 0 ? round(((int) $s['jours_pris'] / (int) $s['jours_attribues']) * 100) : 0; ?>
                                    <div class="progress">
                                        <div class="progress-bar bg-<?= $pct >= 100 ? 'danger' : ($pct >= 75 ? 'warning' : 'success') ?>" style="width: <?= $pct ?>%"></div>
                                    </div>
                                    <span class="progress-label"><?= $pct ?>% utilisé</span>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php else: ?>
                <div class="empty-state">
                    <span class="empty-icon"><i class="fas fa-coins"></i></span>
                    <p class="empty-title">Aucun solde trouvé.</p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-3">
        <div class="card h-100">
            <div class="card-header">
                <h5><i class="fas fa-list me-2"></i>Mes dernières demandes</h5>
            </div>
            <div class="card-body">
                <?php if (!empty($demandes)): ?>
                <div class="table-wrapper">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Type</th>
                                <th>Du</th>
                                <th>Au</th>
                                <th>Jours</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($demandes as $d): ?>
                            <tr>
                                <td><?= esc($d['libelle']) ?></td>
                                <td class="text-monospace"><?= date('d/m/Y', strtotime($d['date_debut'])) ?></td>
                                <td class="text-monospace"><?= date('d/m/Y', strtotime($d['date_fin'])) ?></td>
                                <td class="text-monospace"><?= (int) $d['nb_jours'] ?></td>
                                <td>
                                    <span class="badge badge--<?= $d['statut'] === 'approuvee' ? 'approved' : ($d['statut'] === 'refusee' ? 'refused' : ($d['statut'] === 'annulee' ? 'cancelled' : 'pending')) ?>">
                                        <?= $d['statut'] === 'en_attente' ? 'En attente' : ($d['statut'] === 'approuvee' ? 'Approuvée' : ($d['statut'] === 'refusee' ? 'Refusée' : 'Annulée')) ?>
                                    </span>
                                </td>
                                <td>
                                    <?php if ($d['statut'] === 'en_attente'): ?>
                                    <form action="<?= base_url('employe/annuler/' . $d['id']) ?>" method="post" class="d-inline"
                                          onsubmit="return confirm('Annuler cette demande ?')">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="btn btn--ghost btn--sm">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </form>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php else: ?>
                <div class="empty-state">
                    <span class="empty-icon"><i class="fas fa-calendar-times"></i></span>
                    <p class="empty-title">Aucune demande pour le moment.</p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
