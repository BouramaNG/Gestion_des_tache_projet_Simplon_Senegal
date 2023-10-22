<?php
require_once("configuration.php");
function check()
{
    if (!empty($_POST)) {
        if (empty($_POST["utilisateur"])) {
            $GLOBALS["errorUser"] = "Merci de remplir ce champs";
        }else {
            $GLOBALS["valueUser"] = $_POST["utilisateur"];
        }

        if (empty($_POST["email"])) {
            $GLOBALS["errorEmail"] = "Merci de remplir ce champs";
        }else {
            $GLOBALS["valueEmail"] = $_POST["email"];
        }
        
        if (empty($_POST["password"])) {
            $GLOBALS["errorPassword"] = "Merci de remplir ce champs";
        }else {
            $GLOBALS["valuePassword"] = $_POST["password"];
        }
        if (empty($_POST["confirmpassword"])) {
            $GLOBALS["errorConfirmPassword"] = "Merci de remplir ce champs";
        }else {
            $GLOBALS["valueConfirmPassword"] = $_POST["ConfirmPassword"];
        }
    }
    
}





?>