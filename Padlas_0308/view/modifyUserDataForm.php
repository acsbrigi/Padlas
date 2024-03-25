<div class="container">
    <div class="container-login">
        <form action="<?php echo $_SERVER["PHP_SELF"]?>" method="POST">
            <!--10. bejelentkezési űrlapkészítés--> 
            <fieldset>
            <legend class="text-center">Felhasználói adatok<span><input class="btn btn-secondary text-center" type="submit" value="Felhasználói adatok törlése" name="submitDeleteUser"></span></legend>
                <input class="input" type="text" name="username" id="username" placeholder="Felhasználónév">
                <input  class="input" type="text" name="email" id="email" placeholder="Email cím">
                <input class="input" type="password" name="password_old" id="password_old" placeholder="Régi jelszó">
                <input class="input" type="password" name="password" id="password" placeholder="Új jelszó">
                <input  class="input" type="password" name="password2" id="password2" placeholder="Új jelszó megerősítése"> 
                <div class = "text-center">
    
                    <input class="btn btn-secondary text-center" type="submit" value="Módosítás mentése" name="submitModifyUser">
                    
                </div>
            </fieldset>
        </form>
    </div>
</div>




















<!--Ide kell megírni a felhasználó oldalon (profil.php) található, a felhasználói adatok módosításához szükséges form-ot.-->
<!--<form action="<?php //echo $_SERVER["PHP_SELF"]?>" method="post"> 
    <fieldset>
    <legend id="legendmodifyuserdata" class="text-center p-t-115">Felhasználói adatok</legend>
        <div class="mb-3">
            <div class="mb-3 text-center">
                <label for="username">Felhasználó név</label>
                <input type="text" name="username" id="username" placeholder="Felhasználónév">
            </div>
            <div class="mb-3 text-center">
                <label for="email">Email cím</label>
                <input type="text" name="email" id="email" placeholder="Email cím">
            </div>
            <div class="mb-3 text-center">
                <label for="password">Jelszó</label>
                <input type="password" name="password" id="password" placeholder="Jelszó">
            </div>
            <div class="mb-3 text-center">
                <label for="jelszomegerosites">Jelszó megerősítése</label>
                <input type="password" name="password2" id="password2" placeholder="Jelszó megerősítése">
            </div>
        </div>
        <div class="mb-3 text-center">
                <input  class="text-center" type="submit" value="Regisztráció" name="submitRegistration">
        </div>
        <div class="text-center p-t-115">
            <a class="txt2" href="../Padlas_0308/index.php"> Vissza a bejelentkezés oldalra! </a> Ha rákattint a regisztrációra, akkor átvisz a regisztrációs oldalra.
        </div>
    </fieldset>
    </form>
    <div style="text-align: center;
        <img src="img/padlas_logo_150x150_nobg_fukszia.png" alt="Padlás logó" width="200" height="200">
    </div>-->