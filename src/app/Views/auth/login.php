<?= $this->extend('Layout/app') ?>

<?= $this->section('title') ?>Connexion<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row justify-content-center align-items-center min-vh-100">
    <div class="col-md-4">
        <div class="card shadow">
            <div class="card-body p-4">
                <h4 class="text-center mb-4"><i class="fas fa-calendar-alt me-2"></i>Gestion des Congés</h4>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                <?php endif; ?>

                <form action="<?= base_url('login') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" required autofocus>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Se connecter</button>
                </form>

                <p class="text-center mt-3 mb-0">
                    Pas encore de compte ? <a href="<?= base_url('register') ?>">S'inscrire</a>
                </p>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
