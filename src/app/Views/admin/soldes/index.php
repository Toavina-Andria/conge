<?= $this->extend('Layout/app') ?>

<?= $this->section('title') ?>Soldes annuels<?= $this->endSection() ?>
<?= $this->section('page_title') ?>Soldes annuels<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="content-header">
    <h5>Soldes par année</h5>
    <div class="d-flex align-items-center gap-2">
        <form method="GET" class="d-flex align-items-center gap-2">
            <label class="form-label mb-0">Année :</label>
            <select name="annee" class="form-select" style="width:auto;min-width:100px;" onchange="this.form.submit()">
                <?php foreach ($annees as $a): ?>
                <option value="<?= $a ?>" <?= $a === $annee ? 'selected' : '' ?>><?= $a ?></option>
                <?php endforeach; ?>
            </select>
        </form>
        <a href="<?= base_url('admin/soldes/creer') ?>" class="btn btn--primary btn--sm">
            <i class="fas fa-plus"></i>Nouveau solde
        </a>
    </div>
</div>

<div class="card card-table">
    <div class="card-body">
        <?php if (empty($soldes)): ?>
        <div class="empty-state">
            <span class="empty-icon"><i class="fas fa-coins"></i></span>
            <p class="empty-title">Aucun solde pour cette année.</p>
        </div>
        <?php else: ?>
        <div class="table-wrapper">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Employé</th>
                        <th>Type de congé</th>
                        <th>Attribués</th>
                        <th>Pris</th>
                        <th>Reste</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($soldes as $s): ?>
                    <tr>
                        <td><?= esc($s['prenom'] . ' ' . $s['nom']) ?></td>
                        <td><?= esc($s['libelle']) ?></td>
                        <td class="text-monospace"><?= (int) $s['jours_attribues'] ?></td>
                        <td class="text-monospace"><?= (int) $s['jours_pris'] ?></td>
                        <td>
                            <span class="badge badge--<?= $s['reste'] > 0 ? 'active' : ($s['reste'] < 0 ? 'refused' : 'inactive') ?>">
                                <?= (int) $s['reste'] ?>
                            </span>
                        </td>
                        <td class="text-end">
                            <a href="<?= base_url('admin/soldes/' . $s['id']) ?>" class="btn btn--ghost btn--sm">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>
