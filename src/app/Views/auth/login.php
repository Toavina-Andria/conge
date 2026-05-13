<?= $this->extend('Layout/app') ?>

<?= $this->section('title') ?>Connexion<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="auth-layout">
    <div class="auth-card">
        <div class="card">
            <div class="card-body" style="padding:32px;">
                <div class="auth-logo">
                    <i class="fas fa-calendar-alt me-2"></i>Gestion des Congés
                </div>

                <?php if (session()->getFlashdata('error')): ?>
                <div class="flash-message flash-message--error">
                    <i class="fas fa-exclamation-circle"></i>
                    <?= session()->getFlashdata('error') ?>
                </div>
                <?php endif; ?>

                <form action="<?= base_url('login') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-input" required autofocus>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Mot de passe</label>
                        <input type="password" name="password" class="form-input" required>
                    </div>
                    <button type="submit" class="btn btn--primary btn--block">Se connecter</button>
                </form>

                <div class="auth-footer">
                    Pas encore de compte ? <a href="<?= base_url('register') ?>">S'inscrire</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
