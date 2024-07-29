<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lama Zoo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary mb-5 fw-semibold">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Lama Zoo</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-auto">
                    <?php
                    // Récupère l'URL actuelle
                    $currentUrl = basename($_SERVER['REQUEST_URI']);
                    ?>
                    <?php if (isset($_SESSION['matricule'])) : ?>
                        <a class="nav-link <?= $currentUrl == 'index.php' ? 'active' : '' ?>" aria-current="page" href="index.php">Gestion des rôles</a>
                        <a class="nav-link <?= $currentUrl == 'index.php?controller=Role&action=permissions' ? 'active' : '' ?>" href="index.php?controller=Role&action=permissions">Définition des droits</a>
                        <a class="nav-link <?= $currentUrl == 'index.php?controller=Role&action=affectRole' ? 'active' : '' ?>" href="index.php?controller=Role&action=affectRole">Affectation des rôles</a>
                    <?php endif; ?>
                </div>
                <?php if (isset($_SESSION['matricule'])) : ?>
                    <div class="navbar-nav ms-auto ">
                        <p class="nav-item m-2"> Bonjour, <?= $_SESSION['prenom'] . " " . $_SESSION['nom'] . " !" ?> </p>
                        <a class="btn btn-danger fw-semibold " href="index.php?controller=personnel&action=deconnexion" role="button">Deconnexion</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </nav>