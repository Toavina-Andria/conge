<?= $this->extend('Layout/app') ?>

<?= $this->section('title') ?>Détail de la demande<?= $this->endSection() ?>
<?= $this->section('page_title') ?>Détail de la demande<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-7">
        <div class="card shadow mb-4">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Informations</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless mb-0">
                    <tr>
                        <th style="width: 180px;">Employé</th>
                        <td><?= esc($demande['prenom'] . ' ' . $demande['nom']) ?></td>
                    </tr>
                    <tr>
                        <th>Département</th>
                        <td><?= esc($demande['departement_nom'] ?? '—') ?></td>
                    </tr>
                    <tr>
                        <th>Type de congé</th>
                        <td><?= esc($demande['type_libelle']) ?></td>
                    </tr>
                    <tr>
                        <th>Date de début</th>
                        <td><?= date('d/m/Y', strtotime($demande['date_debut'])) ?></td>
                    </tr>
                    <tr>
                        <th>Date de fin</th>
                        <td><?= date('d/m/Y', strtotime($demande['date_fin'])) ?></td>
                    </tr>
                    <tr>
                        <th>Nombre de jours</th>
                        <td><span class="badge bg-secondary fs-6"><?= (int) $demande['nb_jours'] ?> jour(s) ouvrable(s)</span></td>
                    </tr>
                    <tr>
                        <th>Motif</th>
                        <td><?= nl2br(esc($demande['motif'] ?? '—')) ?></td>
                    </tr>
                    <tr>
                        <th>Statut</th>
                        <td>
                            <span class="badge bg-<?= $demande['statut'] === 'approuvee' ? 'success' : ($demande['statut'] === 'refusee' ? 'danger' : ($demande['statut'] === 'annulee' ? 'secondary' : 'warning text-dark')) ?> fs-6">
                                <?= $demande['statut'] === 'en_attente' ? 'En attente' : ($demande['statut'] === 'approuvee' ? 'Approuvée' : ($demande['statut'] === 'refusee' ? 'Refusée' : 'Annulée')) ?>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>Soumise le</th>
                        <td><?= date('d/m/Y H:i', strtotime($demande['created_at'])) ?></td>
                    </tr>
                    <?php if ($demande['commentaire_rh']): ?>
                    <tr>
                        <th>Commentaire RH</th>
                        <td><em><?= nl2br(esc($demande['commentaire_rh'])) ?></em></td>
                    </tr>
                    <?php endif; ?>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-5">
        <?php if ($demande['statut'] === 'en_attente'): ?>
        <div class="card shadow mb-4 border-warning">
            <div class="card-header bg-warning text-dark">
                <h5 class="mb-0"><i class="fas fa-gavel me-2"></i>Traiter la demande</h5>
            </div>
            <div class="card-body">
                <form action="<?= base_url('rh/traiter/' . $demande['id']) ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Décision</label>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="action" value="approuvee" id="action_approve" required>
                            <label class="form-check-label text-success fw-bold" for="action_approve">
                                <i class="fas fa-check-circle me-1"></i>Approuver
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="action" value="refusee" id="action_refuse" required>
                            <label class="form-check-label text-danger fw-bold" for="action_refuse">
                                <i class="fas fa-times-circle me-1"></i>Refuser
                            </label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="commentaire_rh" class="form-label">Commentaire <small class="text-muted">(optionnel)</small></label>
                        <textarea name="commentaire_rh" id="commentaire_rh" rows="3" class="form-control" placeholder="Motif de la décision..."></textarea>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane me-2"></i>Confirmer
                        </button>
                        <a href="<?= base_url('rh/demandes') ?>" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-1"></i>Retour à la liste
                        </a>
                    </div>
                </form>
            </div>
        </div>
        <?php else: ?>
        <div class="card shadow mb-4">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-check-circle me-2"></i>Demande déjà traitée</h5>
            </div>
            <div class="card-body">
                <p class="mb-0">Cette demande a déjà été <strong>
                    <?= $demande['statut'] === 'approuvee' ? 'approuvée' : ($demande['statut'] === 'refusee' ? 'refusée' : 'annulée') ?>
                </strong>.</p>
                <a href="<?= base_url('rh/demandes') ?>" class="btn btn-outline-secondary mt-3">
                    <i class="fas fa-arrow-left me-1"></i>Retour à la liste
                </a>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>
