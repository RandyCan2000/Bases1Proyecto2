<?php
    include ("../database/connection.php");

    if(isset($_GET['CREATE_PREG'])){
        global $conn;
        $sql = "insert into pregunta values(null,'".$_GET['pre']."',".$_GET['enc'].")";
        $result = $conn->query($sql);
        echo json_encode($result); 
    }

    if(isset($_GET['LAST_CREATE'])){
        global $conn;
        $sql = "select id_pregunta from pregunta order by id_pregunta desc limit 1";
        $result = $conn->query($sql);
        $myArray = ArrayRet($result);
        echo json_encode($myArray); 
    }

    if(isset($_GET['CREATE_RESP'])){
        global $conn;
        $sql = "insert INTO respuesta VALUES(null,'".$_GET['res']."','".$_GET['let']."',".$_GET['idp'].")";
        $result = $conn->query($sql);
        echo json_encode($result); 
    }

    if(isset($_GET['GET_ENCUESTAS'])){
        global $conn;
        $sql = "select * from encuesta";
        $result = $conn->query($sql);
        $myArray = ArrayRet($result);
        echo json_encode($myArray);     
    }

    if(isset($_GET['GET_RESP_COR'])){
        global $conn;
        $sql = "select id_respuesta from respuesta where respuesta = '".$_GET['res']."' and letra = '".$_GET['let']."' and pregunta_id=".$_GET['idp']."";
        $result = $conn->query($sql);
        $myArray = ArrayRet($result);
        echo json_encode($myArray);     
    }

    if(isset($_GET['CREATE_RESP_COR'])){
        global $conn;
        $sql = "insert into respuesta_correcta values(".$_GET['idr'].",".$_GET['idp'].");";
        $result = $conn->query($sql);
        echo json_encode($result);     
    }

    if(isset($_GET['GET_PREGUNTAS'])){
        global $conn;
        $sql = "select * from pregunta";
        $result = $conn->query($sql);
        $myArray = ArrayRet($result);
        echo json_encode($myArray);     
    }

    if(isset($_GET['GET_RESPUESTAS'])){
        global $conn;
        $sql = "select * from respuesta where pregunta_id=".$_GET['idp'];
        $result = $conn->query($sql);
        $myArray = ArrayRet($result);
        echo json_encode($myArray);     
    }

    if(isset($_GET['GET_RESPUESTA_CORRECTA'])){
        global $conn;
        $sql = "select * from respuesta_correcta where pregunta_id =".$_GET['idp'];
        $result = $conn->query($sql);
        $myArray = ArrayRet($result);
        echo json_encode($myArray);     
    }

    if(isset($_GET['DEL_PREG'])){
        global $conn;
        $sql = "delete from pregunta where id_pregunta =".$_GET['idp'];
        $result = $conn->query($sql);
        echo json_encode($result);     
    }

    if(isset($_GET['UPDATE_PREG'])){
        global $conn;
        $sql = "update pregunta
        set pregunta = '".$_GET['pre']."', encuesta_id = ".$_GET['ide']." where id_pregunta =".$_GET['idp'];
        $result = $conn->query($sql);
        echo json_encode($result);   
    }
    //;

    if(isset($_GET['UPDATE_RESP_COR'])){
        global $conn;
        $sql = "select * from respuesta_correcta where pregunta_id = ".$_GET['idp'];
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            $sql = "update respuesta_correcta set respuesta_id = ".$_GET['idr']." where pregunta_id = ".$_GET['idp'];
            $result = $conn->query($sql);
            echo json_encode($result);
        }else{
            $sql = "insert INTO respuesta_correcta VALUES(".$_GET['idr'].",".$_GET['idp'].");";
            $result = $conn->query($sql);
            echo json_encode($result);
        }
        
    }

    function ArrayRet($resultado){
        $rawdata = [];
        $i = 0;
        while($row = $resultado->fetch_assoc()){
            $rawdata[$i] = $row;
            $i++;
        }
        return $rawdata;
    }
?>