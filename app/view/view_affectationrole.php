<form action="index.php?controller=roleApplicatif&action=affectRole" method="post">
  <div class="container min-vh-100 ">
    <div class="row justify-content-center bg-light mt-5">
      <div class="col-md-8">
        <h2 class="text-center mb-4 mt-4">Affectation des rôles aux membres du personnel</h2>

        <!-- affichage message d'erreur -->
        <?php
        if (isset($errors)) {
          echo '<div class="alert alert-danger" role="alert">';
          echo $errors[0];
          echo '</div>';
        }
        ?>
        <div class="row mb-3">
          <div class="col-md-10 col-sm-12">
            <div class="input-group">
              <label for="nomPerso" class="input-group-text">Sélectionner un membre du personnel</label>
              <select class="form-select" aria-label="Default select example" name="nomPerso">
                <?php
                if (isset($this->_data['personnels']) && is_array($this->_data['personnels'])) {
                  foreach ($this->_data['personnels'] as $personnel) {
                    $fullName = $personnel->getNomComplet();
                    $numMatricule = $personnel->getNumMatriculePerso();
                    echo "<option value='$numMatricule'>$fullName</option>";
                  }
                } else {
                  echo "<option value=''>Aucun personnel disponible</option>";
                }
                ?>
              </select>

            <!-- redirection vers formulaire d'inscription -->
            </div>
              <a class="btn btn-success mt-3" type="button" href="index.php?controller=personnel&action=inscription">Ajouter un personnel</a>
            </div>

          <div class="table-responsive table-responsive-md">
            <!-- tableau -->
            <table class="table table-striped table-hover">
              <!-- entête du tableau -->
              <thead>
                <tr>
                  <!-- noms des colonnes -->
                  <th>Nom application</th>
                  <th>Rôle applicatif associé</th>
                </tr>
              </thead>
              <!-- ELEMENTS A DYNAMISER -->
              <!-- corps du tableau -->
              <tbody class="table-group-divider">
                <?php if (isset($this->_data['applications']) && is_array($this->_data['applications'])) : ?>
                  <?php foreach ($this->_data['applications'] as $applicationData) : ?>
                    <?php
                    $application = $applicationData['application'];
                    $nomAppli = $application->getNomAppli();
                    ?>
                    <!-- éléments du corps -->
                    <tr>
                      <th scope="row "><?php echo htmlspecialchars($nomAppli); ?></th>
                      <td>
                        <select class="form-select" aria-label="Default select example" name="nomAppli:<?= $application->getIdAppli() ?>">

                          <?php
                          if (isset($this->_data['applications']) && is_array($this->_data['applications'])) {
                            echo "<option value=\"none\">Rien n'est sélectionné</option>";
                            foreach ($applicationData['roleApplicatifs'] as $role) {
                              $roleId = $role->getIdAppli();
                              $roleName = $role->getIdRoleAppli();
                              echo "<option value='" . htmlspecialchars($roleId) . ":" . htmlspecialchars($roleName) . "'>" . htmlspecialchars($roleName) . "</option>";
                            }
                            echo "<option value=\"" . htmlspecialchars($roleId) . ":delete\">Aucun rôle</option>";
                          } else {
                            echo "<option value=''>Aucun role disponible</option>";
                          }
                          ?>
                        </select>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                <?php else : ?>
                  <tr>
                    <td colspan="2">Aucune application disponible</td>
                  </tr>
                <?php endif; ?>
                <!-- Fin éléments du corps -->
              </tbody>
            </table>
            <button class="btn btn-primary" type="submit">Valider</button>
          </div>
        </div>
      </div>
    </div>
</form>