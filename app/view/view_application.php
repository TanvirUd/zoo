<div class="container min-vh-100">
    <?php if ($servers) : ?>
        <h1 class="text-center">Application : <?= $application->getNomAppli() ?></h1>
        <p class="text-center">Votre rôle : <?= $roleApplicatif->getIdRoleAppli() ?></p>
        <div>
            <h4>Liste des tables disponibles à vous</h4>
            <ul class="list-group">
                <?php foreach ($servers as $server) : ?>
                    <li class="list-group-item"><?= $server ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php else : ?>
        <h1 class="text-center">Vous n'avez pas encore accès à cette application</h1>
        <p class="text-center">Consultez votre administrateur de données</p>
        <p class="text-center"><a href="index.php?controller=personnel&action=deconnexion"><< Retour</a></p>
    <?php endif; ?>

</div>