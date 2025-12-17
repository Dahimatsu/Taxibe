<title>Liste des Chauffeurs</title>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Liste des chauffeurs</h1>
    <a href="/" class="btn btn-secondary">Retour</a>
</div>

<table class="table table-striped table-hover">
    <thead class="table-dark">
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Prénom(s)</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($chauffeurs as $chauffeur) { ?>
        <tr>
            <td><?= $chauffeur['id_chauffeur'] ?></td>
            <td><?= $chauffeur['nom'] ?></td>
            <td><?= $chauffeur['prenom'] ?></td>
            <td>
                <a href="#" class="btn btn-sm btn-primary">Modifier</a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>