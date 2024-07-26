<?php
require '../vendor/autoload.php';
require_once('../app/controller/mother_controller.php');

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
            ['nomappli' => 'Gestion des atteliers', 'nomBdd' => 'BdAtelier']
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
            $nomAppli = strtolower(substr($applicationEntity->getDbAppli(), 2));

            $roleApplicatifModel = new RoleApplicatifModel();
            $roleApplicatifModel->createRoleApplicatif($idAppli, $nomAppli.'_coordinateur', 'coord');
            echo 'Id de l\'application : ' . $idAppli . ' Role de l\'application ' . $nomAppli.'_coordinateur Mot de passe : coord' . '<br>';
            $roleApplicatifModel->createRoleApplicatif($idAppli, $nomAppli.'_developpeur', 'devel');
            echo 'Id de l\'application : ' . $idAppli . ' Role de l\'application ' . $nomAppli.'_developpeur Mot de passe : devel' . '<br>';
            $roleApplicatifModel->createRoleApplicatif($idAppli, $nomAppli.'_superviseur', 'super');
            echo 'Id de l\'application : ' . $idAppli . ' Role de l\'application ' . $nomAppli.'_superviseur Mot de passe : super' . '<br>';            
        }
    }

    public function createAll()
    {
        $this->createPersonnal();
        $this->createApplications();
        $this->createRoles();
    }
}