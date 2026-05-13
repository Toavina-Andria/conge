<?= $this->extend('Layout/app') ?>

<?= $this->section('title') ?>Gestion des employés<?= $this->endSection() ?>
<?= $this->section('page_title') ?>Gestion des employés<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0">Liste des employés</h5>
    <a href="<?= base_url('admin/employes/creer') ?>" class="btn btn-primary btn-sm">
        <i class="fas fa-plus me-1"></i>Nouvel employé
    </a>
</div>

<div class="card shadow">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
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
                <?php if (empty($employes)): ?>
                <tr><td colspan="6" class="text-center text-muted py-3">Aucun employé.</td></tr>
                <?php else: ?>
                <?php foreach ($employes as $emp): ?>
                <tr>
                    <td><?= esc($emp['prenom'] . ' ' . $emp['nom']) ?></td>
                    <td><?= esc($emp['email']) ?></td>
                    <td>
                        <span class="badge bg-<?= $emp['role'] === 'admin' ? 'danger' : ($emp['role'] === 'rh' ? 'warning text-dark' : 'info') ?>">
                            <?= $emp['role'] === 'admin' ? 'Admin' : ($emp['role'] === 'rh' ? 'RH' : 'Employé') ?>
                        </span>
                    </td>
                    <td><?= esc($emp['departement_nom'] ?? '-') ?></td>
                    <td>
                        <?php if ($emp['actif']): ?>
                            <span class="badge bg-success">Actif</span>
                        <?php else: ?>
                            <span class="badge bg-secondary">Inactif</span>
                        <?php endif; ?>
                    </td>
                    <td class="text-end">
                        <a href="<?= base_url('admin/employes/' . $emp['id']) ?>" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="<?= base_url('admin/employes/toggle/' . $emp['id']) ?>" method="POST" class="d-inline">
                            <?= csrf_field() ?>
                            <button type="submit" class="btn btn-sm <?= $emp['actif'] ? 'btn-outline-warning' : 'btn-outline-success' ?>"
                                    onclick="return confirm('<?= $emp['actif'] ? 'Désactiver' : 'Activer' ?> cet employé ?')">
                                <i class="fas <?= $emp['actif'] ? 'fa-ban' : 'fa-check' ?>"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
