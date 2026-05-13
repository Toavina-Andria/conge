<?= $this->extend('Layout/app') ?>
<?= $this->section('title') ?>Historique des demandes<?= $this->endSection() ?>
<?= $this->section('page_title') ?>Historique des demandes<?= $this->endSection() ?>
<?= $this->section('breadcrumb') ?><a href="<?= base_url('admin') ?>">Admin</a> <i class="fas fa-chevron-right" style="font-size:.6rem"></i> Historique<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="data-card">
    <div class="data-card-head"><h3>Historique complet</h3></div>
    <?php if (empty($historique)): ?>
    <div class="empty">
        <i class="fas fa-history"></i>
        <p>Aucune demande.</p>
    </div>
    <?php else: ?>
    <table class="tbl">
        <thead>
            <tr><th>Date</th><th>Employé</th><th>Département</th><th>Type</th><th>Du</th><th>Au</th><th>Jours</th><th>Statut</th><th>Traité par</th></tr>
        </thead>
        <tbody>
            <?php foreach ($historique as $h): ?>
            <tr>
                <td class="td-mono"><?= date('d/m/Y', strtotime($h['created_at'])) ?></td>
                <td class="td-name"><?= esc($h['employe_prenom'] . ' ' . $h['employe_nom']) ?></td>
                <td class="td-muted"><?= esc($h['departement_nom'] ?? '-') ?></td>
                <td><span class="type-badge t-<?= strpos($h['type_libelle'], 'annuel') !== false ? 'annuel' : (strpos($h['type_libelle'], 'maladie') !== false ? 'maladie' : 'special') ?>"><?= esc($h['type_libelle']) ?></span></td>
                <td class="td-muted td-mono"><?= date('d/m/Y', strtotime($h['date_debut'])) ?></td>
                <td class="td-muted td-mono"><?= date('d/m/Y', strtotime($h['date_fin'])) ?></td>
                <td class="td-mono"><?= (int) $h['nb_jours'] ?></td>
                <td><span class="statut s-<?= $h['statut'] === 'en_attente' ? 'attente' : ($h['statut'] === 'approuvee' ? 'approuvee' : ($h['statut'] === 'refusee' ? 'refusee' : 'annulee')) ?>"><?= $h['statut'] === 'en_attente' ? 'En attente' : ($h['statut'] === 'approuvee' ? 'Approuvée' : ($h['statut'] === 'refusee' ? 'Refusée' : ($h['statut'] === 'annulee' ? 'Annulée' : $h['statut']))) ?></span></td>
                <td class="td-muted"><?= $h['traite_prenom'] ? esc($h['traite_prenom'] . ' ' . $h['traite_nom']) : '-' ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>
