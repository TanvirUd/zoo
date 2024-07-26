<form action="" method="post">
  <div class="container min-vh-100 ">
      <div class="row justify-content-center bg-light mt-5">
          <div class="col-md-8">
              <h2 class="text-center mb-4 mt-4">Affectation des rôles aux membres du personnel</h2>
              
              <div class="row mb-3">
                  <div class="col-md-6 col-sm-12">
                      <div class="input-group">
                          <label for="nomPerso" class="input-group-text">Sélectionner un membre du personnel</label>
                          <select class="form-select" aria-label="Default select example">
                            <!-- option select nom du personnel -->
                            <?= $selectNomsPersonnel ?>
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

                  
                        
                      </tbody>
                  </table>
              </div>
              
          
          </div>
      </div>
  </div>
</form>