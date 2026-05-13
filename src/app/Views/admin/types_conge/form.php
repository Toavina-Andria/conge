<?= $this->extend('Layout/app') ?>
<?= $this->section('title') ?><?= $type ? 'Modifier' : 'Nouveau' ?> type de congé<?= $this->endSection() ?>
<?= $this->section('page_title') ?><?= $type ? 'Modifier le type de congé' : 'Nouveau type de congé' ?><?= $this->endSection() ?>
<?= $this->section('breadcrumb') ?><a href="<?= base_url('admin') ?>">Admin</a> <i class="fas fa-chevron-right" style="font-size:.6rem"></i> <a href="<?= base_url('admin/types-conge') ?>">Types</a> <i class="fas fa-chevron-right" style="font-size:.6rem"></i> <?= $type ? 'Modifier' : 'Nouveau' ?><?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="form-section">
    <h3><i class="fas fa-tag" style="color:var(--forest);margin-right:6px"></i><?= $type ? 'Modifier le type de congé' : 'Nouveau type de congé' ?></h3>

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

    <form action="<?= base_url($type ? 'admin/types-conge/' . $type['id'] : 'admin/types-conge/creer') ?>" method="POST">
        <?= csrf_field() ?>
        <div class="form-grid-2">
            <div class="f-group">
                <label class="f-label">Libellé <span class="required">*</span></label>
                <input type="text" name="libelle" class="f-input" value="<?= old('libelle', $type['libelle'] ?? '') ?>" required>
            </div>
            <div class="f-group">
                <label class="f-label">Jours annuels <span class="required">*</span></label>
                <input type="number" name="jours_annuels" class="f-input" value="<?= old('jours_annuels', $type['jours_annuels'] ?? '') ?>" required min="1">
            </div>
            <div class="f-group">
                <label class="f-label">Déductible du solde</label>
                <select name="deductible" class="f-select">
                    <option value="1" <?= old('deductible', $type['deductible'] ?? '1') == 1 ? 'selected' : '' ?>>Oui</option>
                    <option value="0" <?= old('deductible', $type['deductible'] ?? '1') == 0 ? 'selected' : '' ?>>Non</option>
                </select>
            </div>
        </div>
        <div class="form-actions">
            <a href="<?= base_url('admin/types-conge') ?>" class="btn-secondary"><i class="fas fa-arrow-left"></i> Annuler</a>
            <button type="submit" class="btn-forest"><i class="fas fa-save"></i> <?= $type ? 'Enregistrer' : 'Créer' ?></button>
        </div>
    </form>
</div>
<?= $this->endSection() ?>
