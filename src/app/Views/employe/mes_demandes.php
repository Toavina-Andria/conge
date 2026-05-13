<?= $this->extend('Layout/app') ?>

<?= $this->section('title') ?>Mes demandes<?= $this->endSection() ?>
<?= $this->section('page_title') ?>Mes demandes de congé<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card shadow">
    <div class="card-body">
        <?php if (!empty($demandes)): ?>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Type</th>
                        <th>Du</th>
                        <th>Au</th>
                        <th>Jours</th>
                        <th>Motif</th>
                        <th>Statut</th>
                        <th>Commentaire RH</th>
                        <th>Soumise le</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($demandes as $d): ?>
                    <tr>
                        <td><?= esc($d['libelle']) ?></td>
                        <td><?= date('d/m/Y', strtotime($d['date_debut'])) ?></td>
                        <td><?= date('d/m/Y', strtotime($d['date_fin'])) ?></td>
                        <td><span class="badge bg-secondary"><?= (int) $d['nb_jours'] ?></span></td>
                        <td><?= esc($d['motif'] ?? '—') ?></td>
                        <td>
                            <span class="badge bg-<?= $d['statut'] === 'approuvee' ? 'success' : ($d['statut'] === 'refusee' ? 'danger' : ($d['statut'] === 'annulee' ? 'secondary' : 'warning text-dark')) ?> fs-6">
                                <?= $d['statut'] === 'en_attente' ? 'En attente' : ($d['statut'] === 'approuvee' ? 'Approuvée' : ($d['statut'] === 'refusee' ? 'Refusée' : 'Annulée')) ?>
                            </span>
                        </td>
                        <td><?= esc($d['commentaire_rh'] ?? '—') ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($d['created_at'])) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php else: ?>
        <div class="text-center py-5">
            <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
            <p class="text-muted mb-0">Vous n'avez encore soumis aucune demande de congé.</p>
            <a href="<?= base_url('employe/demande') ?>" class="btn btn-primary mt-3">
                <i class="fas fa-plus-circle me-2"></i>Nouvelle demande
            </a>
        </div>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>
