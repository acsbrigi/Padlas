<!-- MINDEN FELHASZNÁLÓKKAL KAPCSLATOS SQL UTASÍTÁST IDE KELL ÍRNI: 
 fELHASZNÁLÓK LEKÉRDEZÉSÉT ÉS ÚJ FELHASZNÁLÓK LÉTREHOZÁSÁHOZ, MEGLÉVŐ FELHASZNÁLÓ MÓDOSÍTÁSÁHOZ,
 VAGY FELHASZNÁLÓ TÖRLÉSÉHEZ AZ SQL UTASÍTÁSOKAT IDE ÍRJUK MEG KÜLÖN-KÜLÖN FÜGGVÉNYBEN! 
 
 1. új felhasználó létrehozása - a registration.php a vezérlő és a registrationForm-on kérjük be az adatoat, amiket elmentünk (insert) az adatbázisba.
 2. felhasználó törlése - kell hozzá egy form, aminek a select-jeibe belegeneráljuk a meglévő felhasználókat és íhy kiválaszthatja a meglévő felhasznáók közül azt, akit törölni akar. 
 3. felhasználói adatok módosítása (update) - modifyUserDataForm-mal bekért adatokat update-tel küldjük az adatbázsnak
 4. Bejelentkezé<s-->

<?php
session_start();



 class User{

   
    private $dbconn;

    public function __construct($db){ // a topic osztály konstruktora,ami egy paraméteres konstruktor.
        if (empty($db)){
          throw new Exception("Hibás adatbázis kapcsolat");
          $apperror = new AppError();
          $apperror->showModal("Nem sikerült kapcsolódni az adatbázishoz", "Hibás adatbázis kapcsolat!");
        }
        $this->dbconn = $db;
    }
     

    // A BEJELENTKEZÉS OLDALON KÉRDEZI LE A FELHASZNÁLÓ ADATAIT.
    public function getLoginUser($felhasznalonev, $jelszo){
        try{
            $felhasznalonev = trim($_POST["username"]);
            $jelszo = trim($_POST["password"]);
            if(empty($felhasznalonev) || empty($jelszo))
            {
                $type="Bejelentkezési hiba!";
                $msg="Minden adatot kötelező megadni!";
                $apperror = new AppError();
                $apperror ->showModal($msg, $type);
                $apperror ->PutLog($msg); 
                
            }

            $sqlLogin = "SELECT id,username,jelszo,fullname,moderator FROM felhasznalok WHERE username=:felhasznalonev";
            //$sqlLogin = "SELECT COUNT(username) FROM felhasznalok WHERE username=".$felhasznalonev;
            $queryLogin = $this->dbconn->prepare($sqlLogin); //lekérdezés előkésztíése
            $queryLogin->bindValue("felhasznalonev", $felhasznalonev, PDO::PARAM_STR); // a lekérdezéshez hozzáadjuk az adatokat, hogy melyik jelszóhoz tartozó felhasználói adatokat kérem le az adatbázisból
            // $queryLogin->bindValue("jelszo", $jelszo, PDO::PARAM_STR);
            $queryLogin->execute();
            if($queryLogin->rowCount() != 1){

                $type="Bejelentkezési hiba!";
                $msg="Hibás felhasználói azonosító! Kérem, adja meg újra a felhasználói azonosítóját!";
                $apperror = new AppError();
                $apperror->showModal($msg, $type);
                $apperror->PutLog($msg);
            
                
            }
            
            $felhasznalo2 = $queryLogin->fetch(PDO::FETCH_ASSOC); // a fetch-el olvasom ki az adatbázisnak az egy sorát és ezt belerakom a felhazsnalo2 neve változóba asszociatív tömbként. 
            
            if($jelszo != $felhasznalo2["jelszo"])
            {

                $type="Bejelentkezési hiba!";
                $msg="Hibás jelszó! Kérem, adja meg újra a jelszavát!";
                $apperror = new AppError();
                $apperror->showModal($msg, $type);
                $apperror->PutLog($msg);
            }
            
            $_SESSION["user"] = array("felhasznalonev"=>$felhasznalo2["username"], "fullname"=>$felhasznalo2["fullname"], "id"=>$felhasznalo2["id"], "moderator"=>$felhasznalo2["moderator"]); // itt megítjuk a session-t, hogy milyen adatokat adjon vissza
            //létrehozok egy sessiont, aminek változója a "user" és a session user változójába berakok egy tömböt, mely tömb a felhasznalo2 változóba tárolt bejelentkezési adatokat adja vissza. 

            setcookie("id", $felhasznalo2["id"],time()+60*3); // az első paraméter a cokkie neve - ez az "id", a 2. paraméter, mi az érték, amit el akarunk térolni a cokkie-ban, 3., hogy mikor jár le. 4. site-nak melyik részére érvényes a cookie


            //$msg = "Sikeres bejelentkezés ".$felhasznalo2["valodi_nev"];
            header("location:padlasMainPage.php"); // itt átirányítom a bejelentkezett oldalra a felhasználót. a header utasítást csak akkor lehet használni,ha nincs semmilyen kiírás az oldalon a header utasítás előtt, tehát a html5-ös törzs elé kell rakni., 


        }
        catch(PDOException $e)
        {
            $type="Adatbázis lekérdezési hiba!";
            $msg="Sikertelen lekérdezés: ".$e->getMessage();
            //$apperror = new AppError();
            $apperror->showModal($msg, $type);
            $apperror->PutLog($msg);
        }
    }

    // ÚJ FELHASZNÁLÓ MENTÉSE ADATBÁZISBA
    public function newUserRegistration($felhasznalonev, $email, $jelszo, $jelszo2){
        
        $config = new Config("config/config.json"); 
        $dbconn = new Database($config);
        //$user = new User($dbconn->getConnection());
        try{            
            $felhasznalonev = trim($_POST["username"]);
            $jelszo = trim($_POST["password"]);
            $jelszo2 = trim($_POST["password2"]);
            $email = trim($_POST["email"]);            
            if(empty($felhasznalonev) || empty($jelszo) || empty($jelszo2) || empty($email))
            {                
                    
                $type="Regisztrációs hiba!";
                $msg="Minden adatot kötelező megadni!";
                $apperror = new AppError();
                $apperror->showModal($msg, $type);
                $apperror->PutLog($msg);
                
            }
                        
            if( $jelszo != $jelszo2)
            {                                
                $type="Regisztrációs hiba!";
                $msg="Hibás jelszó! Kérem, adja meg újra a jelszavát!";
                //$apperror = new AppError();
                $apperror->showModal($msg, $type);
                $apperror->PutLog($msg);
            }
            
            $hash = password_hash($jelszo,PASSWORD_DEFAULT);//Ezzel lehet titkosítani a jelszót. 
            
            $sqlReg = "INSERT INTO felhasznalok (username,jelszo,email) VALUES (:username,:jelszo,:email)";
            $queryReg = $this->dbconn->prepare($sqlReg);           
            
            $queryReg->execute(array("username"=>$felhasznalonev,"jelszo"=>$jelszo,"email"=>$email));           
            
            header("location:index.php");
            
            
        }
        catch(PDOException $e)
        {            
            $type="Adatbázis mentési hiba!";
            $msg="Sikertelen mentés! ".$e->getMessage();
            $apperror = new AppError();
            $apperror->showModal($msg, $type);
            $apperror->PutLog($msg);
            return false;
        }
        return true;
    }
}


?>
 