<?= $this->extend('Layout/app') ?>

<?= $this->section('title') ?><?= $employe ? 'Modifier' : 'Nouvel' ?> employé<?= $this->endSection() ?>
<?= $this->section('page_title') ?><?= $employe ? 'Modifier l\'employé' : 'Nouvel employé' ?><?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card shadow">
    <div class="card-body">
        <form action="<?= base_url($employe ? 'admin/employes/' . $employe['id'] : 'admin/employes/creer') ?>" method="POST">
            <?= csrf_field() ?>

            <?php if ($validation): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                <?php foreach ($validation as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Prénom <span class="text-danger">*</span></label>
                    <input type="text" name="prenom" class="form-control" value="<?= old('prenom', $employe['prenom'] ?? '') ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nom <span class="text-danger">*</span></label>
                    <input type="text" name="nom" class="form-control" value="<?= old('nom', $employe['nom'] ?? '') ?>" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control" value="<?= old('email', $employe['email'] ?? '') ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Mot de passe <?= $employe ? '<small class="text-muted">(laisser vide pour ne pas changer)</small>' : '<span class="text-danger">*</span>' ?></label>
                    <input type="password" name="password" class="form-control" <?= $employe ? '' : 'required' ?>>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Rôle <span class="text-danger">*</span></label>
                    <select name="role" class="form-select" required>
                        <option value="employe" <?= old('role', $employe['role'] ?? '') === 'employe' ? 'selected' : '' ?>>Employé</option>
                        <option value="rh" <?= old('role', $employe['role'] ?? '') === 'rh' ? 'selected' : '' ?>>RH</option>
                        <option value="admin" <?= old('role', $employe['role'] ?? '') === 'admin' ? 'selected' : '' ?>>Admin</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Département <span class="text-danger">*</span></label>
                    <select name="departement_id" class="form-select" required>
                        <option value="">-- Sélectionner --</option>
                        <?php foreach ($departements as $d): ?>
                        <option value="<?= $d['id'] ?>" <?= old('departement_id', $employe['departement_id'] ?? '') == $d['id'] ? 'selected' : '' ?>>
                            <?= esc($d['nom']) ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Date d'embauche <span class="text-danger">*</span></label>
                    <input type="date" name="date_embauche" class="form-control" value="<?= old('date_embauche', $employe['date_embauche'] ?? '') ?>" required>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <a href="<?= base_url('admin/employes') ?>" class="btn btn-secondary">Annuler</a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i><?= $employe ? 'Enregistrer' : 'Créer' ?>
                </button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
