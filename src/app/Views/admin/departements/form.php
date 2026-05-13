<?= $this->extend('Layout/app') ?>

<?= $this->section('title') ?><?= $departement ? 'Modifier' : 'Nouveau' ?> département<?= $this->endSection() ?>
<?= $this->section('page_title') ?><?= $departement ? 'Modifier le département' : 'Nouveau département' ?><?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card shadow">
    <div class="card-body">
        <form action="<?= base_url($departement ? 'admin/departements/' . $departement['id'] : 'admin/departements/creer') ?>" method="POST">
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
                <label class="form-label">Nom <span class="text-danger">*</span></label>
                <input type="text" name="nom" class="form-control" value="<?= old('nom', $departement['nom'] ?? '') ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="3"><?= old('description', $departement['description'] ?? '') ?></textarea>
            </div>

            <div class="d-flex justify-content-between">
                <a href="<?= base_url('admin/departements') ?>" class="btn btn-secondary">Annuler</a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i><?= $departement ? 'Enregistrer' : 'Créer' ?>
                </button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
