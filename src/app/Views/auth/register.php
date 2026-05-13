<?= $this->extend('Layout/app') ?>

<?= $this->section('title') ?>Inscription<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row justify-content-center align-items-center min-vh-100">
    <div class="col-md-5">
        <div class="card shadow">
            <div class="card-body p-4">
                <h4 class="text-center mb-4"><i class="fas fa-user-plus me-2"></i>Créer un compte</h4>

                <form action="<?= base_url('register') ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" name="nom" id="nom" class="form-control <?= $validation && $validation->hasError('nom') ? 'is-invalid' : '' ?>" value="<?= old('nom') ?>" required>
                            <?php if ($validation && $validation->hasError('nom')): ?>
                                <div class="invalid-feedback"><?= $validation->getError('nom') ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="prenom" class="form-label">Prénom</label>
                            <input type="text" name="prenom" id="prenom" class="form-control <?= $validation && $validation->hasError('prenom') ? 'is-invalid' : '' ?>" value="<?= old('prenom') ?>" required>
                            <?php if ($validation && $validation->hasError('prenom')): ?>
                                <div class="invalid-feedback"><?= $validation->getError('prenom') ?></div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control <?= $validation && $validation->hasError('email') ? 'is-invalid' : '' ?>" value="<?= old('email') ?>" required>
                        <?php if ($validation && $validation->hasError('email')): ?>
                            <div class="invalid-feedback"><?= $validation->getError('email') ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label for="departement_id" class="form-label">Département</label>
                        <select name="departement_id" id="departement_id" class="form-select <?= $validation && $validation->hasError('departement_id') ? 'is-invalid' : '' ?>" required>
                            <option value="">— Sélectionner —</option>
                            <?php foreach ($departements as $d): ?>
                                <option value="<?= $d['id'] ?>" <?= old('departement_id') == $d['id'] ? 'selected' : '' ?>>
                                    <?= esc($d['nom']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?php if ($validation && $validation->hasError('departement_id')): ?>
                            <div class="invalid-feedback"><?= $validation->getError('departement_id') ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="password" class="form-label">Mot de passe</label>
                            <input type="password" name="password" id="password" class="form-control <?= $validation && $validation->hasError('password') ? 'is-invalid' : '' ?>" required>
                            <?php if ($validation && $validation->hasError('password')): ?>
                                <div class="invalid-feedback"><?= $validation->getError('password') ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="password_confirm" class="form-label">Confirmer</label>
                            <input type="password" name="password_confirm" id="password_confirm" class="form-control <?= $validation && $validation->hasError('password_confirm') ? 'is-invalid' : '' ?>" required>
                            <?php if ($validation && $validation->hasError('password_confirm')): ?>
                                <div class="invalid-feedback"><?= $validation->getError('password_confirm') ?></div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success w-100">Créer mon compte</button>
                </form>

                <p class="text-center mt-3 mb-0">
                    Déjà un compte ? <a href="<?= base_url('login') ?>">Se connecter</a>
                </p>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
