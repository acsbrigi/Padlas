<?php
error_reporting(0);
ini_set("display_error",1);

$email = trim($_POST["email"]);
$username = trim($_POST["topicDescription"]);
$password = trim($_POST["topicDescription"]);
$password2 = trim($_POST["topicDescription"]);


//Hibakezelés - validálni kell, hogyha miden adat meg van adva és ki van töltve, akkor jönn ez: 

if($user->newUserRegistration($username,$email,$password, $password2)){
    //Ha sikerült az új téma létrehozása, akkor jelezzünk vissza a felhasználónak. 
}


?>