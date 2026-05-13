<?= $this->extend('Layout/app') ?>

<?= $this->section('title') ?>Détail de la demande<?= $this->endSection() ?>
<?= $this->section('page_title') ?>Détail de la demande<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-7">
        <div class="card mb-4">
            <div class="card-header">
                <h5><i class="fas fa-info-circle me-2"></i>Informations</h5>
            </div>
            <div class="card-body">
                <table class="detail-table">
                    <tr>
                        <th>Employé</th>
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
                        <td class="text-monospace"><?= date('d/m/Y', strtotime($demande['date_debut'])) ?></td>
                    </tr>
                    <tr>
                        <th>Date de fin</th>
                        <td class="text-monospace"><?= date('d/m/Y', strtotime($demande['date_fin'])) ?></td>
                    </tr>
                    <tr>
                        <th>Nombre de jours</th>
                        <td><span class="badge badge--info"><?= (int) $demande['nb_jours'] ?> jour(s)</span></td>
                    </tr>
                    <tr>
                        <th>Motif</th>
                        <td><?= nl2br(esc($demande['motif'] ?? '—')) ?></td>
                    </tr>
                    <tr>
                        <th>Statut</th>
                        <td>
                            <span class="badge badge--<?= $demande['statut'] === 'approuvee' ? 'approved' : ($demande['statut'] === 'refusee' ? 'refused' : ($demande['statut'] === 'annulee' ? 'cancelled' : 'pending')) ?>">
                                <?= $demande['statut'] === 'en_attente' ? 'En attente' : ($demande['statut'] === 'approuvee' ? 'Approuvée' : ($demande['statut'] === 'refusee' ? 'Refusée' : 'Annulée')) ?>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>Soumise le</th>
                        <td class="text-monospace"><?= date('d/m/Y H:i', strtotime($demande['created_at'])) ?></td>
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
        <div class="card mb-4" style="border-color:var(--color-pending);">
            <div class="card-header" style="background:#FEF3C7;">
                <h5><i class="fas fa-gavel me-2"></i>Traiter la demande</h5>
            </div>
            <div class="card-body">
                <form action="<?= base_url('rh/traiter/' . $demande['id']) ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Décision</label>
                        <div class="d-flex gap-3 mb-2">
                            <label class="d-flex align-items-center gap-2" style="cursor:pointer;">
                                <input type="radio" name="action" value="approuvee" required>
                                <span class="text-success fw-bold"><i class="fas fa-check-circle"></i> Approuver</span>
                            </label>
                            <label class="d-flex align-items-center gap-2" style="cursor:pointer;">
                                <input type="radio" name="action" value="refusee" required>
                                <span class="text-danger fw-bold"><i class="fas fa-times-circle"></i> Refuser</span>
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Commentaire <span class="text-muted">(optionnel)</span></label>
                        <textarea name="commentaire_rh" rows="3" class="form-textarea" placeholder="Motif de la décision..."></textarea>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn--primary w-100">
                            <i class="fas fa-paper-plane"></i>Confirmer
                        </button>
                        <a href="<?= base_url('rh/demandes') ?>" class="btn btn--secondary w-100">
                            <i class="fas fa-arrow-left"></i>Retour à la liste
                        </a>
                    </div>
                </form>
            </div>
        </div>
        <?php else: ?>
        <div class="card mb-4">
            <div class="card-header">
                <h5><i class="fas fa-check-circle me-2"></i>Demande déjà traitée</h5>
            </div>
            <div class="card-body">
                <p>Cette demande a déjà été <strong>
                    <?= $demande['statut'] === 'approuvee' ? 'approuvée' : ($demande['statut'] === 'refusee' ? 'refusée' : 'annulée') ?>
                </strong>.</p>
                <a href="<?= base_url('rh/demandes') ?>" class="btn btn--secondary">
                    <i class="fas fa-arrow-left"></i>Retour à la liste
                </a>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>
