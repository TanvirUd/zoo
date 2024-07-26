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
            <div class="collapse navbar-collapse justify-content-center" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-auto">
                    <a class="nav-link active" aria-current="page" href="index.php">Accueil</a>
                <?php if(!isset($_SESSION['matricule'])) : ?>
                    <a class="nav-link" href="index.php?controller=personnel&action=inscription">Inscription</a>
                    <a class="nav-link" href="index.php?controller=personnel&action=connexion">Connexion</a>
                <?php endif; ?>
                </div>
                <?php if(isset($_SESSION['matricule'])) : ?>
                    <div class="navbar-nav ms-auto">
                    <a class="btn btn-danger fw-semibold " href="index.php?controller=personnel&action=deconnexion" role="button">Deconnexion</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </nav>


  