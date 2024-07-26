<form action="" method="post">
  <div class="container min-vh-100 ">
      <div class="row justify-content-center bg-light mt-5">
          <div class="col-md-8">
              <h2 class="text-center mb-4 mt-4">Définition des droits associés à un rôle</h2>
              
              <div class="row mb-3">
                  <div class="col-md-10 col-sm-12">
                      <div class="input-group">
                          <label for="nomPerso" class="input-group-text">Sélectionner un rôle applicatif</label>
                          <select class="form-select" aria-label="Default select example">
                            <!-- option select rôles-->
                           <?php 
                           $roles = [
                               'animaux_developpeur' => 'animaux_developpeur',
                               'animaux_reception' => 'animaux_reception',
                               'animaux_coordinateur' => 'animaux_coordinateur',
                           ];
                           foreach ($roles as $key => $value) {
                               $value = $key;
                               echo "<option value='$key'>$value</option>";
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
                              <th>Table</th>
                              <th>DELETE</th>
                              <th>INSERT</th>
                              <th>SELECT</th>
                              <th>UPDATE</th>   
                          </tr>
                      </thead>

                      <tbody class="table-group-divider">

                       <?php 
                        // Construction du tableau  
                       $table= 
                       [
                        'atelier' => 'atelier',
                        'table' => 'table',
                        'avoirlieu' => 'avoirlieu',
                        'client' => 'client',
                        'concerneranimal' => 'concerneranimal',
                        'reservation' => 'reservation',
                       ];
                       
                       foreach ($table as $key => $value) {
                           $value = $key;
                           echo "<tr>
                           <th scope='row ' >$value</th>
                           <td>
                               <div class='form-check form-switch'>
                                   <input class='form-check-input' type='checkbox' role='switch' id='switchDelete'>   
                               </div>
                           </td>
                           <td>
                               <div class='form-check form-switch'>
                                   <input class='form-check-input' type='checkbox' role='switch' id='switchInsert'>           
                               </div>
                           </td>
                           <td>
                               <div class='form-check form-switch'>
                                   <input class='form-check-input' type='checkbox' role='switch' id='switchSelect'>
                               </div>
                           </td>
                           <td>
                               <div class='form-check form-switch'>
                                   <input class='form-check-input' type='checkbox' role='switch' id='switchUpdate'>   
                               </div>
                           </td>
                       </tr>";
                       }
                       ?> 
                      </tbody>
                  </table>
              </div>
          </div>
      </div>
  </div>
</form>