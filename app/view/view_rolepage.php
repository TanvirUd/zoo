<form action="index.php?controller=mother&action=homepage" method="post">
  <div class="container min-vh-100 ">
    <div class="row justify-content-center bg-light mt-5">
      <div class="col-md-8">
        <h2 class="text-center mb-4 mt-4">Gestion des rôles</h2>
        <!-- affichage message d'erreur -->
        <?php
        if (isset($errors)) {
          echo '<div class="alert alert-danger" role="alert">';
          echo $errors[0];
          echo '</div>';
        }
        ?>

        <div class="row mb-3">
          <div class="col-md-6 col-sm-12">
            <div class="input-group">
              <label for="search" class="input-group-text">Chercher</label>
              <input type="search" class="form-control" id="search" placeholder="Rechercher un rôle...">
            </div>
          </div>

          <div class="text-center col mb-3">
            <button class="btn btn-primary fw-bold" type="button" popovertarget="ajouter">+ Ajouter</button>
          </div>
        </div>

        <div class="table-responsive table-responsive-md">
          <!-- tableau -->
          <table class="table table-striped table-hover">
            <!-- entête du tableau -->
            <thead>
              <tr>
                <!-- noms des colonnes -->
                <th>Identifiant du rôle applicatif</th>
                <th>Nom de l'application</th>
                <th>BDD de l'application</th>
                <th>Action</th>
              </tr>
            </thead>
            <!-- ELEMENTS A DYNAMISER -->
            <!-- corps du tableau -->
            <tbody class="table-group-divider">
              <!-- éléments du corps -->
                <?php if (isset($roleApplicatifs) && is_array($roleApplicatifs)): ?>
                  <?php foreach ($roleApplicatifs as $applicationData): ?>
                    
                      <?php
                        $roleId = $applicationData['roleApplicatifs']->getIdAppli();
                        $roleName = $applicationData['roleApplicatifs']->getIdRoleAppli();
                        $appDb = $applicationData['application']->getDbAppli();
                        $dbName = $applicationData['application']->getNomAppli();
                      ?>
                    <tr>
                      <th scope="row"><?php echo $roleName; ?></th>
                      <td><?php echo $dbName; ?></td>
                      <td><?php echo $appDb; ?></td>
                      <td>
                        <div class="d-flex">
                        <form method="post" action="index.php?controller=RoleApplicatif&action=updateRole">
                          <button class="btn btn-primary fw-bold me-2 " type="button">Modifier</button>
                        </form>
                        <form method="post" action="index.php?controller=RoleApplicatif&action=deleteRole">
                          <input type="hidden" name="roleName" value="<?php echo $roleName; ?>">
                          <button class="btn btn-danger fw-bold" type="submit">Supprimer</button>
                        </form>
                        </div>
                    
                      </td>
                    </tr>
                  <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</form>



<!-- formulaire popover pour ajout d'un ouveau rôle applicatif -->
<div class="container mt-6" id="ajouter" popover>
  <h3 class="mb-4 text-center">Ajouter un nouveau rôle applicatif</h3>
  <form action="index.php?controller=roleApplicatif&action=createRole" method="POST">
    <div class="container mt-5 text-center">
      <div class="row mb-3">
        <label for="idAppli" class="col-form-label col-lg-3 text-start">Nom de l'Application</label>
        <div class="col-lg-4">
        <select class="form-select" id="idAppli" name="idAppli" required>
          <option value="" selected disabled>Choisissez une application et un rôle</option>
          <?php if (isset($roleApplicatifs) && is_array($roleApplicatifs)): ?>
                <?php foreach ($roleApplicatifs as $applicationData): ?>
                    <?php
                        $roleName = $applicationData['roleApplicatifs']->getIdRoleAppli();
                        $dbName = $applicationData['application']->getNomAppli();
                        $roleId = $applicationData['roleApplicatifs']->getIdAppli();
                    ?>
                    <option value="<?php echo $roleId; ?>">
                        <?php echo $dbName; ?> - <?php echo $roleName; ?>
                    </option>
                <?php endforeach; ?>
            <?php endif; ?>
        </select>
        </div>
      </div>

      <div class="row mb-3">
        <label for="nomRole" class="col-sm-3 col-form-label text-start">Saisir le nom du rôle</label>
        <div class="col-lg-4">
          <input type="text" class="form-control" id="nomRole" name="nomRole" placeholder="Nom du rôle" required>
        </div>
      </div>

      <div class="row mb-3">
        <label for="bddApplication" class="col-form-label col-lg-3 text-start">Mot de passe de l'Application</label>
        <div class="col-lg-4">
          <input type="text" class="form-control" id="mdpAppli" name="mdpAppli" placeholder="Mot de passe" required>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-7">
          <button type="submit" class="btn btn-primary">Ajouter</button>
        </div>
      </div>
  </form>
</div>