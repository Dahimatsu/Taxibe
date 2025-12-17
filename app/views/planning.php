<div class="row justify-content-center">
  <div class="col-lg-9">

    <div class="d-flex align-items-center justify-content-between mb-3">
      <div>
        <h2 class="fw-bold mb-0">
          <i class="bi bi-calendar-week me-1"></i> Planning moto
        </h2>
        <small class="text-muted">Affecter une moto à un conducteur pour une date</small>
      </div>
      <a href="/course" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Retour
      </a>
    </div>

    <div class="card shadow-sm mb-4">
      <div class="card-header bg-primary text-white">
        <i class="bi bi-plus-circle me-1"></i> Nouveau planning
      </div>
      <div class="card-body">

        <?php if (!empty($error)) { ?>
          <div class="alert alert-danger"><?= $error ?></div>
        <?php } ?>

        <?php if (!empty($success)) { ?>
          <div class="alert alert-success"><?= $success ?></div>
        <?php } ?>

        <form action="/planning-moto/store" method="post" class="row g-3">

          <div class="col-md-4">
            <label class="form-label">Date</label>
            <input type="date" name="date_planning" class="form-control" required>
          </div>

          <div class="col-md-4">
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

          <div class="col-md-4">
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

          <div class="col-12 text-end">
            <button type="reset" class="btn btn-outline-secondary">
              <i class="bi bi-x-circle"></i> Effacer
            </button>
            <button type="submit" class="btn btn-primary">
              <i class="bi bi-check-circle"></i> Enregistrer
            </button>
          </div>
        </form>

      </div>
    </div>

    <?php if (isset($plannings) && count($plannings) > 0) { ?>
      <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
          <i class="bi bi-card-list me-1"></i> Plannings enregistrés
        </div>
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-striped table-hover mb-0 align-middle">
              <thead class="table-light">
                <tr>
                  <th>Date</th>
                  <th>Moto</th>
                  <th>Conducteur</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($plannings as $p) { ?>
                  <tr>
                    <td><?= $p['date_planning'] ?></td>
                    <td><?= $p['marque'] ?? '' ?> <?= $p['modele'] ?? '' ?></td>
                    <td><?= $p['nom'] ?? '' ?> <?= $p['prenom'] ?? '' ?></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    <?php } else { ?>
      <div class="alert alert-info">
        Aucun planning enregistré pour le moment.
      </div>
    <?php } ?>

  </div>
</div>
