<?= $this->extend('Layout/app') ?>
<?= $this->section('title') ?>Connexion<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="auth-split">
    <div class="auth-left">
        <div>
            <p class="auth-left-brand">TechMada RH <span>Gestion des congés</span>
        <b>ETU004055 & ETU4235</b></p>
            <p class="auth-left-text" style="margin-top:2rem">
                <strong>Bienvenue sur votre espace RH.</strong>
                Gérez vos demandes de congés, consultez votre solde et suivez l'état de vos demandes en temps réel.
            </p>
        </div>
        <div class="auth-roles">
            <div style="font-size:.65rem;text-transform:uppercase;letter-spacing:1px;color:rgba(255,255,255,.25);margin-bottom:4px">Comptes de démonstration</div>
            <div class="role-pill">
                <i class="fas fa-shield-alt"></i>
                <div><div class="role-pill-name">Administrateur</div><div class="role-pill-cred">admin@techmada.mg · admin123</div></div>
            </div>
            <div class="role-pill">
                <i class="fas fa-user-tie"></i>
                <div><div class="role-pill-name">Responsable RH</div><div class="role-pill-cred">rh@techmada.mg · rh123</div></div>
            </div>
            <div class="role-pill">
                <i class="fas fa-user"></i>
                <div><div class="role-pill-name">Employé</div><div class="role-pill-cred">employe@techmada.mg · emp123</div></div>
            </div>
        </div>
    </div>
    <div class="auth-right">
        <p class="auth-title">Connexion</p>
        <p class="auth-sub">Entrez vos identifiants pour accéder à votre espace.</p>

        <form action="<?= base_url('login') ?>" method="post">
            <?= csrf_field() ?>
            <div class="f-group">
                <label class="f-label">Adresse email</label>
                <input type="email" name="email" class="f-input" placeholder="vous@techmada.mg" required autofocus>
            </div>
            <div class="f-group">
                <label class="f-label">Mot de passe</label>
                <input type="password" name="password" class="f-input" placeholder="••••••••" required>
            </div>
            <button type="submit" class="btn-primary" style="margin-top:.5rem">
                Se connecter <i class="fas fa-arrow-right"></i>
            </button>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
