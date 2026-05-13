<?= $this->extend('Layout/app') ?>

<?= $this->section('title') ?>Soldes des employés<?= $this->endSection() ?>
<?= $this->section('page_title') ?>Soldes des employés<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="content-header">
    <h5>Soldes par employé</h5>
    <form method="GET" class="d-flex align-items-center gap-2">
        <select name="departement_id" class="form-select" style="width:auto;min-width:160px;" onchange="this.form.submit()">
            <option value="">Tous les départements</option>
            <?php foreach ($departements as $d): ?>
            <option value="<?= $d['id'] ?>" <?= $filtre_departement == $d['id'] ? 'selected' : '' ?>>
                <?= esc($d['nom']) ?>
            </option>
            <?php endforeach; ?>
        </select>
        <select name="annee" class="form-select" style="width:auto;min-width:100px;" onchange="this.form.submit()">
            <?php foreach ($annees as $a): ?>
            <option value="<?= $a ?>" <?= $a === $annee ? 'selected' : '' ?>><?= $a ?></option>
            <?php endforeach; ?>
        </select>
    </form>
</div>

<div class="card card-table">
    <div class="card-body">
        <?php if (empty($employes)): ?>
        <div class="empty-state">
            <span class="empty-icon"><i class="fas fa-coins"></i></span>
            <p class="empty-title">Aucun employé actif.</p>
        </div>
        <?php else: ?>
        <div class="table-wrapper">
            <table class="data-table">
                <thead>
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
                                <td class="text-monospace"><?= (int) $s['jours_attribues'] ?></td>
                                <td class="text-monospace"><?= (int) $s['jours_pris'] ?></td>
                                <td>
                                    <span class="badge badge--<?= $s['reste'] > 0 ? 'active' : ($s['reste'] < 0 ? 'refused' : 'inactive') ?>">
                                        <?= (int) $s['reste'] ?>
                                    </span>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>
