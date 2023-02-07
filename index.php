<?php

session_start();

require "logic/router.php";
require "logic/database.php";
// require "models/User.php";

$newUser = [
    "firstName" => "",
    "lastName" => "",
    "email" => "",
    "password" => ""
    ];

// Création d'un nouveau compte
if (isset ($_POST["firstName"]) && !empty($_POST["firstName"]) && isset ($_POST["lastName"]) && !empty($_POST["lastName"]) && isset ($_POST["email"]) && !empty($_POST["email"]) && isset ($_POST["password"]) && !empty($_POST["password"]) && isset ($_POST["confirmPassword"]) && !empty($_POST["confirmPassword"]) && $_POST["password"] === ($_POST["confirmPassword"])){

    $newUser["firstName"] = $_POST["firstName"];
    $newUser["lastName"] = $_POST["lastName"];
    $newUser["email"] = $_POST["email"];
    $newUser["password"] = $_POST["password"];

    $userToSave = new User($newUser["firstName"], $newUser["lastName"], $newUser["email"], $newUser["password"]);
    saveUser($userToSave);
}

// Connexion à un compte existant
if (isset ($_POST["loginEmail"]) && !empty($_POST["loginEmail"]) && isset ($_POST["loginPassword"]) && !empty($_POST["loginPassword"])){
    
    $loginEmail = $_POST["loginEmail"];
    $loginPassword = $_POST["loginPassword"];
    $userToConnect = loadUser($loginEmail);
    if (password_verify($loginPassword, $userToConnect->getPassword())){
        $_GET["route"] = "mon-compte";
        
        $_SESSION["passwordValid"]=true;
        $_SESSION["sessionId"]=$userToConnect->getId();
        
        var_dump ($_SESSION);
    }
    else{
        echo "Le mot de passe n'est pas correct";
    }
}



if (isset ($_GET["route"])){
    checkRoute($_GET["route"]);
}
else{
    checkRoute("");
}

?>