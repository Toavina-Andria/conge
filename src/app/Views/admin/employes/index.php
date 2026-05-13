<?= $this->extend('Layout/app') ?>

<?= $this->section('title') ?>Gestion des employés<?= $this->endSection() ?>
<?= $this->section('page_title') ?>Gestion des employés<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="content-header">
    <h5>Liste des employés</h5>
    <a href="<?= base_url('admin/employes/creer') ?>" class="btn btn--primary btn--sm">
        <i class="fas fa-plus"></i>Nouvel employé
    </a>
</div>

<div class="card card-table">
    <div class="card-body">
        <?php if (empty($employes)): ?>
        <div class="empty-state">
            <span class="empty-icon"><i class="fas fa-users"></i></span>
            <p class="empty-title">Aucun employé</p>
        </div>
        <?php else: ?>
        <div class="table-wrapper">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Rôle</th>
                        <th>Département</th>
                        <th>Statut</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($employes as $emp): ?>
                    <tr>
                        <td><?= esc($emp['prenom'] . ' ' . $emp['nom']) ?></td>
                        <td><?= esc($emp['email']) ?></td>
                        <td>
                            <span class="badge badge--<?= $emp['role'] === 'admin' ? 'refused' : ($emp['role'] === 'rh' ? 'pending' : 'info') ?>">
                                <?= $emp['role'] === 'admin' ? 'Admin' : ($emp['role'] === 'rh' ? 'RH' : 'Employé') ?>
                            </span>
                        </td>
                        <td><?= esc($emp['departement_nom'] ?? '-') ?></td>
                        <td>
                            <span class="badge badge--<?= $emp['actif'] ? 'active' : 'inactive' ?>">
                                <?= $emp['actif'] ? 'Actif' : 'Inactif' ?>
                            </span>
                        </td>
                        <td class="text-end">
                            <div class="actions-group justify-content-end">
                                <a href="<?= base_url('admin/employes/' . $emp['id']) ?>" class="btn btn--ghost btn--sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="<?= base_url('admin/employes/toggle/' . $emp['id']) ?>" method="POST" class="d-inline">
                                    <?= csrf_field() ?>
                                    <button type="submit" class="btn btn--ghost btn--sm"
                                            onclick="return confirm('<?= $emp['actif'] ? 'Désactiver' : 'Activer' ?> cet employé ?')">
                                        <i class="fas <?= $emp['actif'] ? 'fa-ban' : 'fa-check' ?>"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>
