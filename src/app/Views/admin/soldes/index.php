<?= $this->extend('Layout/app') ?>
<?= $this->section('title') ?>Soldes annuels<?= $this->endSection() ?>
<?= $this->section('page_title') ?>Soldes annuels<?= $this->endSection() ?>
<?= $this->section('breadcrumb') ?><a href="<?= base_url('admin') ?>">Admin</a> <i class="fas fa-chevron-right" style="font-size:.6rem"></i> Soldes<?= $this->endSection() ?>
<?= $this->section('page_actions') ?>
<form method="GET" class="d-flex align-items-center gap-2">
    <select name="annee" class="pill-select" onchange="this.form.submit()" style="border-radius:8px;padding:6px 12px">
        <?php foreach ($annees as $a): ?>
        <option value="<?= $a ?>" <?= $a === $annee ? 'selected' : '' ?>><?= $a ?></option>
        <?php endforeach; ?>
    </select>
</form>
<a href="<?= base_url('admin/soldes/creer') ?>" class="btn-forest" style="padding:7px 14px;font-size:.82rem">
    <i class="fas fa-plus"></i> Nouveau solde
</a>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="data-card">
    <div class="data-card-head">
        <h3>Soldes — <?= $annee ?></h3>
        <span class="td-muted" style="font-size:.82rem"><?= count($soldes) ?> entrée(s)</span>
    </div>
    <?php if (empty($soldes)): ?>
    <div class="empty">
        <i class="fas fa-coins"></i>
        <p>Aucun solde pour cette année.</p>
    </div>
    <?php else: ?>
    <table class="tbl">
        <thead>
            <tr><th>Employé</th><th>Type de congé</th><th>Attribués</th><th>Pris</th><th>Reste</th><th>Actions</th></tr>
        </thead>
        <tbody>
            <?php foreach ($soldes as $s): ?>
            <tr>
                <td class="td-name"><?= esc($s['prenom'] . ' ' . $s['nom']) ?></td>
                <td><span class="type-badge t-<?= strpos($s['libelle'], 'annuel') !== false ? 'annuel' : (strpos($s['libelle'], 'maladie') !== false ? 'maladie' : 'special') ?>"><?= esc($s['libelle']) ?></span></td>
                <td class="td-mono"><?= (int) $s['jours_attribues'] ?></td>
                <td class="td-mono"><?= (int) $s['jours_pris'] ?></td>
                <td>
                    <span class="td-mono" style="font-weight:500;color:<?= (int) $s['reste'] <= 0 ? 'var(--danger)' : ((int) $s['reste'] <= 2 ? 'var(--warn)' : 'var(--success)') ?>">
                        <?= (int) $s['reste'] ?>
                    </span>
                </td>
                <td>
                    <div class="action-btns">
                        <a href="<?= base_url('admin/soldes/' . $s['id']) ?>" class="btn-sm btn-edit"><i class="fas fa-pencil-alt"></i></a>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>
