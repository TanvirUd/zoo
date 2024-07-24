<?php require_once('partials/header.php'); ?>

<div class="container-fluid d-flex justify-content-center align-items-center" style="height: 100vh;">
  <div class="card">
    <div class="card-body">
      <h2 class="card-title text-center mb-4">Connexion</h2>
      <form action="" method="post">
        <div class="form-group mb-3">
          <label for="email">Votre email</label>
          <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" required>
        </div>

        <div class="form-group mb-3">
          <label for="mdp">Mot de passe</label>
          <input type="password" class="form-control" id="mdp" placeholder="Mot de passe" required>
        </div>

        <div class="d-grid">
          <button type="submit" class="btn btn-primary">Connexion</button>
        </div>
      </form>
    </div>
  </div>
</div>

