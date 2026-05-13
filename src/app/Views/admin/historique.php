<?= $this->extend('Layout/app') ?>

<?= $this->section('title') ?>Historique des demandes<?= $this->endSection() ?>
<?= $this->section('page_title') ?>Historique des demandes<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card card-table">
    <div class="card-body">
        <?php if (empty($historique)): ?>
        <div class="empty-state">
            <span class="empty-icon"><i class="fas fa-history"></i></span>
            <p class="empty-title">Aucune demande.</p>
        </div>
        <?php else: ?>
        <div class="table-wrapper">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Employé</th>
                        <th>Département</th>
                        <th>Type</th>
                        <th>Du</th>
                        <th>Au</th>
                        <th>Jours</th>
                        <th>Statut</th>
                        <th>Traité par</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($historique as $h): ?>
                    <tr>
                        <td class="text-monospace"><?= date('d/m/Y', strtotime($h['created_at'])) ?></td>
                        <td><?= esc($h['employe_prenom'] . ' ' . $h['employe_nom']) ?></td>
                        <td><?= esc($h['departement_nom'] ?? '-') ?></td>
                        <td><?= esc($h['type_libelle']) ?></td>
                        <td class="text-monospace"><?= date('d/m/Y', strtotime($h['date_debut'])) ?></td>
                        <td class="text-monospace"><?= date('d/m/Y', strtotime($h['date_fin'])) ?></td>
                        <td class="text-monospace"><?= (int) $h['nb_jours'] ?></td>
                        <td>
                            <span class="badge badge--<?= $h['statut'] === 'approuvee' ? 'approved' : ($h['statut'] === 'refusee' ? 'refused' : ($h['statut'] === 'annulee' ? 'cancelled' : 'pending')) ?>">
                                <?= $h['statut'] === 'en_attente' ? 'En attente' : ($h['statut'] === 'approuvee' ? 'Approuvée' : ($h['statut'] === 'refusee' ? 'Refusée' : ($h['statut'] === 'annulee' ? 'Annulée' : $h['statut']))) ?>
                            </span>
                        </td>
                        <td><?= $h['traite_prenom'] ? esc($h['traite_prenom'] . ' ' . $h['traite_nom']) : '-' ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>
