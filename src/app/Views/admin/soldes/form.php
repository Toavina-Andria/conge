<?= $this->extend('Layout/app') ?>

<?= $this->section('title') ?><?= $solde ? 'Modifier' : 'Nouveau' ?> solde<?= $this->endSection() ?>
<?= $this->section('page_title') ?><?= $solde ? 'Modifier le solde' : 'Nouveau solde' ?><?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card shadow">
    <div class="card-body">
        <form action="<?= base_url($solde ? 'admin/soldes/' . $solde['id'] : 'admin/soldes/creer') ?>" method="POST">
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

            <?php if ($solde): ?>
            <table class="table table-bordered mb-3">
                <tr>
                    <th style="width: 200px;">Employé</th>
                    <td><?= esc($solde['prenom'] . ' ' . $solde['nom']) ?></td>
                </tr>
                <tr>
                    <th>Type de congé</th>
                    <td><?= esc($solde['libelle']) ?></td>
                </tr>
                <tr>
                    <th>Année</th>
                    <td><?= (int) $solde['annee'] ?></td>
                </tr>
            </table>
            <input type="hidden" name="annee" value="<?= $solde['annee'] ?>">
            <?php else: ?>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Employé <span class="text-danger">*</span></label>
                    <select name="employe_id" class="form-select" required>
                        <option value="">-- Sélectionner --</option>
                        <?php foreach ($employes as $emp): ?>
                        <option value="<?= $emp['id'] ?>" <?= old('employe_id') == $emp['id'] ? 'selected' : '' ?>>
                            <?= esc($emp['prenom'] . ' ' . $emp['nom']) ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Type de congé <span class="text-danger">*</span></label>
                    <select name="type_conge_id" class="form-select" required>
                        <option value="">-- Sélectionner --</option>
                        <?php foreach ($types as $t): ?>
                        <option value="<?= $t['id'] ?>" <?= old('type_conge_id') == $t['id'] ? 'selected' : '' ?>>
                            <?= esc($t['libelle']) ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Année <span class="text-danger">*</span></label>
                    <input type="number" name="annee" class="form-control"
                           value="<?= old('annee', $annee) ?>" required min="2000" max="2099" step="1">
                </div>
            </div>
            <?php endif; ?>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Jours attribués <span class="text-danger">*</span></label>
                    <input type="number" name="jours_attribues" class="form-control"
                           value="<?= old('jours_attribues', $solde['jours_attribues'] ?? '') ?>" required min="0">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Jours pris</label>
                    <input type="number" name="jours_pris" class="form-control"
                           value="<?= old('jours_pris', $solde['jours_pris'] ?? 0) ?>" min="0">
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <a href="<?= base_url('admin/soldes' . ($solde ? '?annee=' . $solde['annee'] : '')) ?>" class="btn btn-secondary">Annuler</a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i><?= $solde ? 'Enregistrer' : 'Créer' ?>
                </button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
