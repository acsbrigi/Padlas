<form id="searchProductForm" class = "container text-center searchform" action="<?php echo $_SERVER["PHP_SELF"]?>" method="POST">
    <fieldset>
        <legend><h3>Termékkereső</h3></legend>
        <p style="font-weight: bold;">Kérlek, add meg a keresett termék(ek) adatait!</p>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <label for="nem">Nem:</label>
                <select class=" .form-select form-control" id="nemValaszt" name="nem">
                <option value="fiu">Fiú</option>
                <option value="lany">Lány</option>
                </select>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <label for="kategoria">Kategória:</label>
                <select class=" .form-select form-control" id="kategoriaValaszt" name="kategoria">
                <option value="ruha">Ruha</option>
                <option value="cipo">Cipő</option>
                </select>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <label for="tipus">Típus:</label>
                <select class=" .form-select form-control" id="tipusValaszt" name="tipus">
                <!-- Dinamikusan jelennek meg itt az adatok aszerint, hogy mit választtt kategóriának. -->
                </select>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <label for= meret>Méret:</label>
                <select class=" .form-select form-control" id="meretValaszt" name="meret">
                <!-- Itt is dinamikusan jelennek meg az adatok -->
                </select>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <label for=tarolo>Tároló:</label>
                <select class=" .form-select form-control" id="taroloValaszt" name="tarolo">
                <!-- IDE KELL MEGHÍVNI AZT A PHP KÓDOT,AMI AZ ADATBÁZISBÓL LEKÉRDEZI AZ ÖSSZES MEGLÉVŐ TÁROLÓT ÉS BELEKARKJA ŐKET EGY-EGY 
                OPTION-BE -->
                </select>
            </div>
        </div>
        <input class="btn btn-secondary text-center" type="submit" value="Keresés">
    </fieldset>
</form>
        


<script>
    const tipusValaszt = document.getElementById('tipusValaszt');
    const meretValaszt = document.getElementById('meretValaszt');
    const nemValaszt = document.getElementById('nemValaszt');
    const kategoriaValaszt = document.getElementById('kategoriaValaszt');

    kategoriaValaszt.addEventListener('change', Frissit);
    nemValaszt.addEventListener('change', Frissit);

    function Frissit() {
    const kategoria = kategoriaValaszt.value;
    const nem = nemValaszt.value;
    tipusValaszt.innerHTML = ''; // Törli a korábbi keresési beállítást
    meretValaszt.innerHTML = ''; // Törli a méret mezőből a korábbi keresési beállítást. 

    if (kategoria === 'ruha') {
        if (nem === 'fiu') {
        tipusValaszt.innerHTML = `
            <option value="3">Felső</option>
            <option value="4">Alsó</option>
            <option value="5">Egybe ruha</option>
            <option value="6">Kiegészítő</option>
            <option value="7">Fehérnemű</option>
        `;
        meretValaszt.innerHTML = `
            <option value="1">XS</option>
            <option value="2">S</option>
            <option value="3">M</option>
            <option value="4">L</option>
            <option value="5">XL</option>
            <option value="6">XXL</option>
        `;
        } else if (nem === 'lany') {
        tipusValaszt.innerHTML = `
            <option value="3">Felső</option>
            <option value="4">Alsó</option>
            <option value="5">Egybe ruha</option>
            <option value="6">Kiegészítő</option>
            <option value="7">Fehérnemű</option>
        `;
        meretValaszt.innerHTML = `
            <option value="1">XS</option>
            <option value="2">S</option>
            <option value="3">M</option>
            <option value="4">L</option>
            <option value="5">XL</option>
            <option value="6">XXL</option>
        `;
        }
    } else if (kategoria === 'cipo') {
        if (nem === 'fiu') {
        tipusValaszt.innerHTML = `
            <option value="8">Szabadidőcipő</option>
            <option value="9">Sportcipő</option>
            <option value="10">Bakancs</option>
            <option value="11">Papucs</option>
            <option value="12">Szandál</option>
            <option value="13">Körömcipő</option>
        `;
        meretValaszt.innerHTML = `
            <option value="11">39</option>
            <option value="12">40</option>
            <option value="13">41</option>
            <option value="14">42</option>
            <option value="15">43</option>
            <option value="16">44</option>
            <option value="17">45</option>
            <option value="18">46</option>
            <option value="19">47</option>
        `;
        } else if (nem === 'lany') {
        tipusValaszt.innerHTML = `
            <option value="8">Szabadidőcipő</option>
            <option value="9">Sportcipő</option>
            <option value="10">Bakancs</option>
            <option value="11">Papucs</option>
            <option value="12">Szandál</option>
            <option value="13">Körömcipő</option>
        `;
        meretValaszt.innerHTML = `
            <option value="7">35</option>
            <option value="8">36</option>
            <option value="9">37</option>
            <option value="10">38</option>
            <option value="11">39</option>
            <option value="12">40</option>
            <option value="13">41</option>
            <option value="14">42</option>
        `;
        }
    }
    }

    // A függvény, aminek hatására megváltoznak a kiválasztás opciói
    Frissit();
</script>


