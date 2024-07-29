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
                <?php if (isset($this->_data['roleApplicatifs']) && is_array($this->_data['roleApplicatifs'])): ?>
                  <?php foreach ($this->_data['roleApplicatifs'] as $applicationData): ?>
                      <?php
                        $roleId = $applicationData->getIdAppli();
                        $roleName = $applicationData->getIdRoleAppli();
                      ?>
                    <tr>
                      <th scope="row"><?php echo $roleId; ?></th>
                      <td><?php echo $roleName; ?></td>
                      <td><?php echo ('bdd'); ?></td>
                      <td>
                        <form method="post" action="index.php?controller=RoleApplicatif&action=updateRole">
                          <button class="btn btn-primary fw-bold" type="button">Modifier</button>
                        </form>
                        <form method="post" action="index.php?controller=RoleApplicatif&action=deleteRole">
                          <input type="hidden" name="roleName" value="<?php echo $roleName; ?>">
                          <button class="btn btn-danger fw-bold" type="submit">Supprimer</button>
                        </form>
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
  <form action="index.php?controller=role&action=addNewRole" method="POST">
    <div class="container mt-5 text-center">
      <div class="row mb-3">
        <label for="nomApplication" class="col-form-label col-lg-3 text-start">Nom de l'Application</label>
        <div class="col-lg-4">
          <select class="form-select" id="nomApplication" name="nomApplication" required>
            <option value="" selected disabled>Choisissez une application</option>
            <?php
            //test d'applications
            $applications = ['Gestion du parc animalier', 'Gestion des ateliers', 'Gestion des hébergements'];
            foreach ($applications as $app) {
              echo "<option value=\"$app\">$app</option>";
            }
            ?>
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
        <label for="bddApplication" class="col-form-label col-lg-3 text-start">Base de Données de l'Application</label>
        <div class="col-lg-4">
          <select class="form-select" id="bddApplication" name="bddApplication" required>
            <!-- choix de base de données -->
            <option value="" selected disabled>Choisissez une base de données</option>
            <?php
            $databases = ['BdAnimaux', 'BdAteliers', 'BdHotellerie'];
            foreach ($databases as $db) {
              echo "<option value=\"$db\">$db</option>";
            }
            ?>
          </select>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-7">
          <button type="submit" class="btn btn-primary">Ajouter</button>
        </div>
      </div>
  </form>
</div>