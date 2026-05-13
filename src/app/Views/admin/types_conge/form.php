<?= $this->extend('Layout/app') ?>

<?= $this->section('title') ?><?= $type ? 'Modifier' : 'Nouveau' ?> type de congé<?= $this->endSection() ?>
<?= $this->section('page_title') ?><?= $type ? 'Modifier le type de congé' : 'Nouveau type de congé' ?><?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card shadow">
    <div class="card-body">
        <form action="<?= base_url($type ? 'admin/types-conge/' . $type['id'] : 'admin/types-conge/creer') ?>" method="POST">
            <?= csrf_field() ?>

            <?php if ($validation): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                <?php foreach ($validation as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>

            <div class="mb-3">
                <label class="form-label">Libellé <span class="text-danger">*</span></label>
                <input type="text" name="libelle" class="form-control" value="<?= old('libelle', $type['libelle'] ?? '') ?>" required>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Jours annuels <span class="text-danger">*</span></label>
                    <input type="number" name="jours_annuels" class="form-control" value="<?= old('jours_annuels', $type['jours_annuels'] ?? '') ?>" required min="1">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Déductible du solde</label>
                    <select name="deductible" class="form-select">
                        <option value="1" <?= old('deductible', $type['deductible'] ?? '1') == 1 ? 'selected' : '' ?>>Oui</option>
                        <option value="0" <?= old('deductible', $type['deductible'] ?? '1') == 0 ? 'selected' : '' ?>>Non</option>
                    </select>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <a href="<?= base_url('admin/types-conge') ?>" class="btn btn-secondary">Annuler</a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i><?= $type ? 'Enregistrer' : 'Créer' ?>
                </button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
