<?php
require '../vendor/autoload.php';
require ("../app/model/personnel_model.php");

session_start();
$userIsLoggedIn = false;
if (isset($_SESSION['matricule'])) {
    $userIsLoggedIn = true;
    if (isset($_SESSION['admin']) && $_SESSION['admin']) {
        $strCtrl    = $_GET['controller']??'home';
        $strMethod  = $_GET['action']??'homepage';        
    }else{
        $strCtrl    = $_GET['controller']??'application';
        $strMethod  = $_GET['action']??'application';
    }
} else {
    $strCtrl    = isset($_GET['controller']) && $_GET['controller'] == 'faker' ? 'faker' : 'personnel';
    $strMethod  = isset($_GET['controller']) && $_GET['controller'] == 'faker' ? $_GET['action'] : 'connexion';
}

if ($strCtrl == 'faker') {
    $strCtrlFileLocation = "../faker/controller/".$strCtrl."_controller.php"; // String pour accéder à faker
}else{
    $strCtrlFileLocation = "../app/controller/".$strCtrl."_controller.php"; // String pour accéder le controller
}

$strCtrlName    = ucfirst($strCtrl)."Ctrl"; // Pour définir le controller
$boolErrorFlag = false; // Pour lancer le page d'error

if (file_exists($strCtrlFileLocation)) {
    require_once($strCtrlFileLocation); // Accéder au fichier du contrôleur

    if (class_exists($strCtrlName)) {
        $objController = new $strCtrlName(); // Obtenir la classe
        if (method_exists($objController, $strMethod)) {
            $objController->$strMethod(); // Lance la méthode
        } else {
            $boolErrorFlag = true;
        }
    } else {
        $boolErrorFlag = true;
    }

} else {
    $boolErrorFlag = true;
}

if ($boolErrorFlag) {
    header("Location:index.php?controller=error&action=error404");
}