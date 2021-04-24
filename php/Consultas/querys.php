<?php
    include ('../database/connection.php');
    $resultglob = [];

    function query1() {
        global $conn;
        $sql = "select nombre_profesional,count(*) no_inventos from profesional
        inner join asigna_invento av on av.profesional_id = id_profesional
        group by nombre_profesional
        order by no_inventos desc";
        $result = $conn->query($sql);
        Llenar_Resultado($result);
        return;
    }

    function query2() {
        global $conn;
        $sql = "select 
            nombre_pais,
            count(pr.respuesta_id) no_Preguntas_Respondidas 
        from pais p
        left join pais_respuesta pr on pr.pais_id = p.id_pais
        group by nombre_pais
        order by no_Preguntas_Respondidas desc";
        $result = $conn->query($sql);
        Llenar_Resultado($result);
        return;
    }

    function query3() {
        global $conn;
        $sql = "(
            select p.id_pais,p.nombre_pais,p.capital_pais,p.area from pais p
            inner join frontera f on f.pais_id_1=p.id_pais
            inner join pais pa on pa.id_pais = f.pais_id_2
            where pa.nombre_pais = ''
            group by p.nombre_pais,p.capital_pais,pa.nombre_pais
        )
        union 
        (
            select p.id_pais,nombre_pais,capital_pais, p.area from pais p
            where not exists(
                select * from frontera f
                inner join pais pa on pa.id_pais = f.pais_id_1
                where trim(pa.nombre_pais) != '' and f.pais_id_1 = p.id_pais
            ) and not exists(
                select * from inventor i where i.pais_id = p.id_pais and i.nombre_inventor != ''
            )
        ) order by area asc";
        $result = $conn->query($sql);
        Llenar_Resultado($result);
        return;
    }

    function query4() {
        global $conn;
        $sql = "select nombre_profesional,count(*) no_inventos from profesional
        inner join asigna_invento av on av.profesional_id = id_profesional
        group by nombre_profesional
        order by no_inventos desc";
        $result = $conn->query($sql);
        Llenar_Resultado($result);
        return;
    }

    function query5() {
        global $conn;
        $sql = "select * from (
            select nombre_profesional,nombre_area,salario_profesional from profesional p
            inner join profe_area pa on pa.profesional_id = p.id_profesional
            inner join area a on a.id_area = pa.area_id
            order by nombre_area asc
        ) SubTabla
        where SubTabla.salario_profesional > (
            select avg(salario_profesional) from (
                select nombre_profesional,nombre_area,salario_profesional from profesional p
                inner join profe_area pa on pa.profesional_id = p.id_profesional
                inner join area a on a.id_area = pa.area_id
                order by nombre_area asc
            ) avgtable
            where avgtable.nombre_area = SubTabla.nombre_area
            group by nombre_area
        ) order by SubTabla.nombre_area asc";
        $result = $conn->query($sql);
        Llenar_Resultado($result);
        return;
    }

    function query6() {
        global $conn;
        $sql = "select p.nombre_pais,count(*) as Aciertos from pais p
        inner join pais_respuesta rp on rp.pais_id = p.id_pais
        inner join respuesta_correcta rc on rc.respuesta_id = rp.respuesta_id
        group by p.nombre_pais
        order by Aciertos desc";
        $result = $conn->query($sql);
        Llenar_Resultado($result);
        return;
    }

    function query7() {
        global $conn;
        $sql = "select i.nombre_invento,pr.nombre_profesional,a.nombre_area from invento i
        inner join asigna_invento ai on ai.invento_id = i.id_invento
        inner join profesional pr on pr.id_profesional = ai.profesional_id
        inner join profe_area pa on pa.profesional_id = pr.id_profesional
        inner join area a on a.id_area = pa.area_id
        where a.nombre_area='Óptica'
        group by i.nombre_invento,pr.nombre_profesional
        order by i.nombre_invento";
        $result = $conn->query($sql);
        Llenar_Resultado($result);
        return;
    }

    function query8() {
        global $conn;
        $sql = "select substr(nombre_pais,1,1) as Inicial_pais,sum(area) Sumatoria_area from pais
        group by Inicial_pais
        order by Inicial_pais asc";
        $result = $conn->query($sql);
        Llenar_Resultado($result);
        return;
    }

    function query9() {
        global $conn;
        $sql = "select nombre_invento,nombre_inventor from inventor inve
        inner join inventado inv on inv.inventor_id = inve.id_inventor
        inner join invento i on inv.invento_id = i.id_invento
        where upper(nombre_inventor) like 'BE%'";
        $result = $conn->query($sql);
        Llenar_Resultado($result);
        return;
    }

    function query10() {
        global $conn;
        $sql = "select nombre_inventor,i.nombre_invento,i.anio_invento from inventor inve
        inner join inventado inv on inv.inventor_id = inve.id_inventor
        inner join invento i on inv.invento_id = i.id_invento
        where (upper(nombre_inventor) like 'B%R' or upper(nombre_inventor) like 'B%N') and
        (i.anio_invento >= 1801 and i.anio_invento <= 1900)";
        $result = $conn->query($sql);
        Llenar_Resultado($result);
        return;
    }

    function query11() {
        global $conn;
        $sql = "select * from(
            select p.nombre_pais Pais,count(p.nombre_pais) No_Fronteras,p.area from pais p
            inner join frontera f on f.pais_id_1 = p.id_pais
            inner join pais pf on pf.id_pais = f.pais_id_2
            where pf.nombre_pais != '' and p.nombre_pais != ''
            group by Pais
        ) subcon
        where subcon.No_Fronteras>7
        order by subcon.area desc";
        $result = $conn->query($sql);
        Llenar_Resultado($result);
        return;
    }

    function query12() {
        global $conn;
        $sql = "select * from(
            select nombre_invento ,length(nombre_invento) size from invento
            where upper(nombre_invento) like 'L%'
        ) subcon
        where subcon.size = 4";
        $result = $conn->query($sql);
        Llenar_Resultado($result);
        return;
    }

    function query13() {
        global $conn;
        $sql = "select 
            nombre_profesional,
            salario_profesional,
            comision,
            (salario_profesional + comision) SueldoTotal 
        from profesional
        where comision > 0.25*salario_profesional";
        $result = $conn->query($sql);
        Llenar_Resultado($result);
        return;
    }

    function query14() {
        global $conn;
        $sql = "select nombre_encuesta, count(nombre_pais) Cantidad_Paises from(
            select e.nombre_encuesta, pa.nombre_pais from encuesta e
            inner join pregunta p on p.encuesta_id = e.id_encuesta
            inner join respuesta r on r.pregunta_id = p.id_pregunta
            inner join pais_respuesta rp on rp.respuesta_id = r.id_respuesta
            inner join pais pa on pa.id_pais = rp.pais_id
            group by e.nombre_encuesta, pa.nombre_pais
        ) subcon
        group by nombre_encuesta";
        $result = $conn->query($sql);
        Llenar_Resultado($result);
        return;
    }

    function query15() {
        global $conn;
        $sql = "select nombre_pais,poblacion from pais
        where poblacion > (
            select sum(p.Poblacion) from pais p
            inner join region r on r.id_region = p.region_id
            where r.nombre_region = 'Centro America'
            group by r.nombre_region
        )
        and nombre_pais != ''
        order by nombre_pais desc";
        $result = $conn->query($sql);
        Llenar_Resultado($result);
        return;
    }

    function query16() {
        global $conn;
        $sql = "select * from(
            (
            select p.nombre_profesional,a.nombre_area from area a
            inner join profesional p on p.id_profesional = a.profesional_id
            where a.nombre_area != 'TODAS'
            )
            union
            (
            select nombre_profesional,a.nombre_area from (
                select * from area a
                inner join profesional p on p.id_profesional = a.profesional_id
                where a.nombre_area = 'TODAS'
            ) subcon
            inner join area a
            where a.nombre_area != 'TODAS' and a.nombre_area != ''
            )
        ) as conUnion
        where nombre_area != (
            select nombre_area from profesional p
            inner join asigna_invento ai on p.id_profesional = ai.profesional_id
            inner join invento i on i.id_invento = ai.invento_id 
            inner join inventado inve on inve.invento_id = i.id_invento
            inner join inventor inv on inv.id_inventor = inve.inventor_id
            inner join profe_area pa on pa.profesional_id = p.id_profesional
            inner join area a on a.id_area = pa.area_id
            where nombre_inventor = 'Pasteur'
        )
        order by nombre_area asc";
        $result = $conn->query($sql);
        Llenar_Resultado($result);
        return;
    }

    function query17() {
        global $conn;
        $sql = "select nombre_invento,nombre_inventor,anio_invento from invento i
        inner join inventado inve on inve.invento_id = i.id_invento
        inner join inventor inv on inve.inventor_id = inv.id_inventor
        where anio_invento = (
            select anio_invento from invento i
            inner join inventado inve on inve.invento_id = i.id_invento
            inner join inventor inv on inve.inventor_id = inv.id_inventor
            where nombre_inventor = 'Benz'
        )";
        $result = $conn->query($sql);
        Llenar_Resultado($result);
        return;
    }

    function query18() {
        global $conn;
        $sql = "select nombre_profesional,count(*) no_inventos from profesional
        inner join asigna_invento av on av.profesional_id = id_profesional
        group by nombre_profesional
        order by no_inventos desc";
        $result = $conn->query($sql);
        Llenar_Resultado($result);
        return;
    }

    function query19() {
        global $conn;
        $sql = "select p.nombre_pais,p2.nombre_pais as frontera from pais p
        inner join frontera f on f.pais_id_1 = p.id_pais
        inner join pais p2 on p2.id_pais = f.pais_id_2
        where p.nombre_pais != '' and p2.nombre_pais != ''";
        $result = $conn->query($sql);
        Llenar_Resultado($result);
        return;
    }

    function query20() {
        global $conn;
        $sql = "select nombre_profesional,salario_profesional,comision from profesional
        where salario_profesional > 2*comision";
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
?>