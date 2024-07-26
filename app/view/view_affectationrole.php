<form action="index.php?controller=role&action=affectRole" method="post">
  <div class="container min-vh-100 ">
    <div class="row justify-content-center bg-light mt-5">
      <div class="col-md-8">
        <h2 class="text-center mb-4 mt-4">Affectation des rôles aux membres du personnel</h2>

        <!-- affichage message d'erreur -->
        <?php
        if (isset($error)) {
          echo '<div class="alert alert-danger" role="alert">';
          echo $error;
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
            </div>
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
              <?php if (isset($this->_data['applications']) && is_array($this->_data['applications'])): ?>
                <?php foreach ($this->_data['applications'] as $applicationData): ?>
                  <?php
                    $application = $applicationData['application'];
                    $nomAppli = $application->getNomAppli();
                  ?>
                  <!-- éléments du corps -->
                <tr>
                  <th scope="row "><?php echo htmlspecialchars($nomAppli); ?></th>
                  <td>
                  <select class="form-select" aria-label="Default select example" name="nomAppli">
                    <?php
                    if (isset($this->_data['applications']) && is_array($this->_data['applications'])) {
                        foreach ($applicationData['roleApplicatifs'] as $role) {
                            $roleId = $role->getIdAppli();
                            $roleName = $role->getIdRoleAppli();
                            echo "<option value='" .htmlspecialchars($roleId).":".htmlspecialchars($roleName). "'>" . htmlspecialchars($roleName) . "</option>";
                        }
                    } else {
                        echo "<option value=''>Aucun role disponible</option>";
                    }
                    ?>
                </select>
                  </td>
                </tr>
                <?php endforeach; ?>
              <?php else: ?>
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