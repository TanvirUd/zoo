
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <form class="row g-3 bg-light p-5" action="inscription" method="post">
        <h2 class="text-center mb-4">Créer un compte</h2>

        <?php
            if (isset($error)) 
            {
            echo '<div class="alert alert-danger" role="alert">';
            echo $error;
            echo '</div>';
            }
        ?>
        <p><small>Veuillez remplir tous les champs</small></p>
        <div class="col-md-4">
            <label for="prenom_perso_signup" class="form-label">Prénom</label>
            <input type="text" class="form-control" id="prenom_perso_signup" name="prenom_perso_signup" value="<?php echo $prenom ?>" required>
        </div>

        <div class="col-md-4">
            <label for="nom_perso_signup" class="form-label">Nom</label>
            <input type="text" class="form-control" id="nom_perso_signup" name="nom_perso_signup" value="<?=htmlspecialchars($nom)?>" required>
        </div>

        
        <div class="col-md-4">
            <label for="tel_perso_signup" class="form-label">Numéro de téléphone</label>
            <input type="tel" class="form-control" id="tel_perso_signup" name="tel_perso_signup" value="<?=htmlspecialchars($tel)?>" required>
        </div>

        <div class="col-md-6">
            <label for="mel_perso_signup" class="form-label">Email</label>
            <input type="email" class="form-control" id="mel_perso_signup" name="mel_perso_signup" aria-describedby="inputGroupPrepend" value="<?=htmlspecialchars($email)?>" required>
        </div>

        
        <div class="col-md-6">
            <label for="tel_perso_signup" class="form-label">Définir un mot de passe</label>
            <input type="password" class="form-control" id="mdp_perso_signup" name="mdp_perso_signup" aria-describedby="inputGroupPrepend"  required>
        </div>

        <div class="col-md-6">
            <label for="verifMdpPerso" class="form-label">Confirmer le mot de passe</label>
            <input type="password" class="form-control" id="verifMdpPerso" name="verifMdpPerso" aria-describedby="inputGroupPrepend" required>
        </div>

        <div class="col-md-6">
            <label for="date_naissance_perso_signup" class="form-label">Date de naissance</label>
            <input type="date" class="form-control" id="date_naissance_perso_signup" name="date_naissance_perso_signup" value="<?=htmlspecialchars($dateNaissance)?>" required>
        </div>

        <div class="col-md-12">
            <label for="adresse_perso_signup" class="form-label">Adresse</label>
            <input type="text" class="form-control" id="adresse_perso_signup" name="adresse_perso_signup" value='<?=htmlspecialchars($adresse)?>' required>
        </div>

        <div class="col-12">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                <label class="form-check-label" for="invalidCheck">
                J'accepte les conditions d'utilisation
                </label>
                    <div class="invalid-feedback">
                        Merci d'accepter les conditions d'utilisation.
                    </div>
            </div>
        </div>
        <div class="col-12">
            <button class="btn btn-primary" type="submit">Créer un compte</button>
        </div>
    </form>
</div>