<script>
    var logueado = sessionStorage.getItem('Logueado');
    console.log(logueado)
    if (logueado == "false" || logueado==null) {
        window.location.replace("../../index.php");
    }
</script>
<html>
    <head>
        <!--bootstrap-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        <link rel="stylesheet" href="../../css/index.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
    </head>
    <body>    
    
        <?php include('../navbar/navbar.php');?>
        <?php include('../CRUD/pais_crud.php');?>
        <div class="container">
            <form class="text-white" id="FORM" style="margin-top:50px;background-color:rgba(0,0,0,0.4);padding:20px;border-radius:8px">
            <div class="form-row">
                <div class="form-group col-md-4">
                <h3><label for="ID">ID_Pais</label></h3>
                <input type="text" class="form-control btn-dark text-white" id="ID" placeholder="ID" disabled>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                <h3><label for="NOMBRE_PAIS">Nombre pais</label></h3>
                <input type="text" class="form-control bg-dark text-white" id="NOMBRE_PAIS">
                </div>
                <div class="form-group col-md-4">
                <h3><label for="POBLACION">Poblacion</label></h3>
                <input type="number" class="form-control bg-dark text-white" id="POBLACION">
                </div>
                <div class="form-group col-md-4">
                <h3><label for="AREA">Area</label></h3>
                <input type="number" class="form-control bg-dark text-white" id="AREA">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-1"></div>
                <div class="form-group col-md-4">
                    <h3><label for="CAPITAL_PAIS">Capital</label></h3>
                    <input type="text" class="form-control bg-dark text-white" id="CAPITAL_PAIS">
                </div>
                <div class="form-group col-md-2"></div>
                <div class="form-group col-md-4">
                    <h3><label for="REGION">Region</label></h3>
                    <select id="REGION" class="form-control bg-dark text-white" data-style="btn-dark" data-size="8">
                        
                    </select>
                </div>
                <div class="form-group col-md-1"></div>
                
            </div>
            
            <button type="button" class="btn btn-dark text-white" onclick="Create()">Crear <i class="bi bi-plus-circle"></i></button>
            <button type="button" class="btn btn-dark text-white" onclick="Update()">Actualizar <i class="bi bi-arrow-repeat"></i></button>
            </form>

            <table class="table" style="border: 2px solid black">
                <thead class="thead-dark" id="HEADER_TABLE">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre Pais</th>
                        <th scope="col">Poblacion</th>
                        <th scope="col">Area</th>
                        <th scope="col">Capital</th>
                        <th scope="col">Region</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody id="BODY_TABLE">
                    
                </tbody>
            </table>
        </div>
        
        <!--Bootstrap-->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    </body>
</html>

<script>
    function Llenar_Region(){
        <?php Get_regiones(); ?>
        let val = <?= json_encode($resultglob, JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS) ?>;
        let select = document.getElementById("REGION");
        //<option selected>Seleccionar Region</option>
        let TextoSelect = `<option value=null selected>Seleccionar Region</option>\n`

        for(let obj of val){
            TextoSelect += `<option value='${obj['id_region']}'>${obj['nombre_region']}</option>\n`
        }
        select.innerHTML = "";
        select.innerHTML = TextoSelect;
    }

    function Llenar_Tabla(){
        console.log("LLENAR TABLA");
        <?php GetAllPaises(); ?>
        let val = <?= json_encode($resultglob, JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS) ?>;
       let body_table = "";
       for(const reg of val){
            body_table += `<tr class="bg-light">\n`;
            body_table += `<th>${reg['id_pais']}</th>\n`;
            body_table += `<th>${reg['nombre_pais']}</th>\n`;
            body_table += `<th>${reg['poblacion']}</th>\n`;
            body_table += `<th>${reg['area']}</th>\n`;
            body_table += `<th>${reg['capital_pais']}</th>\n`;
            body_table += `<th>${reg['nombre_region']}</th>\n`;
            body_table += `<th><i class="bi bi-trash" onclick="deletePais(${reg['id_pais']})"></i> <i class="bi bi-eye" onclick="VerPais(${reg['id_pais']},'${reg['nombre_pais']}',${reg['poblacion']},${reg['area']},'${reg['capital_pais']}',${reg['region_id']},'${reg['nombre_region']}')"></i></th>\n`;
            body_table += `</tr>\n`;
       }
       let table = document.getElementById("BODY_TABLE");
       table.innerHTML="";
       table.innerHTML=body_table;
       console.log("LLENAR TABLA fin");
    }

    function VerPais(r1,r2,r3,r4,r5,r6,r7){
        document.getElementById('ID').value =r1;
        document.getElementById('NOMBRE_PAIS').value =r2;
        document.getElementById('POBLACION').value =r3;
        document.getElementById('AREA').value =r4;
        document.getElementById('CAPITAL_PAIS').value =r5;
        document.getElementById('REGION').value =r6;
        var elmnt = document.getElementById("FORM");
        elmnt.scrollIntoView();
    }

    function deletePais(id){
        $.ajax(
                {
                    url: `../CRUD/pais_crud.php?ID_PAIS=${id}`,
                    async: true,
                    success: function (data) {
                        window.location.reload()
                    }
                }
            );
            
    }

    function Update(){
        let id=document.getElementById('ID').value;
        let nombre=document.getElementById('NOMBRE_PAIS').value;
        let poblacion=document.getElementById('POBLACION').value;
        let area=document.getElementById('AREA').value;
        let capital=document.getElementById('CAPITAL_PAIS').value;
        let region=document.getElementById('REGION').value;
        $.ajax(
                {
                    url: `../CRUD/pais_crud.php?UPDAT=${id}&nom=${nombre}&pob=${poblacion}&are=${area}&cap=${capital}&reg=${region}`,
                    async: true,
                    success: function (data) {
                        console.log(data);
                        window.location.reload()
                    }
                }
            );
    }

    function Create(){
        let nombre=document.getElementById('NOMBRE_PAIS').value;
        let poblacion=document.getElementById('POBLACION').value;
        let area=document.getElementById('AREA').value;
        let capital=document.getElementById('CAPITAL_PAIS').value;
        let region=document.getElementById('REGION').value;
        $.ajax(
                {
                    url: `../CRUD/pais_crud.php?CREAT='si'&nom=${nombre}&pob=${poblacion}&are=${area}&cap=${capital}&reg=${region}`,
                    async: true,
                    success: function (data) {
                        console.log(data);
                        window.location.reload()
                    }
                }
            );
    }

    Llenar_Region()
    Llenar_Tabla()
</script>