<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->renderSection('title') ?: 'Gestion des Congés' ?></title>
    <link href="<?= base_url('css/app.css') ?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>
<body>
<div class="app-layout">
    <?php if ($employe): ?>
    <nav class="sidebar">
        <div class="sidebar-logo">
            <h5><i class="fas fa-calendar-alt me-2"></i>Congés</h5>
            <small>TechMada</small>
        </div>

        <div class="sidebar-user">
            <div class="user-avatar">
                <?= strtoupper(substr($employe['prenom'] ?? '', 0, 1) . substr($employe['nom'] ?? '', 0, 1)) ?>
            </div>
            <span class="user-name"><?= esc($employe['prenom'] . ' ' . $employe['nom']) ?></span>
            <span class="user-role-badge role-<?= $role ?>">
                <?= $role === 'admin' ? 'Admin' : ($role === 'rh' ? 'RH' : 'Employé') ?>
            </span>
        </div>

        <ul class="sidebar-nav">
            <?php if ($role === 'admin'): ?>
                <li class="nav-item">
                    <a href="<?= base_url('admin') ?>" class="nav-link <?= current_url() === base_url('admin') ? 'active' : '' ?>">
                        <i class="fas fa-tachometer-alt"></i>Tableau de bord
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('admin/employes') ?>" class="nav-link <?= strpos(current_url(), '/admin/employes') !== false ? 'active' : '' ?>">
                        <i class="fas fa-users"></i>Employés
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('admin/demandes') ?>" class="nav-link <?= strpos(current_url(), '/admin/demandes') !== false ? 'active' : '' ?>">
                        <i class="fas fa-calendar-check"></i>Demandes
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('admin/departements') ?>" class="nav-link <?= strpos(current_url(), '/admin/departements') !== false ? 'active' : '' ?>">
                        <i class="fas fa-building"></i>Départements
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('admin/types-conge') ?>" class="nav-link <?= strpos(current_url(), '/admin/types-conge') !== false ? 'active' : '' ?>">
                        <i class="fas fa-tags"></i>Types de congé
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('admin/soldes') ?>" class="nav-link <?= strpos(current_url(), '/admin/soldes') !== false ? 'active' : '' ?>">
                        <i class="fas fa-coins"></i>Soldes annuels
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('admin/historique') ?>" class="nav-link <?= strpos(current_url(), '/admin/historique') !== false ? 'active' : '' ?>">
                        <i class="fas fa-history"></i>Historique
                    </a>
                </li>

            <?php elseif ($role === 'rh'): ?>
                <li class="nav-item">
                    <a href="<?= base_url('rh') ?>" class="nav-link <?= current_url() === base_url('rh') ? 'active' : '' ?>">
                        <i class="fas fa-tachometer-alt"></i>Tableau de bord
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('rh/demandes?statut=en_attente') ?>" class="nav-link <?= strpos(current_url(), '/rh/demandes') !== false ? 'active' : '' ?>">
                        <i class="fas fa-inbox"></i>Demandes en attente
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('rh/soldes') ?>" class="nav-link <?= strpos(current_url(), '/rh/soldes') !== false ? 'active' : '' ?>">
                        <i class="fas fa-coins"></i>Soldes des employés
                    </a>
                </li>

            <?php elseif ($role === 'employe'): ?>
                <li class="nav-item">
                    <a href="<?= base_url('employe') ?>" class="nav-link <?= current_url() === base_url('employe') ? 'active' : '' ?>">
                        <i class="fas fa-tachometer-alt"></i>Tableau de bord
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('employe/demande') ?>" class="nav-link <?= strpos(current_url(), '/employe/demande') !== false ? 'active' : '' ?>">
                        <i class="fas fa-plus-circle"></i>Nouvelle demande
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('employe/mes-demandes') ?>" class="nav-link <?= strpos(current_url(), '/employe/mes-demandes') !== false ? 'active' : '' ?>">
                        <i class="fas fa-list"></i>Mes demandes
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('employe/solde') ?>" class="nav-link <?= strpos(current_url(), '/employe/solde') !== false ? 'active' : '' ?>">
                        <i class="fas fa-wallet"></i>Mon solde
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('employe/profil') ?>" class="nav-link <?= strpos(current_url(), '/employe/profil') !== false ? 'active' : '' ?>">
                        <i class="fas fa-user-cog"></i>Mon profil
                    </a>
                </li>
            <?php endif; ?>
        </ul>

        <div class="sidebar-footer">
            <a href="<?= base_url('logout') ?>" class="nav-link">
                <i class="fas fa-sign-out-alt"></i>Déconnexion
            </a>
        </div>
    </nav>
    <?php endif; ?>

    <main class="main-content">
        <?php if ($employe): ?>
        <header class="topbar">
            <h1 class="page-title"><?= $this->renderSection('page_title') ?: 'Tableau de bord' ?></h1>
            <span class="topbar-date"><?= date('d/m/Y') ?></span>
        </header>
        <?php endif; ?>

        <div class="content-body">
            <?php if (session()->getFlashdata('success')): ?>
                <div class="flash-message flash-message--success">
                    <i class="fas fa-check-circle"></i>
                    <?= session()->getFlashdata('success') ?>
                    <button class="flash-close" onclick="this.parentElement.remove()">&times;</button>
                </div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('error')): ?>
                <div class="flash-message flash-message--error">
                    <i class="fas fa-exclamation-circle"></i>
                    <?= session()->getFlashdata('error') ?>
                    <button class="flash-close" onclick="this.parentElement.remove()">&times;</button>
                </div>
            <?php endif; ?>

            <?= $this->renderSection('content') ?>
        </div>
    </main>
</div>
</body>
</html>
