<?= $this->extend('Layout/app') ?>

<?= $this->section('title') ?><?= $type ? 'Modifier' : 'Nouveau' ?> type de congé<?= $this->endSection() ?>
<?= $this->section('page_title') ?><?= $type ? 'Modifier le type de congé' : 'Nouveau type de congé' ?><?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-body">
        <form action="<?= base_url($type ? 'admin/types-conge/' . $type['id'] : 'admin/types-conge/creer') ?>" method="POST">
            <?= csrf_field() ?>

            <?php if ($validation): ?>
            <div class="flash-message flash-message--error">
                <i class="fas fa-exclamation-circle"></i>
                <ul class="mb-0" style="list-style:none;padding:0;margin:0">
                <?php foreach ($validation as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>

            <div class="form-group">
                <label class="form-label">Libellé <span class="required">*</span></label>
                <input type="text" name="libelle" class="form-input" value="<?= old('libelle', $type['libelle'] ?? '') ?>" required>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Jours annuels <span class="required">*</span></label>
                    <input type="number" name="jours_annuels" class="form-input" value="<?= old('jours_annuels', $type['jours_annuels'] ?? '') ?>" required min="1">
                </div>
                <div class="form-group">
                    <label class="form-label">Déductible du solde</label>
                    <select name="deductible" class="form-select">
                        <option value="1" <?= old('deductible', $type['deductible'] ?? '1') == 1 ? 'selected' : '' ?>>Oui</option>
                        <option value="0" <?= old('deductible', $type['deductible'] ?? '1') == 0 ? 'selected' : '' ?>>Non</option>
                    </select>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <a href="<?= base_url('admin/types-conge') ?>" class="btn btn--secondary">Annuler</a>
                <button type="submit" class="btn btn--primary">
                    <i class="fas fa-save"></i><?= $type ? 'Enregistrer' : 'Créer' ?>
                </button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
