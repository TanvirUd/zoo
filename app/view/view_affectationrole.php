<form action="" method="post">
  <div class="container min-vh-100 ">
    <div class="row justify-content-center bg-light mt-5">
      <div class="col-md-8">
        <h2 class="text-center mb-4 mt-4">Affectation des rôles aux membres du personnel</h2>

        <div class="row mb-3">
          <div class="col-md-10 col-sm-12">
            <div class="input-group">
              <label for="nomPerso" class="input-group-text">Sélectionner un membre du personnel</label>
              <select class="form-select" aria-label="Default select example">
                <!-- test option select nom du personnel -->
                <?= //$selectNomsPersonnel;
                $nomPersonnel = [
                  'louis Louis' => 'louis Louis',
                  'marc Marc' => 'marc Marc',
                  'laura Laura' => 'laura Laura',
                  'marie Marie' => 'marie Marie',
                ];

                foreach ($nomPersonnel as $key => $value) {
                  $value = $key;
                  echo "<option value='$key'>$value</option>";
                }
                ?>
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
                <!-- éléments du corps -->
                <tr>
                  <th scope="row ">Gestiond du parc animalier</th>
                  <td>
                    <select class="form-select" aria-label="Default select example">
                      <!-- test affichage des options select -->
                      <?=
                      $rolesAnimaliers = [
                        'animaux_cordinateur' => 'animaux_cordinateur',
                        'animaux_developpeur' => 'animaux_developpeur',
                      ];

                      foreach ($rolesAnimaliers as $key => $value) {
                        $value = $key;
                        echo "<option value='$key'>$value</option>";
                      } ?>
                    </select>
                  </td>
                </tr>

                <tr>
                  <th scope="row ">Gestion des ateliers</th>
                  <td>
                    <select class="form-select" aria-label="Default select example">
                    <!-- test affichage des options select -->
                      <?=
                      $rolesAteliers = [
                        'atelier_cordinateur' => 'atelier_cordinateur',
                        'atelier_developpeur' => 'atelier_developpeur',
                      ];

                      foreach ($rolesAteliers as $key => $value) {
                        $value = $key;
                        echo "<option value='$key'>$value</option>";
                      } ?>
                    </select>
                  </td>
                </tr>

                <tr>
                  <th scope="row ">Gestion des hébergements</th>
                  <td>
                    <select class="form-select" aria-label="Default select example">

                    <!-- test affichage des options select -->
                      <?=
                      $rolesHebergements = [
                        'hebergement_cordinateur' => 'hebergement_cordinateur',
                        'hebergement_developpeur' => 'hebergement_developpeur',
                      ];

                      foreach ($rolesHebergements as $key => $value) {
                        $value = $key;
                        echo "<option value='$key'>$value</option>";
                      } ?>
                    </select>
                  </td>
                </tr>
              </tbody>
            </table>
            <button class="btn btn-primary" type="submit">Valider</button>

          </div>
        </div>
      </div>
    </div>
</form>