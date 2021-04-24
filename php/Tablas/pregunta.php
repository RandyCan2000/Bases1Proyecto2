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
                <h3><label for="ID">ID_Pregunta</label></h3>
                <input type="text" class="form-control btn-dark text-white" id="ID" placeholder="ID" disabled>
                </div>
                <div class="form-group col-md-4"></div>
                <div class="form-group col-md-4">
                    <h3><label for="ENCUESTA">Encuesta</label></h3>
                    <select id="ENCUESTA" class="selectpicker show-tick form-control" data-style="btn-dark">
                    </select>
                </div>
                
            </div>
            <div class="form-row">
                <div class="form-group col-md-1"></div>
                <div class="form-group col-md-4">
                    <h3><label for="PREGUNTA">Pregunta</label></h3>
                    <input type="text" class="form-control bg-dark text-white" id="PREGUNTA">
                </div>
                <div class="form-group col-md-2"></div>
                <div class="form-group col-md-4">
                    <h3><label for="RESPUESTAS">Respuestas</label></h3>
                    <input type="text" list="RESP" id="RESPUESTAS" class="form-control bg-dark text-white">
                    <datalist id="RESP">
                        
                    </datalist>
                </div>
                <div class="form-group col-md-1"></div>
            </div>
            <div class="form-row">
                
                <div class="form-group col-md-4"></div>
                <div class="form-group col-md-4">
                    <h3><label for="RESPUESTAS_CORRECTA">Respuesta Correcta</label></h3>
                    <select id="RESPUESTAS_CORRECTA" class="form-control bg-dark" data-style="btn-dark" data-size="8">
                    </select>
                </div>
                <div class="form-group col-md-4"></div>
            </div>
            <button type="button" class="btn btn-dark text-white" onclick="Crear()">Crear <i class="bi bi-plus-circle"></i></button>
            <button type="button" class="btn btn-dark text-white" onclick="Update()">Actualizar <i class="bi bi-arrow-repeat"></i></button>
            </form>

            <table class="table" style="border: 2px solid black">
                <thead class="thead-dark" id="HEADER_TABLE">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Pregunta</th>
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
    var Listado_respuestas = []
    var RESPUESTAS = document.getElementById("RESPUESTAS");
    if(RESPUESTAS){
        RESPUESTAS.addEventListener("keyup", function(event) {
            if (event.keyCode === 13) {
                Actualizar_select();
            }   
        });
        RESPUESTAS.addEventListener("keyup", function(event) {
            if(event.key == "Delete" && event.ctrlKey==true){
                DropValue()
            }
        }); 
    }

    function Actualizar_select(){
        var RESPUESTAS = document.getElementById("RESPUESTAS");
        let list = document.getElementById('RESP');
        let RESP_COR = document.getElementById('RESPUESTAS_CORRECTA');
        let htmlText = "";
        Listado_respuestas.push(RESPUESTAS.value.trim());
        RESPUESTAS.value = "";
        for(let respuesta of Listado_respuestas){
            htmlText += `<option value="${respuesta}">${respuesta}</option>\n`
        }
        list.innerHTML = "";
        RESP_COR.innerHTML = "";
        list.innerHTML = htmlText;
        RESP_COR.innerHTML = htmlText;
    }

    function Crear(){
        const Pregunta = document.getElementById("PREGUNTA").value;
        const Encuesta = document.getElementById("ENCUESTA").value;
        const Listado = Listado_respuestas;
        const Resp_Corr = document.getElementById("RESPUESTAS_CORRECTA").value;
        $.ajax({
            url: `../CRUD/pregunta_crud.php?CREATE_PREG=true&pre=${Pregunta}&enc=${Encuesta}`,
            async: true,
            success: function (data) {
                $.ajax({
                    url: `../CRUD/pregunta_crud.php?LAST_CREATE=true`,
                    async: true,
                    success: function (data) {
                        const id_pg = JSON.parse(data)[0].id_pregunta;
                        console.log(id_pg);
                        for (const iterator of Listado) {
                            $.ajax({
                                url: `../CRUD/pregunta_crud.php?CREATE_RESP=true&res=${iterator}&let=${iterator.substring(0, 1).toUpperCase()}&idp=${id_pg}`,
                                async: true,
                                success: function (data) {
                                    console.log(data);
                                    console.log(iterator);
                                    if(iterator == Listado[Listado.length-1]){
                                        const resp_cor = document.getElementById("RESPUESTAS_CORRECTA").value
                                        $.ajax({
                                            url: `../CRUD/pregunta_crud.php?GET_RESP_COR=true&res=${resp_cor}&let=${resp_cor.substring(0, 1).toUpperCase()}&idp=${id_pg}`,
                                            async: true,
                                            success: function (data) {
                                                //agregar Relacion entre pregunta y respuesta correcta
                                                const idr = JSON.parse(data)[0].id_respuesta;
                                                $.ajax({
                                                    url: `../CRUD/pregunta_crud.php?CREATE_RESP_COR=true&idp=${id_pg}&idr=${idr}`,
                                                    async: true,
                                                    success: function (data) {
                                                        window.location.reload()
                                                    }
                                                });
                                            }
                                        });
                                    }
                                }
                            });
                        }
                        
                    }
                });
            }
        });
    }

    function Get_Preguntas(){
        $.ajax({
            url: `../CRUD/pregunta_crud.php?GET_PREGUNTAS=true`,
            async: true,
            success: function (data) {
                const Preguntas = JSON.parse(data);
                let body_table = document.getElementById("BODY_TABLE");
                let body_html = ""
                for(let obj of Preguntas){
                    body_html +=`<tr class="bg-light">\n`
                    body_html +=`<th>${obj.id_pregunta}</th>\n`
                    body_html +=`<th>${obj.pregunta}</th>\n`
                    body_html += `<th><i class="bi bi-trash" onclick="DeletePregunta(${obj.id_pregunta})"></i> <i class="bi bi-eye" onclick="viewPregunta(${obj.id_pregunta},'${obj.pregunta}',${obj.encuesta_id})"></i></th>`
                    body_html +=`</tr>\n`
                }
                body_table.innerHTML = body_html;
            }
        });
    }

    function DropValue(){
        var RESPUESTAS = document.getElementById("RESPUESTAS");
        const index = Listado_respuestas.indexOf(RESPUESTAS.value);
        let RESP_COR = document.getElementById('RESPUESTAS_CORRECTA');
        let list = document.getElementById('RESP');
        if (index > -1) {
            Listado_respuestas.splice(index, 1);
        }
        htmlText = "";
        for(let respuesta of Listado_respuestas){
            htmlText += `<option value="${respuesta}">${respuesta}</option>\n`
        }
        list.innerHTML = "";
        RESP_COR.innerHTML = "";
        list.innerHTML = htmlText;
        RESP_COR.innerHTML = htmlText;
        RESPUESTAS.value="";
    }

    function DeletePregunta(id){
        $.ajax({
            url: `../CRUD/pregunta_crud.php?DEL_PREG=true&idp=${id}`,
            async: true,
            success: function (data) {
                console.log(data);
                window.location.reload()
            }
        });
    }

    function viewPregunta(id,pregunta,id_enc){
        document.getElementById("ID").value = id;
        document.getElementById("PREGUNTA").value = pregunta;
        document.getElementById("ENCUESTA").value = id_enc;
        $.ajax({
            url: `../CRUD/pregunta_crud.php?GET_RESPUESTAS=true&idp=${id}`,
            async: true,
            success: function (data) {
                const respuestas = JSON.parse(data);
                let resp = document.getElementById("RESP");
                let body_html = ""
                for(let obj of respuestas){
                    body_html +=`<option value=${obj.id_respuesta}>${obj.respuesta}</option>\n`
                }
                resp.innerHTML = body_html;
                document.getElementById("RESPUESTAS_CORRECTA").innerHTML = body_html;
            }
        });
        $.ajax({
            url: `../CRUD/pregunta_crud.php?GET_RESPUESTA_CORRECTA=true&idp=${id}`,
            async: true,
            success: function (data) {
                const respuesta = JSON.parse(data);
                document.getElementById("RESPUESTAS_CORRECTA").value = respuesta[0].respuesta_id;
                var elmnt = document.getElementById("FORM");
                elmnt.scrollIntoView();
            }
        });
    }
    
    function Update(){
        const id = document.getElementById("ID").value;
        const pregunta = document.getElementById("PREGUNTA").value;
        const id_enc = document.getElementById("ENCUESTA").value;
        const id_resp_cor = document.getElementById("RESPUESTAS_CORRECTA").value;
        $.ajax({
            url: `../CRUD/pregunta_crud.php?UPDATE_PREG=true&idp=${id}&ide=${id_enc}&pre=${pregunta}`,
            async: true,
            success: function (data) {
                console.log(data);
                $.ajax({
                    url: `../CRUD/pregunta_crud.php?UPDATE_RESP_COR=true&idp=${id}&idr=${id_resp_cor}`,
                    async: true,
                    success: function (data) {
                        console.log(data);
                        window.location.reload();
                    }
                });
            }
        });
        
    }

    function Init(){
        $.ajax({
            async: false,
            url: `../CRUD/pregunta_crud.php?GET_ENCUESTAS=true`,
            success: function (data) {
                const arr=JSON.parse(data);
                console.log(arr);
                let selecEnc = document.getElementById("ENCUESTA");
                let SelectHTML = ""
                for (let obj of arr) {
                    SelectHTML += `<option value=${obj.id_encuesta}>${obj.nombre_encuesta}</option>\n`
                }
                selecEnc.innerHTML = SelectHTML;
            }
        });
    }
    Get_Preguntas();
    Init();
</script>