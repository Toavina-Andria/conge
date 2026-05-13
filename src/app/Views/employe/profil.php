<?= $this->extend('Layout/app') ?>

<?= $this->section('title') ?>Mon profil<?= $this->endSection() ?>
<?= $this->section('page_title') ?>Mon profil<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-body">
        <form action="<?= base_url('employe/profil') ?>" method="POST">
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

            <div class="form-row form-row-3">
                <div class="form-group">
                    <label class="form-label">Département</label>
                    <input type="text" class="form-input" value="<?= esc($employe_info['departement_nom'] ?? '-') ?>" disabled style="background:#F9FAFB;">
                </div>
                <div class="form-group">
                    <label class="form-label">Rôle</label>
                    <input type="text" class="form-input" value="<?= $employe_info['role'] === 'admin' ? 'Admin' : ($employe_info['role'] === 'rh' ? 'RH' : 'Employé') ?>" disabled style="background:#F9FAFB;">
                </div>
                <div class="form-group">
                    <label class="form-label">Date d'embauche</label>
                    <input type="text" class="form-input" value="<?= date('d/m/Y', strtotime($employe_info['date_embauche'])) ?>" disabled style="background:#F9FAFB;">
                </div>
            </div>

            <hr style="border-color:var(--color-border);margin:20px 0;">

            <h6 style="font-size:14px;font-weight:600;margin-bottom:16px;">Informations modifiables</h6>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Prénom <span class="required">*</span></label>
                    <input type="text" name="prenom" class="form-input" value="<?= old('prenom', $employe_info['prenom']) ?>" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Nom <span class="required">*</span></label>
                    <input type="text" name="nom" class="form-input" value="<?= old('nom', $employe_info['nom']) ?>" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Email <span class="required">*</span></label>
                <input type="email" name="email" class="form-input" value="<?= old('email', $employe_info['email']) ?>" required>
            </div>

            <div class="form-group">
                <label class="form-label">Nouveau mot de passe <span class="text-muted">(laisser vide pour ne pas changer)</span></label>
                <input type="password" name="password" class="form-input" minlength="6">
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn--primary">
                    <i class="fas fa-save"></i>Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
