<?= $this->extend('Layout/app') ?>

<?= $this->section('title') ?>Gestion des demandes<?= $this->endSection() ?>
<?= $this->section('page_title') ?>Demandes de congé<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card shadow mb-4">
    <div class="card-body">
        <form method="get" class="row g-3 align-items-end">
            <div class="col-md-4">
                <label for="statut" class="form-label">Statut</label>
                <select name="statut" id="statut" class="form-select">
                    <option value="">Tous les statuts</option>
                    <option value="en_attente" <?= $filtre_statut === 'en_attente' ? 'selected' : '' ?>>En attente</option>
                    <option value="approuvee" <?= $filtre_statut === 'approuvee' ? 'selected' : '' ?>>Approuvée</option>
                    <option value="refusee" <?= $filtre_statut === 'refusee' ? 'selected' : '' ?>>Refusée</option>
                    <option value="annulee" <?= $filtre_statut === 'annulee' ? 'selected' : '' ?>>Annulée</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="departement_id" class="form-label">Département</label>
                <select name="departement_id" id="departement_id" class="form-select">
                    <option value="">Tous les départements</option>
                    <?php foreach ($departements as $d): ?>
                    <option value="<?= $d['id'] ?>" <?= (int) $filtre_departement === (int) $d['id'] ? 'selected' : '' ?>>
                        <?= esc($d['nom']) ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary me-2">
                    <i class="fas fa-filter me-1"></i>Filtrer
                </button>
                <a href="<?= base_url('rh/demandes') ?>" class="btn btn-outline-secondary">
                    <i class="fas fa-undo me-1"></i>Réinitialiser
                </a>
            </div>
        </form>
    </div>
</div>

<div class="card shadow">
    <div class="card-body">
        <?php if (!empty($demandes)): ?>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
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
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($demandes as $d): ?>
                    <tr>
                        <td><?= esc($d['prenom'] . ' ' . $d['nom']) ?></td>
                        <td>
                            <span class="badge bg-info"><?= esc($d['departement_nom'] ?? '—') ?></span>
                        </td>
                        <td><?= esc($d['type_libelle']) ?></td>
                        <td><?= date('d/m/Y', strtotime($d['date_debut'])) ?></td>
                        <td><?= date('d/m/Y', strtotime($d['date_fin'])) ?></td>
                        <td><span class="badge bg-secondary"><?= (int) $d['nb_jours'] ?></span></td>
                        <td><?= esc(mb_strimwidth($d['motif'] ?? '—', 0, 30, '...')) ?></td>
                        <td>
                            <span class="badge bg-<?= $d['statut'] === 'approuvee' ? 'success' : ($d['statut'] === 'refusee' ? 'danger' : ($d['statut'] === 'annulee' ? 'secondary' : 'warning text-dark')) ?> fs-6">
                                <?= $d['statut'] === 'en_attente' ? 'En attente' : ($d['statut'] === 'approuvee' ? 'Approuvée' : ($d['statut'] === 'refusee' ? 'Refusée' : 'Annulée')) ?>
                            </span>
                        </td>
                        <td><?= date('d/m/Y', strtotime($d['created_at'])) ?></td>
                        <td>
                            <a href="<?= base_url('rh/demandes/' . $d['id']) ?>" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-eye"></i> Voir
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php else: ?>
        <p class="text-muted text-center py-4 mb-0">Aucune demande trouvée.</p>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>
