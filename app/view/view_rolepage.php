<?php require_once('partials/header.php') ?>

<div class="container min-vh-100 ">
    <div class="row justify-content-center bg-light mt-5">
        <div class="col-md-8">
            <h2 class="text-center mb-4 mt-4">Gestion des rôles</h2>
            
            <div class="row mb-3">
                <div class="col-md-6 offset-md-3 col-sm-12">
                    <div class="input-group">
                      <label for="search" class="input-group-text">Chercher</label>
                        <input type="search" class="form-control" placeholder="Rechercher un rôle...">
                    </div>
                </div>

                <div class="text-center col">
                      <button class="btn btn-primary fw-bold" type="button">+ Ajouter</button>
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

                      <tr>
                        <th scope="row " >animaux_reception</th>
                          <td>Gestion des ateliers</td>
                          <td>BdAteliers</td>
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