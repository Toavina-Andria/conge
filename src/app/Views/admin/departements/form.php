<?= $this->extend('Layout/app') ?>

<?= $this->section('title') ?><?= $departement ? 'Modifier' : 'Nouveau' ?> département<?= $this->endSection() ?>
<?= $this->section('page_title') ?><?= $departement ? 'Modifier le département' : 'Nouveau département' ?><?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-body">
        <form action="<?= base_url($departement ? 'admin/departements/' . $departement['id'] : 'admin/departements/creer') ?>" method="POST">
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
                <label class="form-label">Nom <span class="required">*</span></label>
                <input type="text" name="nom" class="form-input" value="<?= old('nom', $departement['nom'] ?? '') ?>" required>
            </div>

            <div class="form-group">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-textarea" rows="3"><?= old('description', $departement['description'] ?? '') ?></textarea>
            </div>

            <div class="d-flex justify-content-between">
                <a href="<?= base_url('admin/departements') ?>" class="btn btn--secondary">Annuler</a>
                <button type="submit" class="btn btn--primary">
                    <i class="fas fa-save"></i><?= $departement ? 'Enregistrer' : 'Créer' ?>
                </button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
