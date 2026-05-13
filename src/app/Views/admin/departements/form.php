<?= $this->extend('Layout/app') ?>
<?= $this->section('title') ?><?= $departement ? 'Modifier' : 'Nouveau' ?> département<?= $this->endSection() ?>
<?= $this->section('page_title') ?><?= $departement ? 'Modifier le département' : 'Nouveau département' ?><?= $this->endSection() ?>
<?= $this->section('breadcrumb') ?><a href="<?= base_url('admin') ?>">Admin</a> <i class="fas fa-chevron-right" style="font-size:.6rem"></i> <a href="<?= base_url('admin/departements') ?>">Départements</a> <i class="fas fa-chevron-right" style="font-size:.6rem"></i> <?= $departement ? 'Modifier' : 'Nouveau' ?><?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="form-section">
    <h3><i class="fas fa-building" style="color:var(--forest);margin-right:6px"></i><?= $departement ? 'Modifier le département' : 'Nouveau département' ?></h3>

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

    <form action="<?= base_url($departement ? 'admin/departements/' . $departement['id'] : 'admin/departements/creer') ?>" method="POST">
        <?= csrf_field() ?>
        <div class="f-group">
            <label class="f-label">Nom <span class="required">*</span></label>
            <input type="text" name="nom" class="f-input" value="<?= old('nom', $departement['nom'] ?? '') ?>" required>
        </div>
        <div class="f-group">
            <label class="f-label">Description</label>
            <textarea name="description" class="f-textarea" rows="3"><?= old('description', $departement['description'] ?? '') ?></textarea>
        </div>
        <div class="form-actions">
            <a href="<?= base_url('admin/departements') ?>" class="btn-secondary"><i class="fas fa-arrow-left"></i> Annuler</a>
            <button type="submit" class="btn-forest"><i class="fas fa-save"></i> <?= $departement ? 'Enregistrer' : 'Créer' ?></button>
        </div>
    </form>
</div>
<?= $this->endSection() ?>
