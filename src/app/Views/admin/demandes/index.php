<?= $this->extend('Layout/app') ?>

<?= $this->section('title') ?>Toutes les demandes<?= $this->endSection() ?>
<?= $this->section('page_title') ?>Vue globale des demandes<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="filter-bar">
        <form method="get" class="d-flex align-items-center gap-2" style="flex:1;flex-wrap:wrap;">
            <select name="statut" class="filter-select">
                <option value="">Tous les statuts</option>
                <option value="en_attente" <?= $filtre_statut === 'en_attente' ? 'selected' : '' ?>>En attente</option>
                <option value="approuvee" <?= $filtre_statut === 'approuvee' ? 'selected' : '' ?>>Approuvée</option>
                <option value="refusee" <?= $filtre_statut === 'refusee' ? 'selected' : '' ?>>Refusée</option>
                <option value="annulee" <?= $filtre_statut === 'annulee' ? 'selected' : '' ?>>Annulée</option>
            </select>
            <select name="departement_id" class="filter-select">
                <option value="">Tous les départements</option>
                <?php foreach ($departements as $d): ?>
                <option value="<?= $d['id'] ?>" <?= (int) $filtre_departement === (int) $d['id'] ? 'selected' : '' ?>>
                    <?= esc($d['nom']) ?>
                </option>
                <?php endforeach; ?>
            </select>
            <button type="submit" class="btn btn--primary btn--sm">
                <i class="fas fa-filter"></i>Filtrer
            </button>
            <a href="<?= base_url('admin/demandes') ?>" class="filter-reset">Réinitialiser</a>
        </form>
    </div>
    <div class="card-body">
        <?php if (!empty($demandes)): ?>
        <div class="table-wrapper">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Employé</th>
                        <th>Département</th>
                        <th>Type</th>
                        <th>Du</th>
                        <th>Au</th>
                        <th>Jours</th>
                        <th>Motif</th>
                        <th>Statut</th>
                        <th>Soumise le</th>
                        <th>Traité par</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($demandes as $d): ?>
                    <tr>
                        <td><?= esc($d['prenom'] . ' ' . $d['nom']) ?></td>
                        <td><span class="badge badge--info"><?= esc($d['departement_nom'] ?? '—') ?></span></td>
                        <td><?= esc($d['type_libelle']) ?></td>
                        <td class="text-monospace"><?= date('d/m/Y', strtotime($d['date_debut'])) ?></td>
                        <td class="text-monospace"><?= date('d/m/Y', strtotime($d['date_fin'])) ?></td>
                        <td class="text-monospace"><?= (int) $d['nb_jours'] ?></td>
                        <td><?= esc(mb_strimwidth($d['motif'] ?? '—', 0, 30, '...')) ?></td>
                        <td>
                            <span class="badge badge--<?= $d['statut'] === 'approuvee' ? 'approved' : ($d['statut'] === 'refusee' ? 'refused' : ($d['statut'] === 'annulee' ? 'cancelled' : 'pending')) ?>">
                                <?= $d['statut'] === 'en_attente' ? 'En attente' : ($d['statut'] === 'approuvee' ? 'Approuvée' : ($d['statut'] === 'refusee' ? 'Refusée' : 'Annulée')) ?>
                            </span>
                        </td>
                        <td class="text-monospace"><?= date('d/m/Y', strtotime($d['created_at'])) ?></td>
                        <td><?= esc($d['traite_nom'] ?? '—') ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php else: ?>
        <div class="empty-state">
            <span class="empty-icon"><i class="fas fa-calendar-check"></i></span>
            <p class="empty-title">Aucune demande trouvée.</p>
        </div>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>
