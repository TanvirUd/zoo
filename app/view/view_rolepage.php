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
         
        </div> 

          <div class="text-center col mb-3">
            <button class="btn btn-primary fw-bold" type="button" popovertarget="ajouter">+ Ajouter</button>
          </div>
        </div>

        <div class="table-responsive table-responsive-md"  >
          <!-- tableau -->
          <table class="table table-striped table-hover" id="rolesTable" 
                                                        data-toggle="table"
                                                        data-search="true"
                                                        data-show-columns="true"
                                                        data-pagination="true"
                                                        data-locale="fr-FR">
            <!-- entête du tableau -->
            <thead>
              <tr>
                <!-- noms des colonnes -->
                <th data-sortable="true">Identifiant du rôle applicatif</th>
                <th data-sortable="true">Nom de l'application</th>
                <th data-sortable="true">BDD de l'application</th>
                <th data-sortable="true">Action</th>
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
                      <button class="btn btn-primary fw-bold m-2" id="<?= $roleName ?>" popovertarget="changer" type="button" onclick="setRoleName(this.id)">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                          <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325" />
                        </svg>
                        Modifier
                      </button>
                      <form method="post" action="index.php?controller=RoleApplicatif&action=deleteRole">
                        <input type="hidden" name="roleName" value="<?php echo $roleName; ?>">
                        <button class="btn btn-danger fw-bold m-2" type="submit">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                          </svg>
                          Supprimer
                        </button>
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
                  <?php $tempTable = array(); ?>
                  <?php foreach ($roleApplicatifs as $applicationData): ?>
                      <?php
                          $roleName = $applicationData['roleApplicatifs']->getIdRoleAppli();
                          $dbName = $applicationData['application']->getNomAppli();
                          $roleId = $applicationData['roleApplicatifs']->getIdAppli();

                          $tempTable[$roleId] = $dbName;
                      ?>
                  <?php endforeach; ?>
                  <?php foreach (array_unique($tempTable) as $key => $value): ?>
                      <option value="<?= $key ?>">
                          <?= $value; ?>
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
      </div> 
  </form>
</div>

<!-- formulaire popover pour ajout d'un ouveau rôle applicatif -->
<div class="container mt-6" id="changer" popover>
  <h3 class="mb-4 text-center">Modifier le rôle</h3>
  <form action="index.php?controller=roleApplicatif&action=updateRole" method="POST">
    <div class="container mt-5 text-center">
        <div class="row mb-3">
          <label for="roleAppli" class="col-sm-3 col-form-label text-start">Nom du rôle</label>
          <div class="col-lg-4">
          <input type="text" class="form-control" id="roleAppli" name="roleAppli" value="" readonly>
          </div>
        </div>

        <div class="row mb-3">
          <label for="idAppli" class="col-form-label col-lg-3 text-start">Nom de l'Application</label>
          <div class="col-lg-4">
          <select class="form-select" id="idAppli" name="idAppli" required>
            <option value="" selected disabled>Choisissez une application et un rôle</option>
            <?php if (isset($roleApplicatifs) && is_array($roleApplicatifs)): ?>
                  <?php $tempTable = array(); ?>
                  <?php foreach ($roleApplicatifs as $applicationData): ?>
                      <?php
                          $roleName = $applicationData['roleApplicatifs']->getIdRoleAppli();
                          $dbName = $applicationData['application']->getNomAppli();
                          $roleId = $applicationData['roleApplicatifs']->getIdAppli();

                          $tempTable[$roleId] = $dbName;
                      ?>
                      ?>
                  <?php endforeach; ?>
                  <?php foreach (array_unique($tempTable) as $key => $value): ?>
                      <option value="<?= $key ?>">
                          <?= $value; ?>
                      </option>
                  <?php endforeach; ?>
              <?php endif; ?>
          </select>
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
      </div> 
  </form>
</div>


<!-- Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Connexion réussie</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Bienvenue! Vous êtes maintenant connecté.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
</div>


<?php
$showModal = false;

if (isset($_SESSION['login_success'])) {
    $showModal = true;
    unset($_SESSION['login_success']); // Détruire la variable de session après utilisation
}
?>
   
<script>
    document.addEventListener('DOMContentLoaded', function() {
        <?php if ($showModal): ?>
        var successModal = new bootstrap.Modal(document.getElementById('successModal'));
        successModal.show();
        <?php endif; ?>
    });
    </script>

<script>
function setRoleName(roleName) {
  document.getElementById('roleAppli').value = roleName;
}

$(function() {
    $('#rolesTable').bootstrapTable({
        locale: 'fr-FR',
        search: true,
        searchAlign: 'left',
        showColumns: true,
        showColumnsToggleAll: true,
        pagination: true,
        pageSize: 10,
        pageList: [10, 25, 50, 100, 'all']
    });
});

</script>
