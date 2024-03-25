<!--A kilistázott tárolókat itt jelenítjük meg.-->
</div id="storage" class= "container-fluid">
        <h2 class="text-center">A Padás alkalmazában meglévő tárolók listája</h2>
        <p id="valasz"></p>
        <div class="d-flex justify-content-between px-3 py-2">
        <button id="ujtaroloLletrehoz"class="btn btn-primary" onclick="createNewStorage()">Új tároló létrehozása</button>
    </div>
    <div id="storageList" class="p-3">
        <!-- TÁROLÓK táblázata -->
        <table class="table table-bordered table-hover table-responsive">
            <thead>
                <tr>
                    <th>Tároló neve</th>
                    <th>Tárolóban lévő termékek darabszáma</th>
                    <th>Termékek kivétele a tárolóból</th>
                    <th>Tároló törlése</th>
                </tr>
            </thead>
            <tbody id = "storagetable">
                <!-- Tárolók: -->
                <?php foreach($storageArray as $singleStorage){
                ?>

                
                    <tr id = "<?= $singleStorage["id"]?>">
                        <td><span><?= $singleStorage["taroloNev"]?></span></td>
                        <td><span class=""><?= $singleStorage["keszlet"]?></span></td>
                        <td><a href ="#"onclick="removeItemFromStorage(<?= $singleStorage["id"]?>)" class="kivetel"><i class="fa fa-arrow-right"></i></a></td>
                        <td><a href="#" onclick="deleteStorage(<?= $singleStorage["id"]?>)" class="torles"><i class="fa fa-trash"></i></a></td>
                    </tr>
                <?php
                }
                ?>

            </tbody>
        </table>
    </div>
</div>

<!--A GOMBRA KATTINTÁS UTÁN EZ A FÜGGYVÉNY HÍVÓDIK MEG: createNewStorage
Ez pedig egy AJAX kérést küld a szervernek,amely kérés egy PHP oldalt (a model mappában lévő storage.php) hív meg, amely kezeli az adatbázisba történő új rekord beszúrását.-->
<script>

    // I. ÚJ TÁROLÓ LÉTREHOZÁSA

    function createNewStorage() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4) {
            if (this.status == 200) {
                const tr = document.createElement('tr');
                tr.innerHTML = 
                        '<td><span>'+this.responseText+'</span></td>'+
                        '<td><span class="">0</span></td>'+
                        '<td><a href ="#"onlick="removeItemFromStorage('+this.responseText+')" class="kivetel"><i class="fa fa-arrow-right"></i></a></td>'+
                        '<td><a href ="#" onlick="deleteStorage('+this.responseText+')"class="torles"><i class="fa fa-trash"></i></a></td>';
                    document.getElementById('storagetable').appendChild(tr);
                console.log(this.responseText);
            } else {
                console.error("Hiba a kérés során");
            }
        }
    };
    xhttp.open("GET", "model/createStorage.php", true);
    xhttp.send();
}

//II. TERMÉKEK TÖRLÉSE TÁROLÓBÓL - Itt kellene, hogy egyből frissüljön, hogy hány db termék vn az adott tárolóban. 


function removeItemFromStorage(id){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4) {
            if (this.status == 200) {
                console.log("Sikeres AJAX kérés");
                console.log(this.responseText);
                
            } else {
                console.error("Hiba a kérés során");
            }
        }
    };
    xhttp.open("GET", "model/removeItemFromStorage.php?id=" +id, true);
    xhttp.send();
}

//TÁROLÓ TÖRLÉSE: VALAMIÉRT CSAK EGY KATTINTÁS EREJÉIG TÖRLŐDIK A SOR, HA KATTINTOK MÉG EGYET, AKKOR UTÁNA MÁR NEM. MI LEHET A BAJ? 

function deleteStorage(id){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4) {
            if (this.status == 200) {
                console.log("Sikeres AJAX kérés");
                console.log(this.responseText);
                //  töröljük az adott sort a táblázatból, DE JELENLEG CSAK EGY KATTINTÁS EREJÉIG TÖRLI
                var row = document.getElementById(<?= $singleStorage["id"]?>);
                row.parentNode.removeChild(row);
            } else {
                console.error("Hiba a kérés során");
            }
        }
    };
    xhttp.open("GET", "model/deleteStorage.php?id=" + id, true);
    xhttp.send();
}

</script>
