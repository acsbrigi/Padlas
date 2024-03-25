<?php  // itt az adott tárolóban elhelyezett termékek törléséhez példányosítok egy storage-ot. 
require_once("config.php");
require_once("database.php");
require_once("storage.php");

// Ellenőrizzük, hogy van-e id paraméter az AJAX kérésben
if(isset($_GET['id'])) {
    // Az id paraméter értékét eltároljuk egy változóban
    $storageId = $_GET['id'];
    
    // Konfiguráció és adatbázis kapcsolat létrehozása
    $config = new Config("../config/config.json"); 
    $dbconn = new Database($config);

    // Storage objektum létrehozása az adatbázis kapcsolattal
    $storage = new Storage($dbconn->getConnection());
    
    // Termékek törlése az átadott id alapján
    echo $storage->removeProductsFromStorage($storageId);
} else {
    // Ha nincs id paraméter az AJAX kérésben, akkor hibaüzenetet küldünk vissza
    echo "Hiba: hiányzó id paraméter";
}