<?php 
    include 'querys.php';
?>
<div class="row justify-content-md-center" style="margin-top:25px;">
  <div class="col-sm-8">
    <div class="form-group">
        <select class="selectpicker show-tick form-control" id="REPORTES" data-size="8" onchange="Select_Report()">
            <option selected disabled>Consultas</option>
            <option value="1">CONSULTA 1</option>
            <option value="2">CONSULTA 2</option>
            <option value="3">CONSULTA 3</option>
            <option value="4">CONSULTA 4</option>
            <option value="5">CONSULTA 5</option>
            <option value="6">CONSULTA 6</option>
            <option value="7">CONSULTA 7</option>
            <option value="8">CONSULTA 8</option>
            <option value="9">CONSULTA 9</option>
            <option value="10">CONSULTA 10</option>
            <option value="11">CONSULTA 11</option>
            <option value="12">CONSULTA 12</option>
            <option value="13">CONSULTA 13</option>
            <option value="14">CONSULTA 14</option>
            <option value="15">CONSULTA 15</option>
            <option value="16">CONSULTA 16</option>
            <option value="17">CONSULTA 17</option>
            <option value="18">CONSULTA 18</option>
            <option value="19">CONSULTA 19</option>
            <option value="20">CONSULTA 20</option>
        </select>
    </div>
    <div class="container">
        <div class="table-responsive-sm">
            <table class="table" style="border: 2px solid black">
                <thead class="thead-dark" id="HEADER_TABLE">
                </thead>
                <tbody id="BODY_TABLE">
                </tbody>
            </table>
        </div>
    </div>
  </div>
</div>
<script>
    
    function Select_Report() {
        var x = document.getElementById("REPORTES").value;
        console.log(x);
        switch (x) {
            case '1':{con1();break;}
            case '2':{con2();break;}
            case '3':{con3();break;}
            case '4':{con4();break;}
            case '5':{con5();break;}
            case '6':{con6();break;}
            case '7':{con7();break;}
            case '8':{con8();break;}
            case '9':{con9();break;}
            case '10':{con10();break;}
            case '11':{con11();break;}
            case '12':{con12();break;}
            case '13':{con13();break;}
            case '14':{con14();break;}
            case '15':{con15();break;}
            case '16':{con16();break;}
            case '17':{con17();break;}
            case '18':{con18();break;}
            case '19':{con19();break;}
            case '20':{con20();break;}
            default :{console.log("NADA");break;}
        }
    }

    function Llenar_Table(Arreglo){
        var header = document.getElementById("HEADER_TABLE");
        var body = document.getElementById("BODY_TABLE");
        header.innerHTML = "";
        body.innerHTML = "";
        header_new = `<tr>
                        <th scope="col">No.</th>`;
        body_new = "";
        for (var key in Arreglo[0]) {
                header_new += `<th scope="col">${key}</th>\n`;
        }
        header_new += '</tr>';
        for (const index in Arreglo) {
            body_new += `<tr class="bg-light">\n`;
            body_new +=`<th scope="row">${index}</th>\n`
            for (var key in Arreglo[index]) {
                body_new += `<th scope="row">${Arreglo[index][key]}</th>\n`
            }
            body_new += `</tr>\n`;
        }
        
        header.innerHTML = header_new;
        body.innerHTML = body_new;
    }

    function con1(){
        <?php echo query1();?>
        let val = <?= json_encode($resultglob, JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS) ?>;
        Llenar_Table(val);
    }
    function con2(){
        <?php echo query2();?>
        let val = <?= json_encode($resultglob, JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS) ?>;
        Llenar_Table(val);
    }
    function con3(){
        <?php echo query3();?>
        let val = <?= json_encode($resultglob, JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS) ?>;
        Llenar_Table(val);
    }
    function con4(){
        <?php echo query4();?>
        let val = <?= json_encode($resultglob, JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS) ?>;
        Llenar_Table(val);
    }
    function con5(){
        <?php echo query5();?>
        let val = <?= json_encode($resultglob, JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS) ?>;
        Llenar_Table(val);
    }
    function con6(){
        <?php echo query6();?>
        let val = <?= json_encode($resultglob, JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS) ?>;
        Llenar_Table(val);
    }
    function con7(){
        <?php echo query7();?>
        let val = <?= json_encode($resultglob, JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS) ?>;
        Llenar_Table(val);
    }
    function con8(){
        <?php echo query8();?>
        let val = <?= json_encode($resultglob, JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS) ?>;
        Llenar_Table(val);
    }
    function con9(){
        <?php echo query9();?>
        let val = <?= json_encode($resultglob, JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS) ?>;
        Llenar_Table(val);
    }
    function con10(){
        <?php echo query10();?>
        let val = <?= json_encode($resultglob, JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS) ?>;
        Llenar_Table(val);
    }
    function con11(){
        <?php echo query11();?>
        let val = <?= json_encode($resultglob, JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS) ?>;
        Llenar_Table(val);
    }
    function con12(){
        <?php echo query12();?>
        let val = <?= json_encode($resultglob, JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS) ?>;
        Llenar_Table(val);
    }
    function con13(){
        <?php echo query13();?>
        let val = <?= json_encode($resultglob, JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS) ?>;
        Llenar_Table(val);
    }
    function con14(){
        <?php echo query14();?>
        let val = <?= json_encode($resultglob, JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS) ?>;
        Llenar_Table(val);
    }
    function con15(){
        <?php echo query15();?>
        let val = <?= json_encode($resultglob, JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS) ?>;
        Llenar_Table(val);
    }
    function con16(){
        <?php echo query16();?>
        let val = <?= json_encode($resultglob, JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS) ?>;
        Llenar_Table(val);
    }
    function con17(){
        <?php echo query17();?>
        let val = <?= json_encode($resultglob, JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS) ?>;
        Llenar_Table(val);
    }
    function con18(){
        <?php echo query18();?>
        let val = <?= json_encode($resultglob, JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS) ?>;
        Llenar_Table(val);
    }
    function con19(){
        <?php echo query19();?>
        let val = <?= json_encode($resultglob, JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS) ?>;
        Llenar_Table(val);
    }
    function con20(){
        <?php echo query20();?>
        let val = <?= json_encode($resultglob, JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS) ?>;
        Llenar_Table(val);
    }
</script>

