<?= $this->extend('Layout/app') ?>

<?= $this->section('title') ?>Historique des demandes<?= $this->endSection() ?>
<?= $this->section('page_title') ?>Historique des demandes<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card shadow">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
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
                <?php if (empty($historique)): ?>
                <tr><td colspan="9" class="text-center text-muted py-3">Aucune demande.</td></tr>
                <?php else: ?>
                <?php foreach ($historique as $h): ?>
                <tr>
                    <td><?= date('d/m/Y', strtotime($h['created_at'])) ?></td>
                    <td><?= esc($h['employe_prenom'] . ' ' . $h['employe_nom']) ?></td>
                    <td><?= esc($h['departement_nom'] ?? '-') ?></td>
                    <td><?= esc($h['type_libelle']) ?></td>
                    <td><?= date('d/m/Y', strtotime($h['date_debut'])) ?></td>
                    <td><?= date('d/m/Y', strtotime($h['date_fin'])) ?></td>
                    <td><?= (int) $h['nb_jours'] ?></td>
                    <td>
                        <?php $badge = match($h['statut']) {
                            'en_attente' => 'warning text-dark',
                            'approuvee'  => 'success',
                            'refusee'    => 'danger',
                            'annulee'    => 'secondary',
                            default      => 'secondary',
                        }; ?>
                        <span class="badge bg-<?= $badge ?>">
                            <?= match($h['statut']) {
                                'en_attente' => 'En attente',
                                'approuvee'  => 'Approuvée',
                                'refusee'    => 'Refusée',
                                'annulee'    => 'Annulée',
                                default      => $h['statut'],
                            } ?>
                        </span>
                    </td>
                    <td><?= $h['traite_prenom'] ? esc($h['traite_prenom'] . ' ' . $h['traite_nom']) : '-' ?></td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
