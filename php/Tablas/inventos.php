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

        <div class="container">
            <form class="text-white" id="FORM" style="margin-top:50px;background-color:rgba(0,0,0,0.4);padding:20px;border-radius:8px">
            <div class="form-row">
                <div class="form-group col-md-1"></div>
                <div class="form-group col-md-4">
                    <h3><label for="INVENTOR">Inventores</label></h3>
                    <select id="INVENTOR" class="form-control  bg-dark text-white" data-style="btn-dark" data-size="8">
                    </select>
                </div>
                <div class="form-group col-md-2"></div>
                <div class="form-group col-md-4">
                    <h3><label for="ANIO">Año</label></h3>
                    <input type="number" id="ANIO" class="form-control bg-dark text-white">
                </div>
                <div class="form-group col-md-1"></div>
            </div>
            <div class="form-row">
                
                <div class="form-group col-md-4"></div>
                <div class="form-group col-md-4">
                <h3><label for="INVENTO">Invento</label></h3>
                    <input type="text" id="INVENTO" class="form-control bg-dark text-white">
                </div>
                <div class="form-group col-md-4"></div>
            </div>
            <button type="button" class="btn btn-dark text-white" onclick="Update()">Actualizar <i class="bi bi-arrow-repeat"></i></button>
            </form>

            <table class="table" style="border: 2px solid black">
                <thead class="thead-dark" id="HEADER_TABLE">
                    <tr>
                        <th scope="col">INVENTO</th>
                        <th scope="col">INVETOR</th>
                        <th scope="col">ANIO</th>
                        <th scope="col">OPCIONES</th>
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

    let Global = {id_inventor:0,id_invento:0,nombre_invento:0,anio_invento:0};

    function init(){
        $.ajax({
            url: `../CRUD/inventos_crud.php?GET_INVENTADO=true`,
            async: false,
            success: function (data) {
                const arr=JSON.parse(data);
                let BODY_TABLE = document.getElementById("BODY_TABLE");
                let SelectHTML = "";
                let SELCT_INV = document.getElementById("INVENTOR");
                let LlenarSelect = ""
                for (let obj of arr) {
                    SelectHTML += `<tr class="bg-light">\n`;
                    SelectHTML += `<th>${obj.nombre_invento}</th>\n`;
                    SelectHTML += `<th>${obj.nombre_inventor}</th>\n`;
                    SelectHTML += `<th>${obj.anio_invento}</th>\n`;
                    SelectHTML += `<th><i class="bi bi-eye" onclick='view("${obj.nombre_invento}","${obj.nombre_inventor}",${obj.anio_invento},${obj.id_inventor},${obj.id_invento})'></i></th>\n`;
                    SelectHTML += `</tr>\n`;
                    LlenarSelect += `<option value=${obj.id_inventor}>${obj.nombre_inventor}</option>`
                }
                BODY_TABLE.innerHTML = SelectHTML;
                SELCT_INV.innerHTML = LlenarSelect;
            }
        });
        $.ajax({
            url: `../CRUD/inventos_crud.php?GET_INVENTORES=true`,
            async: false,
            success: function (data) {
                const arr=JSON.parse(data);
                let SELCT_INV = document.getElementById("INVENTOR");
                let LlenarSelect = ""
                for (let obj of arr) {
                    LlenarSelect += `<option value=${obj.id_inventor}>${obj.nombre_inventor}</option>`
                }
                SELCT_INV.innerHTML = LlenarSelect;
            }
        });
    }
    init();

    function view(nom_Invento,nom_inventor,anio_invento,id_inventor,id_invento){
        Global.id_inventor=id_inventor
        Global.id_invento=id_invento
        Global.nombre_invento=nom_Invento
        Global.anio_invento=anio_invento
        document.getElementById("INVENTOR").value = id_inventor;
        document.getElementById("INVENTO").value =  nom_Invento;
        document.getElementById("ANIO").value = anio_invento;
        var elmnt = document.getElementById("FORM");
        elmnt.scrollIntoView();
    }

    function Update(){
        console.log(Global);
        let inventor_nuevo= document.getElementById("INVENTOR").value;
        Global.nombre_invento = document.getElementById("INVENTO").value;
        Global.anio_invento = document.getElementById("ANIO").value;
        $.ajax({
            url: `../CRUD/inventos_crud.php?UPDATE_INVENTO=true&inv=${Global.nombre_invento}&anio=${Global.anio_invento}&idi=${Global.id_invento}&idinnew=${inventor_nuevo}&idinOld=${Global.id_inventor}`,
            success: function (data) {
                console.log(data);
                window.location.reload()
            }
        });
    }
</script>