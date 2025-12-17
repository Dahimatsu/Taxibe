<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h2 class="fw-bold mb-0">
            <i class="bi bi-eye me-1"></i> Détail de la course
        </h2>
        <small class="text-muted">
            Course n° <?= htmlspecialchars($course['id_course']) ?>
        </small>
    </div>

    <a href="/course/liste" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Retour à la liste
    </a>
</div>

<div class="card shadow-sm mb-4">
    <div class="card-header bg-primary text-white">
        Informations générales
    </div>

    <div class="card-body">
        <div class="row g-3">

            <div class="col-md-4">
                <strong>Date</strong><br>
                <?= htmlspecialchars($course['date_course']) ?>
            </div>

            <div class="col-md-4">
                <strong>Lieu de départ</strong><br>
                <?= htmlspecialchars($course['lieu_depart']) ?>
            </div>

            <div class="col-md-4">
                <strong>Lieu d’arrivée</strong><br>
                <?= htmlspecialchars($course['lieu_arrivee'] ?? '-') ?>
            </div>

            <div class="col-md-4">
                <strong>Heure de départ</strong><br>
                <?= htmlspecialchars($course['heure_depart']) ?>
            </div>

            <div class="col-md-4">
                <strong>Heure d’arrivée</strong><br>
                <?= htmlspecialchars($course['heure_arrivee'] ?? '--:--') ?>
            </div>

            <div class="col-md-4">
                <strong>Statut</strong><br>
                <?php if (empty($course['heure_arrivee'])): ?>
                    <span class="badge bg-warning text-dark">En cours</span>
                <?php else: ?>
                    <span class="badge bg-success">Terminée</span>
                <?php endif; ?>
            </div>

        </div>
    </div>
</div>

<div class="card shadow-sm mb-4">
    <div class="card-header bg-dark text-white">
        Détails techniques
    </div>

    <div class="card-body">
        <div class="row g-3">

            <div class="col-md-4">
                <strong>Nombre de kilomètre</strong><br>
                <?= number_format((float)$course['nb_kilometre'], 1, ',', ' ') ?> km
            </div>

            <div class="col-md-4">
                <strong>Prix de la course</strong><br>
                <span class="fw-bold">
                    <?= number_format((float)$course['prix_course'], 0, ',', ' ') ?> Ar
                </span>
            </div>

        </div>
    </div>
</div>

<div class="card shadow-sm mb-4">
    <div class="card-header bg-secondary text-white">
        Moto & Conducteur
    </div>

    <div class="card-body">
        <div class="row g-3">

            <div class="col-md-6">
                <strong>Moto</strong><br>
                <?= htmlspecialchars(($course['marque'] ?? '') . ' ' . ($course['modele'] ?? '')) ?>
            </div>

            <div class="col-md-6">
                <strong>Conducteur</strong><br>
                <?= htmlspecialchars(($course['prenom'] ?? '') . ' ' . ($course['nom'] ?? '')) ?>
            </div>

        </div>
    </div>
</div>

<div class="d-flex gap-2">
    <?php if (empty($course['heure_arrivee'])): ?>
        <a href="/course/modifier/<?= urlencode($course['id_course']) ?>"
           class="btn btn-outline-primary">
            <i class="bi bi-pencil"></i> Modifier
        </a>

        <a href="/course/valider/<?= urlencode($course['id_course']) ?>"
           class="btn btn-success"
           onclick="return confirm('Valider cette course ?');">
            <i class="bi bi-check2-circle"></i> Valider la course
        </a>
    <?php else: ?>
        <button class="btn btn-outline-secondary" disabled>
            <i class="bi bi-lock"></i> Course terminée
        </button>
    <?php endif; ?>
</div>
