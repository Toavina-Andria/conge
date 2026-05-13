<?= $this->extend('Layout/app') ?>
<?= $this->section('title') ?>Inscription<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="auth-split" style="grid-template-columns:1fr 500px">
    <div class="auth-left">
        <div>
            <p class="auth-left-brand">TechMada RH<span>Gestion des congés</span></p>
            <p class="auth-left-text" style="margin-top:2rem">
                <strong>Créez votre compte employé.</strong>
                Remplissez le formulaire pour rejoindre la plateforme de gestion des congés TechMada.
            </p>
        </div>
    </div>
    <div class="auth-right">
        <p class="auth-title">Inscription</p>
        <p class="auth-sub">Créez votre compte pour accéder à l'espace employé.</p>

        <form action="<?= base_url('register') ?>" method="post">
            <?= csrf_field() ?>
            <div class="form-grid-2">
                <div class="f-group">
                    <label class="f-label">Nom <span class="required">*</span></label>
                    <input type="text" name="nom" class="f-input <?= $validation && $validation->hasError('nom') ? 'is-invalid' : '' ?>" value="<?= old('nom') ?>" placeholder="Rakoto" required>
                    <?php if ($validation && $validation->hasError('nom')): ?>
                    <div class="f-error"><?= $validation->getError('nom') ?></div>
                    <?php endif; ?>
                </div>
                <div class="f-group">
                    <label class="f-label">Prénom <span class="required">*</span></label>
                    <input type="text" name="prenom" class="f-input <?= $validation && $validation->hasError('prenom') ? 'is-invalid' : '' ?>" value="<?= old('prenom') ?>" placeholder="Soa" required>
                    <?php if ($validation && $validation->hasError('prenom')): ?>
                    <div class="f-error"><?= $validation->getError('prenom') ?></div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="f-group">
                <label class="f-label">Email <span class="required">*</span></label>
                <input type="email" name="email" class="f-input <?= $validation && $validation->hasError('email') ? 'is-invalid' : '' ?>" value="<?= old('email') ?>" placeholder="soa.rakoto@techmada.mg" required>
                <?php if ($validation && $validation->hasError('email')): ?>
                <div class="f-error"><?= $validation->getError('email') ?></div>
                <?php endif; ?>
            </div>

            <div class="f-group">
                <label class="f-label">Département <span class="required">*</span></label>
                <select name="departement_id" class="f-select <?= $validation && $validation->hasError('departement_id') ? 'is-invalid' : '' ?>" required>
                    <option value="">— Sélectionner —</option>
                    <?php foreach ($departements as $d): ?>
                    <option value="<?= $d['id'] ?>" <?= old('departement_id') == $d['id'] ? 'selected' : '' ?>>
                        <?= esc($d['nom']) ?>
                    </option>
                    <?php endforeach; ?>
                </select>
                <?php if ($validation && $validation->hasError('departement_id')): ?>
                <div class="f-error"><?= $validation->getError('departement_id') ?></div>
                <?php endif; ?>
            </div>

            <div class="form-grid-2">
                <div class="f-group">
                    <label class="f-label">Mot de passe <span class="required">*</span></label>
                    <input type="password" name="password" class="f-input <?= $validation && $validation->hasError('password') ? 'is-invalid' : '' ?>" placeholder="••••••••" required>
                    <?php if ($validation && $validation->hasError('password')): ?>
                    <div class="f-error"><?= $validation->getError('password') ?></div>
                    <?php endif; ?>
                </div>
                <div class="f-group">
                    <label class="f-label">Confirmer <span class="required">*</span></label>
                    <input type="password" name="password_confirm" class="f-input <?= $validation && $validation->hasError('password_confirm') ? 'is-invalid' : '' ?>" placeholder="••••••••" required>
                    <?php if ($validation && $validation->hasError('password_confirm')): ?>
                    <div class="f-error"><?= $validation->getError('password_confirm') ?></div>
                    <?php endif; ?>
                </div>
            </div>

            <button type="submit" class="btn-primary" style="margin-top:.5rem">
                Créer mon compte <i class="fas fa-arrow-right"></i>
            </button>
        </form>

        <div class="auth-footer" style="text-align:center;margin-top:1.25rem;font-size:.8rem;color:var(--muted)">
            Déjà un compte ? <a href="<?= base_url('login') ?>" style="color:var(--forest);font-weight:500">Se connecter</a>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
