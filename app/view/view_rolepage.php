<form action="index.php?controller=role&action=" method="post">
  <div class="container min-vh-100 ">
    <div class="row justify-content-center bg-light mt-5">
      <div class="col-md-8">
        <h2 class="text-center mb-4 mt-4">Gestion des rôles</h2>

        <div class="row mb-3">
          <div class="col-md-6 col-sm-12">
            <div class="input-group">
              <label for="search" class="input-group-text">Chercher</label>
              <input type="search" class="form-control" id="search" placeholder="Rechercher un rôle...">
            </div>
          </div>

          <div class="text-center col">
            <button class="btn btn-primary fw-bold" type="button" popovertarget="ajouter">+ Ajouter</button>

            <!-- formulaire popover pour ajout d'un ouveau rôle applicatif -->
            <div class="container mt-6" id="ajouter"  popover>
              <h3 class="mb-4">Ajouter un nouveau rôle applicatif</h3>

              <form action="index.php?controller=role&action=" method="POST">
                <div class="container mt-5">
                  <div class="row mb-3">
                    <label for="roleApplicatif" class="col-form-label col-lg-3 text-start">Rôle Applicatif</label>
                    <div class="col-lg-4">
                      <select class="form-select" id="roleApplicatif" name="roleApplicatif" required>
                        <option value="" selected disabled>Choisissez un rôle</option>
                        <?php
                        //test de rôles
                        $roles = ['animaux_developpeur', 'animaux_reception', 'animaux_coordinateur'];
                        foreach ($roles as $role) {
                          echo "<option value=\"$role\">$role</option>";
                        }
                        ?>
                      </select>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="nomApplication" class="col-form-label col-lg-3 text-start">Nom de l'Application</label>
                    <div class="col-lg-4">
                      <select class="form-select" id="nomApplication" name="nomApplication" required>
                        <option value="" selected disabled>Choisissez une application</option>
                        <?php
                        //test d'applications
                        $applications = ['Gestiond du parc animalier', 'Gestion des ateliers', 'Gestion des hébergements'];
                        foreach ($applications as $app) {
                          echo "<option value=\"$app\">$app</option>";
                        }
                        ?>
                      </select>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="bddApplication" class="col-form-label col-lg-3 text-start">Base de Données de l'Application</label>
                    <div class="col-lg-4">
                      <select class="form-select" id="bddApplication" name="bddApplication" required>
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
              <!-- <tr>
                        <th scope="row " >animaux_coordinateur</th>
                          <td>Gestion du parc Animalier</td>
                          <td>BdAnimaux</td>
                          <td>
                            <input class="btn btn-primary fw-bold" type="submit" value="Modifier">
                            <input class="btn btn-danger fw-bold" type="submit" value="Supprimer">
                          </td>
                      </tr>

                      <tr>
                        <th scope="row " >animaux_developpeur</th>
                          <td>Gestion du parc Animalier</td>
                          <td>BdAnimaux</td>
                        <td>
                          <input class="btn btn-primary fw-bold" type="submit" value="Modifier">
                          <input class="btn btn-danger fw-bold" type="submit" value="Supprimer">
                        </td>
                      </tr>

                      <tr>
                        <th scope="row " >animaux_reception</th>
                          <td>Gestion des ateliers</td>
                          <td>BdAteliers</td>
                        <td>
                          <input class="btn btn-primary fw-bold" type="submit" value="Modifier">
                          <input class="btn btn-danger fw-bold" type="submit" value="Supprimer">
                        </td>
                      </tr> -->

              <?php

              $roleApplicatifs = [
                ['idAppli' => '1', 'idRoleAppli' => 'animaux_coordinateur', 'bdd' => 'BdAnimaux'],
                ['idAppli' => '2', 'idRoleAppli' => 'animaux_stagiaire', 'bdd' => 'BdAnimaux'],
              ] ?>
              <?php foreach ($roleApplicatifs as $role) : ?>
                <tr>
                  <th scope="row"><?php echo htmlspecialchars($role['idAppli']); ?></th>
                  <td><?php echo htmlspecialchars($role['idRoleAppli']); ?></td>
                  <td><?php echo htmlspecialchars($role['bdd']); ?></td>
                  <td>
                    <button class="btn btn-primary fw-bold" type="button">Modifier</button>
                    <button class="btn btn-danger fw-bold" type="button">Supprimer</button>
                  </td>
                </tr>
              <?php endforeach; ?>

            </tbody>
          </table>
        </div>
</form>

</div>
</div>
</div>