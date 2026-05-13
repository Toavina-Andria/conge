<?= $this->extend('Layout/app') ?>

<?= $this->section('title') ?>Mon solde<?= $this->endSection() ?>
<?= $this->section('page_title') ?>Mon solde<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card card-table">
    <div class="card-body">
        <?php if (empty($soldes)): ?>
        <div class="empty-state">
            <span class="empty-icon"><i class="fas fa-coins"></i></span>
            <p class="empty-title">Aucun solde disponible.</p>
        </div>
        <?php else: ?>
        <div class="table-wrapper">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Type de congé</th>
                        <th>Année</th>
                        <th>Attribués</th>
                        <th>Pris</th>
                        <th>Reste</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($soldes as $s): ?>
                    <tr>
                        <td><?= esc($s['libelle']) ?></td>
                        <td class="text-monospace"><?= (int) $s['annee'] ?></td>
                        <td class="text-monospace"><?= (int) $s['jours_attribues'] ?></td>
                        <td class="text-monospace"><?= (int) $s['jours_pris'] ?></td>
                        <td>
                            <span class="badge badge--<?= $s['reste'] > 0 ? 'active' : ($s['reste'] < 0 ? 'refused' : 'inactive') ?>">
                                <?= (int) $s['reste'] ?> jour<?= (int) $s['reste'] > 1 ? 's' : '' ?>
                            </span>
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
