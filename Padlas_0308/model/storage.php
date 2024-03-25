<?php
/* MINDEN TÁROLÓKKAL KAPCSLATOS SQL UTASÍTÁST IDE KELL ÍRNI: 
 TÁROLÓK LEKÉRDEZÉSÉT ÉS ÚJ TÁROLÓK LÉTREHOZÁSÁHOZ AZ SQL UTASÍTÁSOKAT IDE ÍRJUK MEG KÜLÖN-KÜLÖN FÜGGVÉNYBEN! */

 $error = ""; // az error üzenetnek véltozó
 $msg = ""; // a message-nek változó
 class storageException extends Exception{}

class Storage{
  private $dbconn;


  public function __construct($db){ // a topic osztály konstruktora,ami egy paraméteres konstruktor.
      if (empty($db)){
        throw new Exception("Hibás adatbázis kapcsolat");
      }
      $this->dbconn = $db;
  }

  /* I. Ide kell jönnie a storageList.php betöltésekor azonnal megívásra kerülő tárolók lekérdezésének, ami tartalmazza a tároló nevét és a tárolóban lévő termékek darabszámát.*/

    public function storageLoad(){
      try{
        $sqlSelectStorageLoad = "SELECT id, taroloNev, keszlet FROM tarolok";
        $querySelectStorageLoad = $this->dbconn->prepare($sqlSelectStorageLoad); //lekérdezés előkésztíése
        $querySelectStorageLoad->execute();
        return $querySelectStorageLoad->fetchAll();
      }
      catch(Exception $e){
        $error = "Adatbázis lekérdezési hiba: ".$e->getMessage();
      }

    
    }


    /*TÁROLÓ TÖRLÉSE*/

    public function deleteStorage($storageId){
      try{
          $sqlDeleteStorage = "DELETE FROM tarolok WHERE id = :azonosito"; // megírom a paraméteres lekérdezést. 
          $queryDeleteStorage = $this->dbconn->prepare($sqlDeleteStorage); // futtatom
          $queryDeleteStorage->bindParam(":azonosito", $storageId, PDO::PARAM_INT); // megmondom, hogy az sql utasításban a paraméter helyére a $storageId-ben tárolt érték menjen
          $queryDeleteStorage->execute(); // futtatom
  
          // Sikeres törlés esetén visszaadhatunk valamilyen visszajelzést vagy jelzőt
          return true;
      } catch(Exception $e){
          // Hiba esetén kezeljük azt
          $error = "Törlési hiba: ".$e->getMessage();
          return false;
      }
  }
  
    

    /*TERMÉK ÁTADÁSA MÁSIK TÁROLÓBA - SZTEM EZT CSAK A TERMÉK ADATLAPON LEHESSEN VÉGREHAJTANI, EZÉRT ÉN A PRODUCTS.PHP-BA TENNÉM!! 
    Ennek a logikája az, hogyha kiválaszt egy másik raktárat,akkor abba a raktárba átkerüljön a termék és az eredetiből kerüljön ki. 
    

    public function putAnotherStorage(){
      try{

      }catch(Exception $e){
        $error = "Tárolók közötti átadás  hiba: ".$e->getMessage();
      }
    }*/


    /*TERMÉKEK KIVÉTELE A TÁROLÓBÓL = AZ ÖSSZES TERMÉK TÖRLÉSE,AMI AZ ADOTT AZONOSÍTÓJÚ TÁROLÓBAN VAN
      ennek a logikája az, hogyha kivesszük a termékeket egy tárolóból, akkor onnantól a termékeknem NEM kell, hogy szerepeljenek a termékek táblában 
      Ha rányom az ikonra, akkor felugró ablak figyelmeztessen arra, hogyha kiveszi a termékeket a tárolóból, akkor az összes termék törlődik
      Ha a tárolóban lévő termékeketát akarja rakni másik tárolóba, akkor a termékek adatlapján lehetséges a termék tárolóját módosítani.
      Életszrű példa: Eldöntötte, hogy leselejtezi / kidobja az adott tárolóban lévő termékeket és egyszerre akarja az egész tárolót üríteni és 
      a tárolóban lévő termékeket meg törölni a rendszerből. Viszont a tárolót magát nem dobja ki, mert abba új ruhákat akar tenni.*/

    public function removeProductsFromStorage($storageId){
      try{
          $sqlRemoveItem = "DELETE FROM termekek WHERE taroloID = :azonosito";
          $queryRemoveItem = $this->dbconn->prepare($sqlRemoveItem);
          $queryRemoveItem->bindParam(":azonosito", $storageId);
          $queryRemoveItem->execute();
          return true;
      }catch(Exception $e){
        $error = "Törlési hiba: ".$e->getMessage();
        return false;
        
      }
    }



  /*II. ÚJ TÁROLÓ LÉTREHOZÁSA */
  public function create_new_storage(){
    try{
      $random = rand(1,1000000); // generálok a random változóba egy véletlenszámot.
      $sqlNewStorage = "INSERT INTO tarolok (taroloNev, keszlet, letrehozasDatum) VALUES (:random, 0, NOW())"; // megírom az sql utasítást, amiben a :random egy paraméter
      $queryNewStorage =  $this->dbconn->prepare($sqlNewStorage);// előkészítem az utasítást
      $queryNewStorage->bindValue("random",$random); // megadom,, hogy az sql utasításban lévő :random paraméternek a $random változóba belegenerált véletlenszám az értéke.
      $queryNewStorage->execute(); //futtatom az utasítást.

      //ide meg kell írni egy select-et, ami kiolvassa azt a sort, aminek a tarolo neve a random
      //select id from storage where taroloNev = :random; //fetch-el kiolvaso

      $sqlSelectStorage = "SELECT * FROM tarolok WHERE taroloNev = :random";
      $querySelectStorage = $this->dbconn->prepare($sqlSelectStorage);
      $querySelectStorage->bindValue(":random", $random);
      $querySelectStorage->execute();
      $result = $querySelectStorage->fetch(PDO::FETCH_ASSOC);

      if($result) {
        $storageId = $result['id'];

        // Tároló nevének frissítése az azonosítóra
        $sqlUpdateStorageName = "UPDATE tarolok SET taroloNev = :storageId WHERE taroloNev = :random";
        $queryUpdateStorageName = $this->dbconn->prepare($sqlUpdateStorageName);
        $queryUpdateStorageName->bindValue(":storageId", $storageId);
        $queryUpdateStorageName->bindValue(":random", $random);
        $queryUpdateStorageName->execute();

        return $storageId;
      }else {
        throw new Exception("Az újonnan létrehozott tároló azonosítójának lekérdezése sikertelen.");
      }
      //update 
      //update storage set taroloNev = id where id = fetch id
      //return fentchelt id;

      /*$queryLastInserID = "SELECT LAST_INSERT_ID FROM  "
      $this->dbconn->lastInsertId();
      return*/
    }catch(Exception $e){
      $error = "Adatbázis mentési hiba: ".$e->getMessage();
    }
  }
}



?>