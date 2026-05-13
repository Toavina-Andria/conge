<?= $this->extend('Layout/app') ?>
<?= $this->section('title') ?><?= $solde ? 'Modifier' : 'Nouveau' ?> solde<?= $this->endSection() ?>
<?= $this->section('page_title') ?><?= $solde ? 'Modifier le solde' : 'Nouveau solde' ?><?= $this->endSection() ?>
<?= $this->section('breadcrumb') ?><a href="<?= base_url('admin') ?>">Admin</a> <i class="fas fa-chevron-right" style="font-size:.6rem"></i> <a href="<?= base_url('admin/soldes') ?>">Soldes</a> <i class="fas fa-chevron-right" style="font-size:.6rem"></i> <?= $solde ? 'Modifier' : 'Nouveau' ?><?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="form-section">
    <h3><i class="fas fa-coins" style="color:var(--forest);margin-right:6px"></i><?= $solde ? 'Modifier le solde' : 'Nouveau solde' ?></h3>

    <?php if ($validation): ?>
    <div class="flash flash-error">
        <i class="fas fa-exclamation-circle"></i>
        <ul style="list-style:none;padding:0;margin:0">
        <?php foreach ($validation as $error): ?>
            <li><?= esc($error) ?></li>
        <?php endforeach; ?>
        </ul>
    </div>
    <?php endif; ?>

    <form action="<?= base_url($solde ? 'admin/soldes/' . $solde['id'] : 'admin/soldes/creer') ?>" method="POST">
        <?= csrf_field() ?>

        <?php if ($solde): ?>
        <table class="detail-table" style="margin-bottom:1rem">
            <tr><th>Employé</th><td><?= esc($solde['prenom'] . ' ' . $solde['nom']) ?></td></tr>
            <tr><th>Type de congé</th><td><?= esc($solde['libelle']) ?></td></tr>
            <tr><th>Année</th><td class="td-mono"><?= (int) $solde['annee'] ?></td></tr>
        </table>
        <input type="hidden" name="annee" value="<?= $solde['annee'] ?>">
        <?php else: ?>
        <div class="form-grid-3">
            <div class="f-group">
                <label class="f-label">Employé <span class="required">*</span></label>
                <select name="employe_id" class="f-select" required>
                    <option value="">— Sélectionner —</option>
                    <?php foreach ($employes as $emp): ?>
                    <option value="<?= $emp['id'] ?>" <?= old('employe_id') == $emp['id'] ? 'selected' : '' ?>>
                        <?= esc($emp['prenom'] . ' ' . $emp['nom']) ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="f-group">
                <label class="f-label">Type de congé <span class="required">*</span></label>
                <select name="type_conge_id" class="f-select" required>
                    <option value="">— Sélectionner —</option>
                    <?php foreach ($types as $t): ?>
                    <option value="<?= $t['id'] ?>" <?= old('type_conge_id') == $t['id'] ? 'selected' : '' ?>>
                        <?= esc($t['libelle']) ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="f-group">
                <label class="f-label">Année <span class="required">*</span></label>
                <input type="number" name="annee" class="f-input" value="<?= old('annee', $annee) ?>" required min="2000" max="2099">
            </div>
        </div>
        <?php endif; ?>

        <div class="form-grid-2">
            <div class="f-group">
                <label class="f-label">Jours attribués <span class="required">*</span></label>
                <input type="number" name="jours_attribues" class="f-input" value="<?= old('jours_attribues', $solde['jours_attribues'] ?? '') ?>" required min="0">
            </div>
            <div class="f-group">
                <label class="f-label">Jours pris</label>
                <input type="number" name="jours_pris" class="f-input" value="<?= old('jours_pris', $solde['jours_pris'] ?? 0) ?>" min="0">
            </div>
        </div>

        <div class="form-actions">
            <a href="<?= base_url('admin/soldes' . ($solde ? '?annee=' . $solde['annee'] : '')) ?>" class="btn-secondary"><i class="fas fa-arrow-left"></i> Annuler</a>
            <button type="submit" class="btn-forest"><i class="fas fa-save"></i> <?= $solde ? 'Enregistrer' : 'Créer' ?></button>
        </div>
    </form>
</div>
<?= $this->endSection() ?>
