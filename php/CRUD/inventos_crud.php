<?php
    include ("../database/connection.php");

    if(isset($_GET['GET_INVENTADO'])){
        global $conn;
        $sql = "select id_invento,nombre_invento,anio_invento,id_inventor,nombre_inventor from inventado i 
        inner join invento inv on i.invento_id = inv.id_invento
        inner join inventor inve on i.inventor_id = inve.id_inventor";
        $result = $conn->query($sql);
        $myArray = ArrayRet($result);
        echo json_encode($myArray);  
    }

    if(isset($_GET['UPDATE_INVENTO'])){
        global $conn;
        $sql = "update invento set nombre_invento = '".$_GET['inv']."', anio_invento = ".$_GET['anio']." where id_invento = ".$_GET['idi'];
        $result = $conn->query($sql);
        $sql = "update inventado set inventor_id = ".$_GET['idinnew']." where invento_id =".$_GET['idi']." and inventor_id =".$_GET['idinOld'];
        $result = $conn->query($sql);;
        echo json_encode($result);  
    }

    if(isset($_GET['GET_INVENTORES'])){
        global $conn;
        $sql = "select id_inventor,nombre_inventor from inventor order by nombre_inventor desc";
        $result = $conn->query($sql);
        $myArray = ArrayRet($result);
        echo json_encode($myArray);  
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