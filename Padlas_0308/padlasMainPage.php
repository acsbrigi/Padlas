<!--Erre az oldalra hozzza a rendszer a felhasználót, ha sikeresen bejelentkezett.-->

<?php
        require_once("view/header.html");
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
    <link rel="stylesheet" href="style/header.css">
    <title>Padlás főoldal</title>
</head>
<body>
    

<h4 class="mainpagetext p-3">Kedves {felhasználónév}!<h3>
<h3 class="mainpagetext p-3">Üdvözünk a Padlás alkalmazásban!<h3>
<h5 class=" mainpagetext p-3">Kérjük, válassz a fenti menüpontok közül!<h5>
</body>
<?php
require_once("view/footer.html");
?>
</html>