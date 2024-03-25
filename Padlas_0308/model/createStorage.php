<?php  // itt az új tároló létrehozásához szükséges AJAX -nak a működéséhez példányosítok egy storage-ot. 
require_once("config.php");
require_once("database.php");
require_once("storage.php");

$config = new Config("../config/config.json"); 
$dbconn = new Database($config);
$storage = new Storage($dbconn->getConnection());
echo $storage-> create_new_storage();



?>