<?= $this->extend('Layout/app') ?>

<?= $this->section('title') ?>Mon solde<?= $this->endSection() ?>
<?= $this->section('page_title') ?>Mon solde<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card shadow">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Type de congé</th>
                    <th>Année</th>
                    <th>Attribués</th>
                    <th>Pris</th>
                    <th>Reste</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($soldes)): ?>
                <tr><td colspan="5" class="text-center text-muted py-3">Aucun solde disponible.</td></tr>
                <?php else: ?>
                <?php foreach ($soldes as $s): ?>
                <tr>
                    <td><?= esc($s['libelle']) ?></td>
                    <td><?= (int) $s['annee'] ?></td>
                    <td><?= (int) $s['jours_attribues'] ?></td>
                    <td><?= (int) $s['jours_pris'] ?></td>
                    <td>
                        <span class="badge bg-<?= $s['reste'] > 0 ? 'success' : ($s['reste'] < 0 ? 'danger' : 'secondary') ?> fs-6">
                            <?= (int) $s['reste'] ?> jour<?= (int) $s['reste'] > 1 ? 's' : '' ?>
                        </span>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
