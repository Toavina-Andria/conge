<?= $this->extend('Layout/app') ?>

<?= $this->section('title') ?><?= $solde ? 'Modifier' : 'Nouveau' ?> solde<?= $this->endSection() ?>
<?= $this->section('page_title') ?><?= $solde ? 'Modifier le solde' : 'Nouveau solde' ?><?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-body">
        <form action="<?= base_url($solde ? 'admin/soldes/' . $solde['id'] : 'admin/soldes/creer') ?>" method="POST">
            <?= csrf_field() ?>

            <?php if ($validation): ?>
            <div class="flash-message flash-message--error">
                <i class="fas fa-exclamation-circle"></i>
                <ul class="mb-0" style="list-style:none;padding:0;margin:0">
                <?php foreach ($validation as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>

            <?php if ($solde): ?>
            <table class="detail-table">
                <tr>
                    <th>Employé</th>
                    <td><?= esc($solde['prenom'] . ' ' . $solde['nom']) ?></td>
                </tr>
                <tr>
                    <th>Type de congé</th>
                    <td><?= esc($solde['libelle']) ?></td>
                </tr>
                <tr>
                    <th>Année</th>
                    <td class="text-monospace"><?= (int) $solde['annee'] ?></td>
                </tr>
            </table>
            <input type="hidden" name="annee" value="<?= $solde['annee'] ?>">
            <?php else: ?>
            <div class="form-row form-row-3">
                <div class="form-group">
                    <label class="form-label">Employé <span class="required">*</span></label>
                    <select name="employe_id" class="form-select" required>
                        <option value="">-- Sélectionner --</option>
                        <?php foreach ($employes as $emp): ?>
                        <option value="<?= $emp['id'] ?>" <?= old('employe_id') == $emp['id'] ? 'selected' : '' ?>>
                            <?= esc($emp['prenom'] . ' ' . $emp['nom']) ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Type de congé <span class="required">*</span></label>
                    <select name="type_conge_id" class="form-select" required>
                        <option value="">-- Sélectionner --</option>
                        <?php foreach ($types as $t): ?>
                        <option value="<?= $t['id'] ?>" <?= old('type_conge_id') == $t['id'] ? 'selected' : '' ?>>
                            <?= esc($t['libelle']) ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Année <span class="required">*</span></label>
                    <input type="number" name="annee" class="form-input" value="<?= old('annee', $annee) ?>" required min="2000" max="2099">
                </div>
            </div>
            <?php endif; ?>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Jours attribués <span class="required">*</span></label>
                    <input type="number" name="jours_attribues" class="form-input" value="<?= old('jours_attribues', $solde['jours_attribues'] ?? '') ?>" required min="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Jours pris</label>
                    <input type="number" name="jours_pris" class="form-input" value="<?= old('jours_pris', $solde['jours_pris'] ?? 0) ?>" min="0">
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <a href="<?= base_url('admin/soldes' . ($solde ? '?annee=' . $solde['annee'] : '')) ?>" class="btn btn--secondary">Annuler</a>
                <button type="submit" class="btn btn--primary">
                    <i class="fas fa-save"></i><?= $solde ? 'Enregistrer' : 'Créer' ?>
                </button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
