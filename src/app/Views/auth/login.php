<?= $this->extend('Layout/app') ?>

<?= $this->section('title') ?>Connexion<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="auth-layout">
    <div class="auth-card">
        <div class="card auth-card--highlight">
            <div class="card-body auth-card-body">
                <div class="auth-logo">
                    <div class="auth-logo-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <h2>Gestion des Congés</h2>
                    <p class="auth-tagline">Connectez-vous à votre espace</p>
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
                        <input type="email" name="email" class="form-input" placeholder="vous@exemple.com" required autofocus>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Mot de passe</label>
                        <input type="password" name="password" class="form-input" placeholder="••••••••" required>
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
