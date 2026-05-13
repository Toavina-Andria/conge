<?= $this->extend('Layout/app') ?>

<?= $this->section('title') ?>Nouvelle demande<?= $this->endSection() ?>
<?= $this->section('page_title') ?>Nouvelle demande de congé<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <form action="<?= base_url('employe/demande') ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="form-group">
                        <label class="form-label">Type de congé</label>
                        <select name="type_conge_id" class="form-select <?= $validation && $validation->hasError('type_conge_id') ? 'is-invalid' : '' ?>" required>
                            <option value="">— Sélectionner —</option>
                            <?php foreach ($types as $t): ?>
                            <option value="<?= $t['id'] ?>" <?= old('type_conge_id') == $t['id'] ? 'selected' : '' ?>>
                                <?= esc($t['libelle']) ?> (reste: <?= $soldeParType[$t['id']] ?? 'N/A' ?> j)
                            </option>
                            <?php endforeach; ?>
                        </select>
                        <?php if ($validation && $validation->hasError('type_conge_id')): ?>
                        <span class="invalid-feedback"><?= $validation->getError('type_conge_id') ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Date de début</label>
                            <input type="date" name="date_debut" class="form-input <?= $validation && $validation->hasError('date_debut') ? 'is-invalid' : '' ?>" value="<?= old('date_debut') ?>" required>
                            <?php if ($validation && $validation->hasError('date_debut')): ?>
                            <span class="invalid-feedback"><?= $validation->getError('date_debut') ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Date de fin</label>
                            <input type="date" name="date_fin" class="form-input <?= $validation && $validation->hasError('date_fin') ? 'is-invalid' : '' ?>" value="<?= old('date_fin') ?>" required>
                            <?php if ($validation && $validation->hasError('date_fin')): ?>
                            <span class="invalid-feedback"><?= $validation->getError('date_fin') ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Motif <span class="text-muted">(optionnel)</span></label>
                        <textarea name="motif" rows="3" class="form-textarea"><?= old('motif') ?></textarea>
                    </div>

                    <button type="submit" class="btn btn--primary w-100">
                        <i class="fas fa-paper-plane"></i>Soumettre la demande
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
