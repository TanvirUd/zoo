<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lama Zoo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <a href="index.php?controller=user&action=inscription">inscription</a>
    <a href="index.php?controller=user&action=connexion">connexion</a>
    <?php if(isset($_SESSION['matricule'])) : ?>
        <a href="index.php?controller=personnel&action=deconnexion">deconnexion</a>
    <?php endif; ?>