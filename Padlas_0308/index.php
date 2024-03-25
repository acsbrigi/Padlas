<?php

// MODEL BEEMELÉSE A KEZDŐOLDALRA:
require_once("view/loginForm.php");
require_once("model/config.php");
require_once("model/database.php");
require_once("model/user.php");
require("controller/error.php");

// A BEJELENTKEZÉS ELVÉGZÉSÉHEZ AZ ALÁBBI VÁLTOZÓKRA LESZ SZÜKSÉGEM:
$apperror = new AppError();
$config = new Config("config/config.json"); 
$dbconn = new Database($config);
$user = new User($dbconn->getConnection());

//Létrehozok egy $userLogin változót
$userLogin;

// HA A FELHASZNÁLÓ MEGADTA AZ ADATAIT, AKKOR AZT ELKÜLDÖM AZ ADATBÁZISNAK ÍGY:

if(isset($_POST["submitLogin"])){
  $userLogin = $user->getLoginUser($_POST['username'], $_POST['password']); // A felhasználónév és jelszó átadása

}






?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style/loginStyle.css">
    <title>Bejelentkezés</title>
</head>
<body>

</body>
<?php
require_once("view/footer.html");
?>
</html>