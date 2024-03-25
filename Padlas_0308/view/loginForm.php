<!--A bejelentkezés formnak az adatait tartalmazza. Az itt bekért adatokat le kell ellenőrizni és validálni kell a controllerben a validateLogin.php-ban.-->
<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto text-center">
            <div class="logo">
                <img src="img/Padlas_logo.png.png" alt="Padlás" width="400px" height="400px">
            </div>
        </div>
    </div>
    <div class="container-login">
        <form action="<?php echo $_SERVER["PHP_SELF"]?>" method="POST">
            <!--10. bejelentkezési űrlapkészítés--> 
            <fieldset>
            <legend class="text-center">Bejelentkezés</legend> 
                <input class="input" type="text" name="username" id="username" placeholder="Felhasználónév">
                <input class="input" type="password" name="password" id="password" placeholder="Jelszó">  
                <div class = "text-center">
    
                    <input class="btn btn-secondary" type="submit" value="Bejelentkezés" name="submitLogin">
                    
                </div>
                <div class="text-center">
                    <span> Még nincs fiókod?</span>
                    <a href="registration.php"> Regisztrálj! </a> <!--Ha rákattint a regisztrációra, akkor átvisz a regisztrációs oldalra.-->
                </div>
            </fieldset>
        </form>
    </div>
</div>