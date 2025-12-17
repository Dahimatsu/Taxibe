<div class="d-flex align-items-center justify-content-between mb-3">
    <div>
        <h2 class="fw-bold mb-0">
            <i class="bi bi-card-list me-1"></i> Toutes les courses
        </h2>
        <small class="text-muted">Liste complète des courses enregistrées</small>
    </div>

    <div class="d-flex gap-2">
        <a href="/course/nouvelle" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Nouvelle course
        </a>
        <a href="/course" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Retour
        </a>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <i class="bi bi-table me-1"></i> Détails des courses
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped table-hover mb-0 align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Départ</th>
                        <th>Arrivée</th>
                        <th>Heure</th>
                        <th class="text-end">Km</th>
                        <th class="text-end">Prix</th>
                        <th>Moto</th>
                        <th>Conducteur</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>

                <tbody>
                <?php if (!empty($courses)): ?>
                    <?php foreach ($courses as $c): ?>
                        <?php
                            $id    = $c['id_course'] ?? '';
                            $date  = $c['date_course'] ?? '';
                            $depart  = $c['lieu_depart'] ?? '';
                            $arrivee = $c['lieu_arrivee'] ?? '';
                            $hdep = $c['heure_depart'] ?? '';
                            $harr = $c['heure_arrivee'] ?? null;

                            $km   = ($c['nb_kilometre'] ?? 0);
                            $prix = ($c['prix_course'] ?? 0);

                            $moto = trim(($c['marque'] ?? '') . ' ' . ($c['modele'] ?? ''));
                            $conducteur = trim(($c['nom'] ?? '') . ' ' . ($c['prenom'] ?? ''));

                            $etat = empty($harr);

                            $statut = $etat ? 'En cours' : 'Terminée';
                            $badge  = $etat ? 'bg-warning text-dark' : 'bg-success';

                            $urlDetail    = "/course/detail/" . $id;
                            $urlEdit    = "/course/modifier/" . $id;
                            $urlValider = "/course/valider/" . $id;
                        ?>
                        <tr>
                            <td class="fw-semibold"><?= $id ?></td>
                            <td><?= $date ?></td>
                            <td><?= $depart ?></td>
                            <td><?= $arrivee ?></td>

                            <td>
                                <div class="small">
                                    <span class="text-muted">Départ:</span> <?= $hdep ?><br>
                                    <span class="text-muted">Arrivée:</span> <?= $harr ?? '--:--' ?>
                                </div>
                                <span class="badge <?= $badge ?> mt-1"><?= $statut ?></span>
                            </td>

                            <td class="text-end"><?= number_format($km, 1, ',', ' ') ?></td>
                            <td class="text-end fw-bold"><?= number_format($prix, 2, ',', ' ') ?> Ar</td>
                            <td><?= $moto ?></td>
                            <td><?= $conducteur ?></td>

                            <td class="text-center">
                                <a href="<?= $urlDetail ?>" class="btn btn-sm btn-outline-primary" title="Voir">
                                    <i class="bi bi-eye"></i>
                                </a>

                                <?php if ($etat) { ?>
                                    <a href="<?= $urlEdit ?>" class="btn btn-sm btn-outline-secondary" title="Modifier">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <a href="<?= $urlValider ?>"
                                       class="btn btn-sm btn-success"
                                       title="Valider (check-out)"
                                       onclick="return confirm('Valider cette course ? Elle ne sera plus modifiable.');">
                                        <i class="bi bi-check2-circle"></i>
                                    </a>
                                <?php } else { ?>
                                    <button class="btn btn-sm btn-outline-secondary" disabled title="Course terminée">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-success" disabled title="Déjà validée">
                                        <i class="bi bi-check2-circle"></i>
                                    </button>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="10" class="text-center text-muted py-4">
                            Aucune course trouvée.
                        </td>
                    </tr>
                <?php endif; ?>
                </tbody>

            </table>
        </div>
    </div>
</div>
