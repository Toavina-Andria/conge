<?= $this->extend('Layout/app') ?>
<?= $this->section('title') ?>Détail de la demande<?= $this->endSection() ?>
<?= $this->section('page_title') ?>Détail de la demande<?= $this->endSection() ?>
<?= $this->section('breadcrumb') ?><a href="<?= base_url('rh') ?>">Accueil</a> <i class="fas fa-chevron-right" style="font-size:.6rem"></i> <a href="<?= base_url('rh/demandes') ?>">Demandes</a> <i class="fas fa-chevron-right" style="font-size:.6rem"></i> Détail<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="content-grid-2" style="grid-template-columns:1fr 380px">
    <div>
        <div class="data-card" style="margin:0">
            <div class="data-card-head"><h3><i class="fas fa-info-circle" style="color:var(--forest);margin-right:6px"></i>Informations</h3></div>
            <table class="detail-table">
                <tr>
                    <th>Employé</th>
                    <td>
                        <div class="profile-row">
                            <div class="avatar av-green avatar-sm"><?= strtoupper(substr($demande['prenom'] ?? '', 0, 1) . substr($demande['nom'] ?? '', 0, 1)) ?></div>
                            <div class="profile-info">
                                <div class="pname"><?= esc($demande['prenom'] . ' ' . $demande['nom']) ?></div>
                                <div class="pdept"><?= esc($demande['departement_nom'] ?? '—') ?></div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr><th>Type de congé</th><td><span class="type-badge t-<?= strpos($demande['type_libelle'], 'annuel') !== false ? 'annuel' : (strpos($demande['type_libelle'], 'maladie') !== false ? 'maladie' : 'special') ?>"><?= esc($demande['type_libelle']) ?></span></td></tr>
                <tr><th>Date de début</th><td class="td-mono"><?= date('d/m/Y', strtotime($demande['date_debut'])) ?></td></tr>
                <tr><th>Date de fin</th><td class="td-mono"><?= date('d/m/Y', strtotime($demande['date_fin'])) ?></td></tr>
                <tr><th>Nombre de jours</th><td><span class="td-mono" style="font-weight:500"><?= (int) $demande['nb_jours'] ?> jour(s)</span></td></tr>
                <tr><th>Motif</th><td><?= nl2br(esc($demande['motif'] ?? '—')) ?></td></tr>
                <tr><th>Statut</th><td><span class="statut s-<?= $demande['statut'] === 'en_attente' ? 'attente' : ($demande['statut'] === 'approuvee' ? 'approuvee' : ($demande['statut'] === 'refusee' ? 'refusee' : 'annulee')) ?>"><?= $demande['statut'] === 'en_attente' ? 'en attente' : ($demande['statut'] === 'approuvee' ? 'approuvée' : ($demande['statut'] === 'refusee' ? 'refusée' : 'annulée')) ?></span></td></tr>
                <tr><th>Soumise le</th><td class="td-mono"><?= date('d/m/Y H:i', strtotime($demande['created_at'])) ?></td></tr>
                <?php if ($demande['commentaire_rh']): ?>
                <tr><th>Commentaire RH</th><td><em><?= nl2br(esc($demande['commentaire_rh'])) ?></em></td></tr>
                <?php endif; ?>
            </table>
        </div>
    </div>

    <div>
        <?php if ($demande['statut'] === 'en_attente'): ?>
        <div class="form-section" style="border:1px solid var(--warn-br)">
            <h3 style="color:var(--warn)"><i class="fas fa-gavel" style="color:var(--warn);margin-right:6px"></i>Traiter la demande</h3>
            <p style="font-size:.85rem;color:var(--muted);margin-bottom:1rem">
                Demande de <strong><?= (int) $demande['nb_jours'] ?> jours</strong> du <?= date('d/m/Y', strtotime($demande['date_debut'])) ?> au <?= date('d/m/Y', strtotime($demande['date_fin'])) ?>
            </p>
            <form action="<?= base_url('rh/traiter/' . $demande['id']) ?>" method="post">
                <?= csrf_field() ?>
                <div class="f-group">
                    <label class="f-label fw-bold">Décision</label>
                    <div class="d-flex gap-3 mb-2" style="flex-wrap:wrap">
                        <label style="display:flex;align-items:center;gap:6px;cursor:pointer;padding:8px 12px;border:1.5px solid var(--success-br);border-radius:8px;background:var(--success-bg)">
                            <input type="radio" name="action" value="approuvee" required>
                            <span style="color:var(--success);font-weight:500"><i class="fas fa-check-circle"></i> Approuver</span>
                        </label>
                        <label style="display:flex;align-items:center;gap:6px;cursor:pointer;padding:8px 12px;border:1.5px solid var(--danger-br);border-radius:8px;background:var(--danger-bg)">
                            <input type="radio" name="action" value="refusee" required>
                            <span style="color:var(--danger);font-weight:500"><i class="fas fa-times-circle"></i> Refuser</span>
                        </label>
                    </div>
                </div>
                <div class="f-group">
                    <label class="f-label">Commentaire <span style="font-weight:400;color:var(--muted)">(optionnel)</span></label>
                    <textarea name="commentaire_rh" rows="3" class="f-textarea" placeholder="Motif de la décision..."></textarea>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn-forest w-100"><i class="fas fa-paper-plane"></i> Confirmer</button>
                    <a href="<?= base_url('rh/demandes') ?>" class="btn-secondary w-100" style="justify-content:center"><i class="fas fa-arrow-left"></i> Retour</a>
                </div>
            </form>
        </div>
        <?php else: ?>
        <div class="data-card" style="margin:0">
            <div class="data-card-head"><h3><i class="fas fa-check-circle" style="color:var(--forest);margin-right:5px"></i>Demande déjà traitée</h3></div>
            <div style="padding:1.25rem">
                <p style="font-size:.9rem;color:var(--muted)">Cette demande a déjà été <strong style="color:<?= $demande['statut'] === 'approuvee' ? 'var(--success)' : 'var(--danger)' ?>"><?= $demande['statut'] === 'approuvee' ? 'approuvée' : ($demande['statut'] === 'refusee' ? 'refusée' : 'annulée') ?></strong>.</p>
                <div class="solde-bar" style="margin-bottom:1rem;height:4px"><div class="solde-fill <?= $demande['statut'] === 'approuvee' ? '' : 'danger' ?>" style="width:100%"></div></div>
                <a href="<?= base_url('rh/demandes') ?>" class="btn-secondary"><i class="fas fa-arrow-left"></i> Retour à la liste</a>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>
