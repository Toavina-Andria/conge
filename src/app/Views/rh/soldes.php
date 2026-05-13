<?= $this->extend('Layout/app') ?>

<?= $this->section('title') ?>Soldes des employés<?= $this->endSection() ?>
<?= $this->section('page_title') ?>Soldes des employés<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0">Soldes par employé</h5>
    <form method="GET" class="d-flex align-items-center gap-2">
        <select name="departement_id" class="form-select form-select-sm" style="width: auto;" onchange="this.form.submit()">
            <option value="">Tous les départements</option>
            <?php foreach ($departements as $d): ?>
            <option value="<?= $d['id'] ?>" <?= $filtre_departement == $d['id'] ? 'selected' : '' ?>>
                <?= esc($d['nom']) ?>
            </option>
            <?php endforeach; ?>
        </select>
        <select name="annee" class="form-select form-select-sm" style="width: auto;" onchange="this.form.submit()">
            <?php foreach ($annees as $a): ?>
            <option value="<?= $a ?>" <?= $a === $annee ? 'selected' : '' ?>><?= $a ?></option>
            <?php endforeach; ?>
        </select>
    </form>
</div>

<div class="card shadow">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Employé</th>
                    <th>Département</th>
                    <th>Type de congé</th>
                    <th>Attribués</th>
                    <th>Pris</th>
                    <th>Reste</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($employes)): ?>
                <tr><td colspan="6" class="text-center text-muted py-3">Aucun employé actif.</td></tr>
                <?php else: ?>
                <?php foreach ($employes as $emp): ?>
                    <?php $empSoldes = $soldes[$emp['id']] ?? []; ?>
                    <?php if (empty($empSoldes)): ?>
                    <tr>
                        <td><?= esc($emp['prenom'] . ' ' . $emp['nom']) ?></td>
                        <td><?= esc($emp['departement_nom'] ?? '-') ?></td>
                        <td colspan="4" class="text-muted">Aucun solde enregistré pour <?= $annee ?></td>
                    </tr>
                    <?php else: ?>
                        <?php foreach ($empSoldes as $i => $s): ?>
                        <tr>
                            <?php if ($i === 0): ?>
                            <td rowspan="<?= count($empSoldes) ?>"><?= esc($emp['prenom'] . ' ' . $emp['nom']) ?></td>
                            <td rowspan="<?= count($empSoldes) ?>"><?= esc($emp['departement_nom'] ?? '-') ?></td>
                            <?php endif; ?>
                            <td><?= esc($s['libelle']) ?></td>
                            <td><?= (int) $s['jours_attribues'] ?></td>
                            <td><?= (int) $s['jours_pris'] ?></td>
                            <td>
                                <span class="badge bg-<?= $s['reste'] > 0 ? 'success' : ($s['reste'] < 0 ? 'danger' : 'secondary') ?>">
                                    <?= (int) $s['reste'] ?>
                                </span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
