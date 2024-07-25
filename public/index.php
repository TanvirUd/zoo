<?php

session_start();

$strCtrl    = $_GET['controller']??'home';
$strMethod  = $_GET['action']??'homepage';

$strCtrlFileLocation = "../app/controller/".$strCtrl."_controller.php"; // String pour accéder le controller
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
