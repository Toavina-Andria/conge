<?= $this->extend('Layout/app') ?>

<?= $this->section('title') ?>Inscription<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="auth-layout">
    <div class="auth-card" style="max-width:520px;">
        <div class="card">
            <div class="card-body" style="padding:32px;">
                <div class="auth-logo">
                    <i class="fas fa-user-plus me-2"></i>Créer un compte
                </div>

                <form action="<?= base_url('register') ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Nom</label>
                            <input type="text" name="nom" class="form-input <?= $validation && $validation->hasError('nom') ? 'is-invalid' : '' ?>" value="<?= old('nom') ?>" required>
                            <?php if ($validation && $validation->hasError('nom')): ?>
                            <span class="invalid-feedback"><?= $validation->getError('nom') ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Prénom</label>
                            <input type="text" name="prenom" class="form-input <?= $validation && $validation->hasError('prenom') ? 'is-invalid' : '' ?>" value="<?= old('prenom') ?>" required>
                            <?php if ($validation && $validation->hasError('prenom')): ?>
                            <span class="invalid-feedback"><?= $validation->getError('prenom') ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-input <?= $validation && $validation->hasError('email') ? 'is-invalid' : '' ?>" value="<?= old('email') ?>" required>
                        <?php if ($validation && $validation->hasError('email')): ?>
                        <span class="invalid-feedback"><?= $validation->getError('email') ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Département</label>
                        <select name="departement_id" class="form-select <?= $validation && $validation->hasError('departement_id') ? 'is-invalid' : '' ?>" required>
                            <option value="">— Sélectionner —</option>
                            <?php foreach ($departements as $d): ?>
                            <option value="<?= $d['id'] ?>" <?= old('departement_id') == $d['id'] ? 'selected' : '' ?>>
                                <?= esc($d['nom']) ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                        <?php if ($validation && $validation->hasError('departement_id')): ?>
                        <span class="invalid-feedback"><?= $validation->getError('departement_id') ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Mot de passe</label>
                            <input type="password" name="password" class="form-input <?= $validation && $validation->hasError('password') ? 'is-invalid' : '' ?>" required>
                            <?php if ($validation && $validation->hasError('password')): ?>
                            <span class="invalid-feedback"><?= $validation->getError('password') ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Confirmer</label>
                            <input type="password" name="password_confirm" class="form-input <?= $validation && $validation->hasError('password_confirm') ? 'is-invalid' : '' ?>" required>
                            <?php if ($validation && $validation->hasError('password_confirm')): ?>
                            <span class="invalid-feedback"><?= $validation->getError('password_confirm') ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <button type="submit" class="btn btn--primary btn--block">Créer mon compte</button>
                </form>

                <div class="auth-footer">
                    Déjà un compte ? <a href="<?= base_url('login') ?>">Se connecter</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
