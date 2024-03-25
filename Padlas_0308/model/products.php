<?php
/* MINDEN TERMÉKEKKEL KAPCSLATOS SQL UTASÍTÁST IDE KELL ÍRNI: 
 TERMÉKEK LEKÉRDEZÉSÉT ÉS ÚJ TERMÉK LÉTREHOZÁSÁHOZ AZ SQL UTASÍTÁSOKAT IDE ÍRJUK MEG KÜLÖN-KÜLÖN FÜGGVÉNYBEN! */

public class Products{
    private $dbconn;

}

public function __construct($db){ // a topic osztály konstruktora,ami egy paraméteres konstruktor.
    if (empty($db)){
      throw new Exception("Hibás adatbázis kapcsolat");
    }
    $this->dbconn = $db;
  }

public function getSearched($text, $limit = 0, $offset = 0) {
  try {
    $textLike = "%$text%";
    $sql = "SELECT topic, title, description, createTime, postNumber FROM padlas WHERE topicId=0";
    $sql .= $limit > 0 ? " LIMIT $limit OFFSET $offset" : "";
    $query = $this->dbconn->prepare($sql);
    $query->bindValue("textLike",$textLike,PDO::PARAM_STR);
    $query->execute();
    return $query->fetchAll();
  } catch (PDOException $e){
    
  }
}
 
 
  /* I. Ide kell jönnie egy olyan univerzális lekérdezésnek / lekérdezéseknek, ami/amik mindig aszerint kérdezi le
   a termékeket az adatbázisból, amilyen adatokat a felhasználó kiválasztott a termékkereső form-jában.*/





  /*II. Ide kell jönnie az új termék létrehozásáért felelős SQL utasításnak. */





  /*III.Ide kell jönnie a termékadatok módosításáért felelős SQL utasításnak. */


  /*Ide kell jönnie a termék törlését végző sql utasításoknak */





?>