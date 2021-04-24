<?php
    include ("../database/connection.php");
    function Get_regiones(){
        global $conn;
        $sql = "select id_region,nombre_region from region";
        $result = $conn->query($sql);
        Llenar_Resultado($result);
        return;
    }

    function GetAllPaises(){
        global $conn;
        $sql = "select p.*,id_region,nombre_region from pais p
        left join region r on r.id_region = p.region_id";
        $result = $conn->query($sql);
        Llenar_Resultado($result);
        return;        
    }

    function Llenar_Resultado($resultado){
        global $resultglob;
        $resultglob = [];
        while($row = $resultado->fetch_assoc()){
            $resultglob[] = $row;
        }
    }

    function GetonePais($id){
        global $conn;
        $sql = "select p.*,id_region,nombre_region from pais p
        left join region r on r.id_region = p.region_id
        where p.id_pais = ".$id;
        $result = $conn->query($sql);
        Llenar_Resultado($result);
        return;    
    }

    if(isset($_GET['ID_PAIS'])){
        //delete pais
        global $conn;
        $sql = "delete from pais where id_pais = ".$_GET["ID_PAIS"];
        $result = $conn->query($sql);
        echo "SE REALIZO";
    }

    if(isset($_GET['UPDAT'])){
        //delete pais
        global $conn;
        $sql = "update pais
            set nombre_pais='".$_GET['nom']."',poblacion =".$_GET['pob'].",area=".$_GET['are'].",capital_pais='".$_GET['cap']."',region_id=".$_GET['reg']."
        where id_pais=".$_GET['UPDAT'];
        $result = $conn->query($sql);
        echo "ECHO";
    }

    if(isset($_GET['CREAT'])){
        global $conn;
        $sql = "insert into pais values(null,'".$_GET['nom']."',".$_GET['pob'].",".$_GET['are'].",'".$_GET['cap']."',".$_GET['reg'].")";
        $result = $conn->query($sql);
        echo "ECHO";
    }
?>