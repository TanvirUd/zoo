<?php
include('../app/model/personnel_model.php');
$faker = Faker\Factory::create('fr_FR');
$faker->addProvider(new Faker\Provider\fr_FR\PhoneNumber($faker));
const NB_CONTACTS = 15;
$personnelModel = new PersonnelModel();

for ($i = 0; $i < NB_CONTACTS; $i++) {
    $content = http_build_query ([
        'mel_perso_signup' => $faker->email(),
        'nom_perso_signup' => $faker->lastName(),
        'prenom_perso_signup' => $faker->firstName(),
        'date_naissance_perso_signup' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'adresse_perso_signup' => $faker->address(),
        'tel_perso_signup' => $faker->phoneNumber(),
        'mdp_perso_signup' => "admin" // Mot de passe
    ]);

    $context = stream_context_create ([
        'http' => ['method' => 'POST',
        'content' => $content]
    ]);

    $result = file_get_contents('index.php?controller=user&action=inscription', false, $context);
}