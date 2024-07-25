
<?php
require '../vendor/autoload.php';
require ("../app/model/personnel_model.php");

$donnees = new PersonnelModel;
echo("coucou");
$donnees->createPersonnel();
