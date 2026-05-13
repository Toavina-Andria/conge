<?= $this->extend('Layout/app') ?>

<?= $this->section('title') ?>Soldes annuels<?= $this->endSection() ?>
<?= $this->section('page_title') ?>Soldes annuels<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0">Soldes par année</h5>
    <div class="d-flex align-items-center gap-2">
        <form method="GET" class="d-flex align-items-center gap-2">
            <label class="form-label mb-0">Année :</label>
            <select name="annee" class="form-select form-select-sm" style="width: auto;" onchange="this.form.submit()">
                <?php foreach ($annees as $a): ?>
                <option value="<?= $a ?>" <?= $a === $annee ? 'selected' : '' ?>><?= $a ?></option>
                <?php endforeach; ?>
            </select>
        </form>
        <a href="<?= base_url('admin/soldes/creer') ?>" class="btn btn-primary btn-sm">
            <i class="fas fa-plus me-1"></i>Nouveau solde
        </a>
    </div>
</div>

<div class="card shadow">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
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
                <?php if (empty($soldes)): ?>
                <tr><td colspan="6" class="text-center text-muted py-3">Aucun solde pour cette année.</td></tr>
                <?php else: ?>
                <?php foreach ($soldes as $s): ?>
                <tr>
                    <td><?= esc($s['prenom'] . ' ' . $s['nom']) ?></td>
                    <td><?= esc($s['libelle']) ?></td>
                    <td><?= (int) $s['jours_attribues'] ?></td>
                    <td><?= (int) $s['jours_pris'] ?></td>
                    <td>
                        <span class="badge bg-<?= $s['reste'] > 0 ? 'success' : ($s['reste'] < 0 ? 'danger' : 'secondary') ?>">
                            <?= (int) $s['reste'] ?>
                        </span>
                    </td>
                    <td class="text-end">
                        <a href="<?= base_url('admin/soldes/' . $s['id']) ?>" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-edit"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
