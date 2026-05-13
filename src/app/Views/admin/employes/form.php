<?= $this->extend('Layout/app') ?>
<?= $this->section('title') ?><?= $employe ? 'Modifier' : 'Nouvel' ?> employé<?= $this->endSection() ?>
<?= $this->section('page_title') ?><?= $employe ? "Modifier l'employé" : 'Nouvel employé' ?><?= $this->endSection() ?>
<?= $this->section('breadcrumb') ?><a href="<?= base_url('admin') ?>">Admin</a> <i class="fas fa-chevron-right" style="font-size:.6rem"></i> <a href="<?= base_url('admin/employes') ?>">Employés</a> <i class="fas fa-chevron-right" style="font-size:.6rem"></i> <?= $employe ? 'Modifier' : 'Nouveau' ?><?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="form-section">
    <h3><i class="fas fa-<?= $employe ? 'user-edit' : 'user-plus' ?>" style="color:var(--forest);margin-right:6px"></i><?= $employe ? "Modifier l'employé" : 'Ajouter un employé' ?></h3>

    <?php if ($validation): ?>
    <div class="flash flash-error">
        <i class="fas fa-exclamation-circle"></i>
        <ul style="list-style:none;padding:0;margin:0">
        <?php foreach ($validation as $error): ?>
            <li><?= esc($error) ?></li>
        <?php endforeach; ?>
        </ul>
    </div>
    <?php endif; ?>

    <form action="<?= base_url($employe ? 'admin/employes/' . $employe['id'] : 'admin/employes/creer') ?>" method="POST">
        <?= csrf_field() ?>
        <div class="form-grid-2">
            <div class="f-group">
                <label class="f-label">Prénom <span class="required">*</span></label>
                <input type="text" name="prenom" class="f-input" value="<?= old('prenom', $employe['prenom'] ?? '') ?>" required>
            </div>
            <div class="f-group">
                <label class="f-label">Nom <span class="required">*</span></label>
                <input type="text" name="nom" class="f-input" value="<?= old('nom', $employe['nom'] ?? '') ?>" required>
            </div>
            <div class="f-group">
                <label class="f-label">Email <span class="required">*</span></label>
                <input type="email" name="email" class="f-input" value="<?= old('email', $employe['email'] ?? '') ?>" required>
            </div>
            <div class="f-group">
                <label class="f-label">
                    Mot de passe <?= $employe ? '<span style="font-weight:400;color:var(--muted)">(laisser vide pour ne pas changer)</span>' : '<span class="required">*</span>' ?>
                </label>
                <input type="password" name="password" class="f-input" <?= $employe ? '' : 'required' ?>>
            </div>
            <div class="f-group">
                <label class="f-label">Rôle <span class="required">*</span></label>
                <select name="role" class="f-select" required>
                    <option value="employe" <?= old('role', $employe['role'] ?? '') === 'employe' ? 'selected' : '' ?>>Employé</option>
                    <option value="rh" <?= old('role', $employe['role'] ?? '') === 'rh' ? 'selected' : '' ?>>RH</option>
                    <option value="admin" <?= old('role', $employe['role'] ?? '') === 'admin' ? 'selected' : '' ?>>Admin</option>
                </select>
            </div>
            <div class="f-group">
                <label class="f-label">Département <span class="required">*</span></label>
                <select name="departement_id" class="f-select" required>
                    <option value="">— Sélectionner —</option>
                    <?php foreach ($departements as $d): ?>
                    <option value="<?= $d['id'] ?>" <?= old('departement_id', $employe['departement_id'] ?? '') == $d['id'] ? 'selected' : '' ?>>
                        <?= esc($d['nom']) ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="f-group">
                <label class="f-label">Date d'embauche <span class="required">*</span></label>
                <input type="date" name="date_embauche" class="f-input" value="<?= old('date_embauche', $employe['date_embauche'] ?? '') ?>" required>
            </div>
        </div>

        <?php if (!$employe): ?>
        <div class="flash flash-info" style="margin-bottom:1rem">
            <i class="fas fa-info-circle"></i>
            <span style="font-size:.82rem">Les soldes de congés seront initialisés automatiquement selon les types de congé configurés.</span>
        </div>
        <?php endif; ?>

        <div class="form-actions">
            <a href="<?= base_url('admin/employes') ?>" class="btn-secondary"><i class="fas fa-arrow-left"></i> Annuler</a>
            <button type="submit" class="btn-forest"><i class="fas fa-save"></i> <?= $employe ? 'Enregistrer' : 'Créer l\'employé' ?></button>
        </div>
    </form>
</div>
<?= $this->endSection() ?>
