<?= $this->extend('Layout/app') ?>

<?= $this->section('title') ?>Mon profil<?= $this->endSection() ?>
<?= $this->section('page_title') ?>Mon profil<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card shadow">
    <div class="card-body">
        <form action="<?= base_url('employe/profil') ?>" method="POST">
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

            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label">Département</label>
                    <input type="text" class="form-control" value="<?= esc($employe_info['departement_nom'] ?? '-') ?>" disabled>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Rôle</label>
                    <input type="text" class="form-control" value="<?= $employe_info['role'] === 'admin' ? 'Admin' : ($employe_info['role'] === 'rh' ? 'RH' : 'Employé') ?>" disabled>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Date d'embauche</label>
                    <input type="text" class="form-control" value="<?= date('d/m/Y', strtotime($employe_info['date_embauche'])) ?>" disabled>
                </div>
            </div>

            <hr>
            <h6>Informations modifiables</h6>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Prénom <span class="text-danger">*</span></label>
                    <input type="text" name="prenom" class="form-control" value="<?= old('prenom', $employe_info['prenom']) ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nom <span class="text-danger">*</span></label>
                    <input type="text" name="nom" class="form-control" value="<?= old('nom', $employe_info['nom']) ?>" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Email <span class="text-danger">*</span></label>
                <input type="email" name="email" class="form-control" value="<?= old('email', $employe_info['email']) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Nouveau mot de passe <small class="text-muted">(laisser vide pour ne pas changer)</small></label>
                <input type="password" name="password" class="form-control" minlength="6">
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i>Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
