<?php

function checkRoute(string $route) : void 
{
    if ($route === "connexion"){
        require "pages/login.php";
    }
    else if ($route === "creer-un-compte"){
        require "pages/register.php";
    }
    else if ($route === "admin-posts"){
        // if (isset ($_SESSION["passwordValid"]) && $_SESSION["passwordValid"]===true){
            require "pages/admin/post.php";
        // }
        // else{
        //     echo "Votre session n'est pas valide";
        // }
    }
    else if ($route === "admin-post-category"){
        // if (isset ($_SESSION["passwordValid"]) && $_SESSION["passwordValid"]===true){
            require "pages/admin/post-category.php";
        // }
        // else{
        //     echo "Votre session n'est pas valide";
        // }
    }
    else{
        require "pages/homepage.php";
    }}


?>