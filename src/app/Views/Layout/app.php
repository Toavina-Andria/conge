<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->renderSection('title') ?: 'Gestion des Congés' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="d-flex min-vh-100">
        <?php if ($employe): ?>
        <nav class="sidebar bg-dark text-white d-flex flex-column" style="width: 260px; min-height: 100vh;">
            <div class="p-3 border-secondary">
                <h5 class="mb-0"><i class="fas fa-calendar-alt me-2"></i>Congés</h5>
                <small class="text-secondary">TechMada</small>
            </div>
            <hr class="my-0">

            <div class="p-3 text-secondary small border-bottom border-secondary">
                <i class="fas fa-user-circle me-2"></i><?= esc($employe['prenom'] . ' ' . $employe['nom']) ?>
                <span class="badge bg-<?= $role === 'admin' ? 'danger' : ($role === 'rh' ? 'warning text-dark' : 'info') ?> ms-2">
                    <?= $role === 'admin' ? 'Admin' : ($role === 'rh' ? 'RH' : 'Employé') ?>
                </span>
            </div>

            <ul class="nav flex-column p-2 flex-grow-1">
                <?php if ($role === 'admin'): ?>
                    <li class="nav-item mb-1">
                        <a href="<?= base_url('admin') ?>" class="nav-link text-white <?= current_url() === base_url('admin') ? 'active bg-secondary rounded' : '' ?>">
                            <i class="fas fa-tachometer-alt fa-fw me-2"></i>Tableau de bord
                        </a>
                    </li>
                    <li class="nav-item mb-1">
                        <a href="<?= base_url('admin/employes') ?>" class="nav-link text-white <?= strpos(current_url(), '/admin/employes') !== false ? 'active bg-secondary rounded' : '' ?>">
                            <i class="fas fa-users fa-fw me-2"></i>Employés
                        </a>
                    </li>
                    <li class="nav-item mb-1">
                        <a href="<?= base_url('admin/departements') ?>" class="nav-link text-white <?= strpos(current_url(), '/admin/departements') !== false ? 'active bg-secondary rounded' : '' ?>">
                            <i class="fas fa-building fa-fw me-2"></i>Départements
                        </a>
                    </li>
                    <li class="nav-item mb-1">
                        <a href="<?= base_url('admin/types-conge') ?>" class="nav-link text-white <?= strpos(current_url(), '/admin/types-conge') !== false ? 'active bg-secondary rounded' : '' ?>">
                            <i class="fas fa-tags fa-fw me-2"></i>Types de congé
                        </a>
                    </li>
                    <li class="nav-item mb-1">
                        <a href="<?= base_url('admin/soldes') ?>" class="nav-link text-white <?= strpos(current_url(), '/admin/soldes') !== false ? 'active bg-secondary rounded' : '' ?>">
                            <i class="fas fa-coins fa-fw me-2"></i>Soldes annuels
                        </a>
                    </li>
                    <li class="nav-item mb-1">
                        <a href="<?= base_url('admin/historique') ?>" class="nav-link text-white <?= strpos(current_url(), '/admin/historique') !== false ? 'active bg-secondary rounded' : '' ?>">
                            <i class="fas fa-history fa-fw me-2"></i>Historique
                        </a>
                    </li>

                <?php elseif ($role === 'rh'): ?>
                    <li class="nav-item mb-1">
                        <a href="<?= base_url('rh') ?>" class="nav-link text-white <?= current_url() === base_url('rh') ? 'active bg-secondary rounded' : '' ?>">
                            <i class="fas fa-tachometer-alt fa-fw me-2"></i>Tableau de bord
                        </a>
                    </li>
                    <li class="nav-item mb-1">
                        <a href="<?= base_url('rh/demandes') ?>" class="nav-link text-white <?= strpos(current_url(), '/rh/demandes') !== false ? 'active bg-secondary rounded' : '' ?>">
                            <i class="fas fa-inbox fa-fw me-2"></i>Demandes en attente
                        </a>
                    </li>
                    <li class="nav-item mb-1">
                        <a href="<?= base_url('rh/soldes') ?>" class="nav-link text-white <?= strpos(current_url(), '/rh/soldes') !== false ? 'active bg-secondary rounded' : '' ?>">
                            <i class="fas fa-coins fa-fw me-2"></i>Soldes des employés
                        </a>
                    </li>

                <?php elseif ($role === 'employe'): ?>
                    <li class="nav-item mb-1">
                        <a href="<?= base_url('employe') ?>" class="nav-link text-white <?= current_url() === base_url('employe') ? 'active bg-secondary rounded' : '' ?>">
                            <i class="fas fa-tachometer-alt fa-fw me-2"></i>Tableau de bord
                        </a>
                    </li>
                    <li class="nav-item mb-1">
                        <a href="<?= base_url('employe/demande') ?>" class="nav-link text-white <?= strpos(current_url(), '/employe/demande') !== false ? 'active bg-secondary rounded' : '' ?>">
                            <i class="fas fa-plus-circle fa-fw me-2"></i>Nouvelle demande
                        </a>
                    </li>
                    <li class="nav-item mb-1">
                        <a href="<?= base_url('employe/mes-demandes') ?>" class="nav-link text-white <?= strpos(current_url(), '/employe/mes-demandes') !== false ? 'active bg-secondary rounded' : '' ?>">
                            <i class="fas fa-list fa-fw me-2"></i>Mes demandes
                        </a>
                    </li>
                    <li class="nav-item mb-1">
                        <a href="<?= base_url('employe/solde') ?>" class="nav-link text-white <?= strpos(current_url(), '/employe/solde') !== false ? 'active bg-secondary rounded' : '' ?>">
                            <i class="fas fa-wallet fa-fw me-2"></i>Mon solde
                        </a>
                    </li>
                <?php endif; ?>
            </ul>

            <div class="p-3 border-top border-secondary">
                <a href="<?= base_url('logout') ?>" class="nav-link text-white">
                    <i class="fas fa-sign-out-alt fa-fw me-2"></i>Déconnexion
                </a>
            </div>
        </nav>
        <?php endif; ?>

        <main class="flex-grow-1 d-flex flex-column bg-light">
            <?php if ($employe): ?>
            <nav class="navbar navbar-expand navbar-light bg-white shadow-sm px-4">
                <span class="navbar-brand mb-0 h6"><?= $this->renderSection('page_title') ?: 'Tableau de bord' ?></span>
                <div class="ms-auto">
                    <span class="text-secondary small"><?= date('d/m/Y') ?></span>
                </div>
            </nav>
            <?php endif; ?>

            <div class="container-fluid p-4">
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show">
                        <?= session()->getFlashdata('success') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show">
                        <?= session()->getFlashdata('error') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <?= $this->renderSection('content') ?>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
