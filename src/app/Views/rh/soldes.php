<?= $this->extend('Layout/app') ?>
<?= $this->section('title') ?>Soldes des employés<?= $this->endSection() ?>
<?= $this->section('page_title') ?>Soldes des employés<?= $this->endSection() ?>
<?= $this->section('breadcrumb') ?><a href="<?= base_url('rh') ?>">Accueil</a> <i class="fas fa-chevron-right" style="font-size:.6rem"></i> Soldes<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="pill-filters">
    <form method="get" class="d-flex align-items-center gap-2" style="margin-left:auto">
        <select name="departement_id" class="pill-select" onchange="this.form.submit()">
            <option value="">Tous les départements</option>
            <?php foreach ($departements as $d): ?>
            <option value="<?= $d['id'] ?>" <?= $filtre_departement == $d['id'] ? 'selected' : '' ?>><?= esc($d['nom']) ?></option>
            <?php endforeach; ?>
        </select>
        <select name="annee" class="pill-select" onchange="this.form.submit()">
            <?php foreach ($annees as $a): ?>
            <option value="<?= $a ?>" <?= $a === $annee ? 'selected' : '' ?>><?= $a ?></option>
            <?php endforeach; ?>
        </select>
    </form>
</div>

<div class="data-card">
    <div class="data-card-head"><h3>Soldes par employé — <?= $annee ?></h3></div>
    <?php if (empty($employes)): ?>
    <div class="empty">
        <i class="fas fa-coins"></i>
        <p>Aucun employé actif.</p>
    </div>
    <?php else: ?>
    <table class="tbl">
        <thead>
            <tr><th>Employé</th><th>Département</th><th>Type de congé</th><th>Attribués</th><th>Pris</th><th>Reste</th></tr>
        </thead>
        <tbody>
            <?php foreach ($employes as $emp): ?>
                <?php $empSoldes = $soldes[$emp['id']] ?? []; ?>
                <?php if (empty($empSoldes)): ?>
                <tr>
                    <td>
                        <div class="profile-row">
                            <div class="avatar av-green avatar-sm"><?= strtoupper(substr($emp['prenom'] ?? '', 0, 1) . substr($emp['nom'] ?? '', 0, 1)) ?></div>
                            <div class="profile-info"><div class="pname"><?= esc($emp['prenom'] . ' ' . $emp['nom']) ?></div></div>
                        </div>
                    </td>
                    <td class="td-muted"><?= esc($emp['departement_nom'] ?? '-') ?></td>
                    <td colspan="4" class="td-muted">Aucun solde enregistré pour <?= $annee ?></td>
                </tr>
                <?php else: ?>
                    <?php foreach ($empSoldes as $i => $s): ?>
                    <tr>
                        <?php if ($i === 0): ?>
                        <td rowspan="<?= count($empSoldes) ?>">
                            <div class="profile-row">
                                <div class="avatar av-green avatar-sm"><?= strtoupper(substr($emp['prenom'] ?? '', 0, 1) . substr($emp['nom'] ?? '', 0, 1)) ?></div>
                                <div class="profile-info"><div class="pname"><?= esc($emp['prenom'] . ' ' . $emp['nom']) ?></div></div>
                            </div>
                        </td>
                        <td rowspan="<?= count($empSoldes) ?>" class="td-muted"><?= esc($emp['departement_nom'] ?? '-') ?></td>
                        <?php endif; ?>
                        <td><span class="type-badge t-<?= strpos($s['libelle'], 'annuel') !== false ? 'annuel' : (strpos($s['libelle'], 'maladie') !== false ? 'maladie' : 'special') ?>"><?= esc($s['libelle']) ?></span></td>
                        <td class="td-mono"><?= (int) $s['jours_attribues'] ?></td>
                        <td class="td-mono"><?= (int) $s['jours_pris'] ?></td>
                        <td>
                            <span class="td-mono" style="font-weight:500;color:<?= (int) $s['reste'] <= 0 ? 'var(--danger)' : ((int) $s['reste'] <= 2 ? 'var(--warn)' : 'var(--success)') ?>">
                                <?= (int) $s['reste'] ?> j
                            </span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>
