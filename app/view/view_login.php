<div class="container-fluid d-flex justify-content-center align-items-center" style="height: 100vh;">
  <div class="card">
    <div class="card-body">
      <h2 class="card-title text-center mb-4">Connexion</h2>

      <!-- afficher le formulaire -->
      <form action="connexion" method="post">
        <div class="form-group mb-3">
          <label for="emailperso">Votre email</label>
          <input type="email" class="form-control" id="emailperso" name="emailperso" aria-describedby="emailHelp" placeholder="Saisir votre email"  value="<?=htmlspecialchars($email)?>">
        </div>

        <div class="form-group mb-3">
          <label for="mdp">Mot de passe</label>
          <input type="password" class="form-control" id="mdp" name="mdp" placeholder="Saisir votre mot de passe" value="<?=htmlspecialchars($mdp)?>" required>
        </div>

        <div class="d-grid">
          <button type="submit" class="btn btn-primary">Connexion</button>
        </div>
      </form>
    </div>
  </div>
</div>

