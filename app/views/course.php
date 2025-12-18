<div class="row justify-content-center">
    <div class="col-lg-8">

        <div class="text-center mb-4">
            <h2 class="fw-bold">
                <i class="bi bi-list-check me-1"></i>
                Gestion des courses
            </h2>
            <p class="text-muted">
                Accéder aux différentes fonctionnalités liées aux courses
            </p>
        </div>

        <div class="row g-3">

            <div class="col-md-4">
                <a href="/course/nouvelle"
                   class="card text-decoration-none h-100 shadow-sm border-0 text-center">
                    <div class="card-body">
                        <i class="bi bi-plus-circle fs-1 text-warning"></i>
                        <h5 class="mt-3">Nouvelle course</h5>
                        <p class="text-muted small">
                            Enregistrer une nouvelle course
                        </p>
                    </div>
                </a>
            </div>
            
            <div class="col-md-4">
                <a href="/course/liste"
                   class="card text-decoration-none h-100 shadow-sm border-0 text-center">
                    <div class="card-body">
                        <i class="bi bi-card-list fs-1 text-success"></i>
                        <h5 class="mt-3">Liste des courses</h5>
                        <p class="text-muted small">
                            Voir toutes les courses enregistrées
                        </p>
                    </div>
                </a>
            </div>

            <div class="col-md-4">
                <a href="/course/planning"
                   class="card text-decoration-none h-100 shadow-sm border-0 text-center">
                    <div class="card-body">
                        <i class="bi bi-calendar-week fs-1 text-primary"></i>
                        <h5 class="mt-3">Planning moto</h5>
                        <p class="text-muted small">
                            Affectation des motos par jour
                        </p>
                    </div>
                </a>
            </div>

            <div class="col-md-4 offset-md-4">
                <a href="/carburant"
                class="card text-decoration-none h-100 shadow-sm border-0 text-center">
                    <div class="card-body">
                        <i class="bi bi-fuel-pump fs-1 text-danger"></i>
                        <h5 class="mt-3">Modifier prix carburant</h5>
                        <p class="text-muted small">
                            Mise à jour du prix du carburant
                        </p>
                    </div>
                </a>
            </div>

        </div>

        <hr class="my-5">

        <div class="card border-danger shadow-sm">
            <div class="card-body text-center">
                <i class="bi bi-trash3-fill fs-1 text-danger"></i>
                <h5 class="mt-3 text-danger fw-bold">
                    Supprimer toutes les courses
                </h5>
                <p class="text-muted small">
                    Cette action est <strong>irréversible</strong>.
                    Toutes les courses enregistrées seront définitivement supprimées.
                </p>

                <?php if(isset($message)) { ?>
                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <div>
                            <?= $message ?>
                        </div>
                    </div>
                <?php } ?>

                <?php if(isset($delete)) { ?>
                    
                    <form action="/course/delete/valider" method="post" class="row justify-content-center py-4">

                        <div class="col-md-6">
                            <label class="form-label visually-hidden">Mot de passe</label>
                            <input type="password"
                                name="password"
                                class="form-control text-center"
                                placeholder="Mot de passe de validation"
                                required>
                        </div>

                        <div class="col-12 mt-3">
                            <button type="submit"
                                    class="btn btn-danger">
                                <i class="bi bi-trash3-fill me-1"></i>
                                Confirmer la suppression
                            </button>
                        </div>

                    </form>
                <?php } else { ?>
                    <a href="/course/delete"
                    class="btn btn-danger">
                        <i class="bi bi-exclamation-triangle-fill me-1"></i>
                        Supprimer toutes les courses
                    </a>
                <?php } ?>
            </div>
        </div>

    </div>
</div>
