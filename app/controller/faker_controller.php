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

    public function createApplications()
    {
        $nomAppli = [
            ['nomappli' => 'Gestion du parc Animalier', 'nomBdd' => 'BdAnimaux'],
            ['nomappli' => 'Gestion des atteliers', 'nomBdd' => 'BdAtelier'],
            ['nomappli' => 'Zookeeper', 'nomBdd' => 'BdKeeper'],
            ['nomappli' => 'Vétérinaire', 'nomBdd' => 'BdVeterinaire'],
            ['nomappli' => 'Conservateur du zoo', 'nomBdd' => 'BdConservateur'],
            ['nomappli' => 'Educateur du zoo', 'nomBdd' => 'BdEducateur'],
        ];

        require_once('../app/model/application_model.php');

        $applicationModel = new ApplicationModel();

        foreach ($nomAppli as $value){
            $applicationModel->createApplication($value['nomappli'], $value['nomBdd']);
            echo 'Nom de l\'application : ' . $value['nomappli'] . ' Nom de la base de données : ' . $value['nomBdd'] . '<br>';
        }
    }

    public function createRoles()
    {
        require_once('../app/model/roleApplicatif_model.php');
        require_once('../app/model/application_model.php');
        require_once('../app/entity/application_entity.php');

        $applicationModel = new ApplicationModel();
        $application = $applicationModel->getAllApplication();

        foreach ($application as $value) {
            $applicationEntity = new Application();
            $applicationEntity->hydrate($value);
            $idAppli = $applicationEntity->getIdAppli();
            $nomAppli = substr($applicationEntity->getDbAppli(), 2);
            
            
        }
    }
}