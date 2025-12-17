<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Taxi Moto – Gestion</title>

    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/typography.css">
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/bootstrap/icons/bootstrap-icons.min.css">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
</head>

<body class="d-flex flex-column min-vh-100">

    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
            <div class="container">

                <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="/">
                    <i class="bi bi-bicycle"></i>
                    <span>Taxi Moto</span>
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNav" aria-controls="navbarNav"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">

                        <li class="nav-item">
                            <a class="nav-link <?= ($_SERVER['REQUEST_URI'] == '/') ? 'active' : '' ?>" href="/">
                                <i class="bi bi-house-door me-1"></i> Accueil
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link <?= str_contains($_SERVER['REQUEST_URI'], 'courses') ? 'active' : '' ?>"
                                href="/courses">
                                <i class="bi bi-list-check me-1"></i> Gérer les courses
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link <?= str_contains($_SERVER['REQUEST_URI'], 'rapport') ? 'active' : '' ?>"
                                href="/rapport-financier">
                                <i class="bi bi-graph-up-arrow me-1"></i> Rapport financier
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main class="container my-5 flex-grow-1">
        <?php
        if (isset($page)) {
            require $page;
        }
        ?>
    </main>

    <footer class="bg-dark text-white py-2 mt-auto">
        <div class="container text-center">
            <small class="text-white-50">
                Projet Taxi-Moto – Examen S3 • ETU004054 & ETU004201 • Madagascar 🇲🇬
            </small>
        </div>
    </footer>

    <script src="/assets/bootstrap/js/bootstrap.bundle.min.js"
        nonce="<?= Flight::get('csp_nonce') ?>"></script>
</body>

</html>
