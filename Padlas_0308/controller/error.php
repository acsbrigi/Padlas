<!--Ez tartalmazza a hibakezeléshez az AppError osztályt és függvényeit.-->
<?php
class AppError{ // létrehoztam egy AppError nevű osztályt. Az ebben az osztályban található ShowModal függvény hívja meg a modális ablakot és írja bele az üzenetet
    
    
    public function __construct() { // Az AppError osztály konstruktor függvénye, ami beemeli a modális ablak kinézetét tartalmazó modal.html fájlt.
        require("view/modal.html"); // a modális ablak kinézetének beemelése
        echo "<script> var myModal = new bootstrap.Modal(document.getElementById('errorModal'), {keyboard: false}); </script>";
    }
    

    public function ShowModal($type, $msg) { // A ShowModal függvény egy kétparaméteres függvény, ami a itle paraméter értékét beleírja a modális ablak címébe, a msg-et medig a modális ablak text részébe. 

        echo "<script>
        document.getElementById('modalTitle').innerText = '".addslashes($type)."';
        document.getElementById('modalText').innerText = '".addslashes($msg)."';
        myModal.Show();
        </script>";
    }

    public function PutLog($msg) {
        global $config;
        error_log("[".date("Y.m.d h:i:s")."] ".$msg.PHP_EOL, 3, $config->getErrorLog());
    }
    

}

?>