<?= $this->extend('Layout/app') ?>

<?= $this->section('title') ?>Mes demandes<?= $this->endSection() ?>
<?= $this->section('page_title') ?>Mes demandes de congé<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card card-table">
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
                        <th>Motif</th>
                        <th>Statut</th>
                        <th>Commentaire RH</th>
                        <th>Soumise le</th>
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
                        <td><?= esc($d['motif'] ?? '—') ?></td>
                        <td>
                            <span class="badge badge--<?= $d['statut'] === 'approuvee' ? 'approved' : ($d['statut'] === 'refusee' ? 'refused' : ($d['statut'] === 'annulee' ? 'cancelled' : 'pending')) ?>">
                                <?= $d['statut'] === 'en_attente' ? 'En attente' : ($d['statut'] === 'approuvee' ? 'Approuvée' : ($d['statut'] === 'refusee' ? 'Refusée' : 'Annulée')) ?>
                            </span>
                        </td>
                        <td><?= esc($d['commentaire_rh'] ?? '—') ?></td>
                        <td class="text-monospace"><?= date('d/m/Y H:i', strtotime($d['created_at'])) ?></td>
                        <td>
                            <?php if ($d['statut'] === 'en_attente'): ?>
                            <form action="<?= base_url('employe/annuler/' . $d['id']) ?>" method="post" class="d-inline"
                                  onsubmit="return confirm('Annuler cette demande de congé ?')">
                                <?= csrf_field() ?>
                                <button type="submit" class="btn btn--ghost btn--sm">
                                    <i class="fas fa-times"></i> Annuler
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
            <p class="empty-title">Vous n'avez encore soumis aucune demande de congé.</p>
            <a href="<?= base_url('employe/demande') ?>" class="btn btn--primary mt-3">
                <i class="fas fa-plus-circle"></i>Nouvelle demande
            </a>
        </div>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>
