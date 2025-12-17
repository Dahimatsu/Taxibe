<div class="row justify-content-center">
    <div class="col-lg-8">

        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">
                    <i class="bi bi-plus-circle me-1"></i>
                    Nouvelle course
                </h5>
            </div>

            <div class="card-body">

                <form action="#" method="post" class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label">Moto</label>
                        <select name="id_moto" class="form-select" required>
                            <option value="">-- Choisir une moto --</option>
                            <?php foreach ($motos as $moto): ?>
                                <option value="<?= $moto['id_moto'] ?>">
                                    <?= $moto['marque'] . ' ' . $moto['modele'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Conducteur</label>
                        <select name="id_conducteur" class="form-select" required>
                            <option value="">-- Choisir un conducteur --</option>
                            <?php foreach ($conducteurs as $c): ?>
                                <option value="<?= $c['id_conducteur'] ?>">
                                    <?= $c['prenom'] . ' ' . $c['nom'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Date</label>
                        <input type="date" name="date_course" class="form-control" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Heure départ</label>
                        <input type="time" name="heure_depart" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Lieu de départ</label>
                        <input type="text" name="lieu_depart" class="form-control"
                            placeholder="Ex : Andoharanofotsy" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Lieu d’arrivée</label>
                        <input type="text" name="lieu_arrivee" class="form-control"
                            placeholder="Ex : Analakely" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Kilométrage (km)</label>
                        <input type="number" step="0.1" name="nb_kilometre"
                            class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Prix de la course (Ar)</label>
                        <input type="number" step="100" name="prix_course"
                            class="form-control" required>
                    </div>

                    <div class="col-12 text-end">
                        <button type="reset" class="btn btn-outline-secondary">
                            <i class="bi bi-x-circle"></i> Annuler
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle"></i> Enregistrer
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>
</div>
