<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h2 class="fw-bold mb-0">
            <i class="bi bi-pencil-square me-1"></i> Modifier une course
        </h2>
        <small class="text-muted">
            Course n° <?= htmlspecialchars($course['id_course']) ?>
        </small>
    </div>

    <a href="/course/liste" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Retour
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <i class="bi bi-ui-checks-grid me-1"></i> Informations de la course
    </div>

    <div class="card-body">
        <form action="/course/update/<?= urlencode($course['id_course']) ?>" method="post" class="row g-3">

            <div class="col-md-6">
                <label class="form-label">Conducteur</label>
                <select name="id_conducteur" class="form-select" required>
                    <option value="">-- Changer de conducteur --</option>
                    <?php foreach ($conducteurs as $c): ?>
                        <option value="<?= $c['id_conducteur'] ?>"
                            <?= ($c['id_conducteur'] === $course['id_conducteur']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($c['prenom'] . ' ' . $c['nom']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label">Date</label>
                <input type="date" name="date_course" class="form-control"
                       value="<?= htmlspecialchars($course['date_course']) ?>" required>
            </div>

            <div class="col-md-4">
                <label class="form-label">Heure de départ</label>
                <input type="time" name="heure_depart" class="form-control"
                       value="<?= htmlspecialchars($course['heure_depart']) ?>" required>
            </div>

            <div class="col-md-4">
                <label class="form-label">Heure d’arrivée</label>
                <input type="time" name="heure_arrivee" class="form-control"
                       value="<?= htmlspecialchars($course['heure_arrivee'] ?? '') ?>">
                <small class="text-muted">Laisser vide si la course n’est pas terminée</small>
            </div>

            <div class="col-md-6">
                <label class="form-label">Lieu de départ</label>
                <input type="text" name="lieu_depart" class="form-control"
                       value="<?= htmlspecialchars($course['lieu_depart']) ?>" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Lieu d’arrivée</label>
                <input type="text" name="lieu_arrivee" class="form-control"
                       value="<?= htmlspecialchars($course['lieu_arrivee'] ?? '') ?>" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Kilométrage (km)</label>
                <input type="number" step="0.1" name="nb_kilometre" class="form-control"
                       value="<?= htmlspecialchars($course['nb_kilometre']) ?>" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Prix de la course (Ar)</label>
                <input type="number" step="100" name="prix_course" class="form-control"
                       value="<?= htmlspecialchars($course['prix_course']) ?>" required>
            </div>

            <div class="col-12 d-flex justify-content-end gap-2 mt-2">
                <a href="/course/detail/<?= urlencode($course['id_course']) ?>" class="btn btn-outline-secondary">
                    <i class="bi bi-x-circle"></i> Annuler
                </a>

                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Enregistrer les modifications
                </button>
            </div>

        </form>
    </div>
</div>
