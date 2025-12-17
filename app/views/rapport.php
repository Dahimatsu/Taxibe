<?php
function ar($n) {
    $n = ($n ?? 0);
    return number_format($n, 0, ',', ' ') . ' Ar';
}

$totalRecette  = 0;
$totalDepenses = 0;
$totalBenefice = 0;

if (!empty($coursesJour)) {
    foreach ($coursesJour as $row) {
        $totalRecette  += ($row['recette'] ?? 0);
        $totalDepenses += ($row['depense'] ?? 0);
        $totalBenefice += ($row['benefice'] ?? (($row['recette'] ?? 0) - ($row['depense'] ?? 0)));
    }
}
?>

<div class="d-flex align-items-center justify-content-between mb-3">
    <div>
        <h2 class="fw-bold mb-0">
            <i class="bi bi-receipt me-1"></i> Liste des courses par jour
        </h2>
        <small class="text-muted">Recette • Dépenses • Bénéfice</small>
    </div>

    <a href="/" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Retour
    </a>
</div>

<div class="row g-3 mb-3">
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <small class="text-muted">Recette totale</small>
                <h5 class="fw-bold text-primary mb-0"><?= ar($totalRecette) ?></h5>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <small class="text-muted">Dépenses totales</small>
                <h5 class="fw-bold text-warning mb-0"><?= ar($totalDepenses) ?></h5>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <small class="text-muted">Bénéfice total</small>
                <h5 class="fw-bold <?= $totalBenefice >= 0 ? 'text-success' : 'text-danger' ?> mb-0">
                    <?= ar($totalBenefice) ?>
                </h5>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header bg-primary text-white">
        <i class="bi bi-table me-1"></i> Détail journalier
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped table-hover mb-0 align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Date</th>
                        <th class="text-end">Recette</th>
                        <th class="text-end">Dépenses</th>
                        <th class="text-end">Bénéfice</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (!empty($coursesJour)) { ?>
                        <?php foreach ($coursesJour as $row): ?>
                            <?php
                                $recette  = ($row['recette'] ?? 0);
                                $depense = ($row['depense'] ?? 0);
                                $benefice = ($row['benefice'] ?? ($recette - $depense));
                            ?>
                            <tr>
                                <td class="fw-semibold"><?= htmlspecialchars($row['date'] ?? '') ?></td>
                                <td class="text-end"><?= ar($recette) ?></td>
                                <td class="text-end"><?= ar($depense) ?></td>
                                <td class="text-end fw-bold <?= $benefice >= 0 ? 'text-success' : 'text-danger' ?>">
                                    <?= ar($benefice) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php } else { ?>
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">
                                Aucune donnée.
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
