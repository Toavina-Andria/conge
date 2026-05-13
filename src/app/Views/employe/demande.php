<?= $this->extend('Layout/app') ?>

<?= $this->section('title') ?>Nouvelle demande<?= $this->endSection() ?>
<?= $this->section('page_title') ?>Nouvelle demande de congé<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-body p-4">
                <form action="<?= base_url('employe/demande') ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label for="type_conge_id" class="form-label">Type de congé</label>
                        <select name="type_conge_id" id="type_conge_id" class="form-select <?= $validation && $validation->hasError('type_conge_id') ? 'is-invalid' : '' ?>" required>
                            <option value="">— Sélectionner —</option>
                            <?php foreach ($types as $t): ?>
                            <option value="<?= $t['id'] ?>" <?= old('type_conge_id') == $t['id'] ? 'selected' : '' ?>>
                                <?= esc($t['libelle']) ?>
                                (reste: <?= $soldeParType[$t['id']] ?? 'N/A' ?> j)
                            </option>
                            <?php endforeach; ?>
                        </select>
                        <?php if ($validation && $validation->hasError('type_conge_id')): ?>
                        <div class="invalid-feedback"><?= $validation->getError('type_conge_id') ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="date_debut" class="form-label">Date de début</label>
                            <input type="date" name="date_debut" id="date_debut"
                                   class="form-control <?= $validation && $validation->hasError('date_debut') ? 'is-invalid' : '' ?>"
                                   value="<?= old('date_debut') ?>" required>
                            <?php if ($validation && $validation->hasError('date_debut')): ?>
                            <div class="invalid-feedback"><?= $validation->getError('date_debut') ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="date_fin" class="form-label">Date de fin</label>
                            <input type="date" name="date_fin" id="date_fin"
                                   class="form-control <?= $validation && $validation->hasError('date_fin') ? 'is-invalid' : '' ?>"
                                   value="<?= old('date_fin') ?>" required>
                            <?php if ($validation && $validation->hasError('date_fin')): ?>
                            <div class="invalid-feedback"><?= $validation->getError('date_fin') ?></div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="motif" class="form-label">Motif <small class="text-muted">(optionnel)</small></label>
                        <textarea name="motif" id="motif" rows="3" class="form-control"><?= old('motif') ?></textarea>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane me-2"></i>Soumettre la demande
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
