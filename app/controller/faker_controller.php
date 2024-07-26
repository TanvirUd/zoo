<?php
require '../vendor/autoload.php';
require_once('mother_controller.php');

class FakerCtrl extends MotherCtrl
{
    public function createPersonnal()
    {
        $faker = Faker\Factory::create('fr_FR');
        $faker->addProvider(new Faker\Provider\fr_FR\PhoneNumber($faker));
        $NB_CONTACTS = 15;
        require_once('../app/model/personnel_model.php');

        for ($i = 0; $i < $NB_CONTACTS; $i++) {
            $melPerso = $faker->email();
            $nomPerso = $faker->lastName();
            $prenomPerso = $faker->firstName();
            $dateNaissancePerso = $faker->date();
            $adressePerso = $faker->address();
            $telPerso = intval(substr($faker->e164PhoneNumber(), 3));

            echo $melPerso . ' ' . $nomPerso . ' ' . $prenomPerso . ' ' . $dateNaissancePerso . ' ' . $adressePerso . ' ' . $telPerso . '<br>';

            
            $personnelModel = new PersonnelModel();
            $personnelModel->createPersonnelFaker($melPerso,$nomPerso,$prenomPerso,$dateNaissancePerso,$adressePerso,$telPerso);
        }
    }
}