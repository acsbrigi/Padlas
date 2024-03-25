<!--Ez az oldal a profil oldal vezérlője, így ide kell beemelni minden profil oldallal kapcsolatos elemet
pl.: 1.felhasználói adatok módosítása form
2.ha a felhasználó admin jogosultságú, akkor jelenjen meg a 2. felhasználó törlése form
3.kijelentkezés gomb-->
<?php
require_once("view/header.html");
require_once("view/modifyUserDataForm.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/loginStyle.css">
    <link rel="stylesheet" href="style/header.css">
    <title>Felhasználói profil</title>
</head>
<body>

<?php //A KIJELENTKEZÉS NEM JÓ, MERT HA A PROFIL MENÜPONTBAN A "FELHASZNÁLÓI ADATOK MÓDOSÍTÁSA" MENÜPONTRA KATTINT, AKKOR
// IS ÁTVISZ A RENDSZER A BEJELENTKEZÉS OLDALRA, PEDIG NEM KELLENE. eZÉRT VAN ITT EZ A RÉSZ KIKOMMENTELVE. 
//JAVÍTANI KELL!!!

    $logoff = trim($_GET["submit"]);
    if (isset($logoff)){
        unset($_SESSION["user"]);
        //exit(header('Location:index.php'));
        ?><script><?php echo "location.href = 'index.php';";?></script><?php
    }
?>
    
</body>
<?php
require_once("view/footer.html");
?>
</html>