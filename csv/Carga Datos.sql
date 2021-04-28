use Proyecto2;

-- Insert Regiones
INSERT INTO region(
SELECT distinct null, region_padre, null FROM temporal_file_3 where region_padre != ''
);
insert into region (
select null, tf3.nombre_region, r.id_region from temporal_file_3 as tf3
inner join region as r on r.nombre_region = tf3.region_padre
);
SELECT * FROM REGION;

-- insert into pais
	-- insert pais invento
insert into pais (
select null,trim(tf1.pais_invento) as pais,tf1.poblacion_pais,tf1.area_km,tf1.capital,r.id_region from temporal_file_1 as tf1
inner join region as r on r.nombre_region = tf1.region_pais
group by pais,tf1.poblacion_pais,tf1.area_km,tf1.capital,r.id_region
order by pais asc	
);
	-- insert pais de encuestas
insert into pais(
select null,trim(pais),0,0,"",null from temporal_file_2 as tf2
where not exists(
select nombre_pais from pais where nombre_pais = trim(pais))
group by pais
order by pais asc
);
	-- insert pais inventor
insert into pais(
select null,trim(pais_inventor),0,0,"",null from temporal_file_1 as tf1
where not exists(
select nombre_pais from pais where nombre_pais = trim(pais_inventor))
group by pais_inventor
order by pais_inventor asc
);
	-- insert pais frontera
insert into pais(
select null,trim(Frontera_con),0,0,"",null from temporal_file_1 as tf1
where not exists(
select nombre_pais from pais where nombre_pais = trim(Frontera_con))
group by pais_inventor
order by pais_inventor asc
);

-- insert table encuesta
insert into encuesta (id_encuesta, nombre_encuesta)(
select null, nombre_encuesta from temporal_file_2 
group by nombre_encuesta
);
select * from encuesta;

-- Insert Table preguntas
insert into pregunta(
select null, trim(tf2.pregunta), e.id_encuesta from temporal_file_2 as tf2
inner join encuesta as e on e.nombre_encuesta = tf2.nombre_encuesta
group by tf2.pregunta, e.id_encuesta
order by tf2.pregunta asc
);
select * from pregunta;

-- insert table respuestas
insert into respuesta (id_respuesta, respuesta, letra, pregunta_id)(
	select 	null,
		upper(trim(tf2.respuesta_posibles)) as rsp,
        upper(SUBSTRING(trim(tf2.respuesta_posibles), 1, 1)) as letra,
        p.id_pregunta 
        from temporal_file_2 as tf2
	inner join pregunta as p on p.pregunta = trim(tf2.pregunta)
    group by rsp,letra,id_pregunta
    order by id_pregunta asc
);
select * from respuesta;

-- insert into respuesta_correcta
insert into respuesta_correcta(
	select r.id_respuesta,p.id_pregunta from temporal_file_2 as tf2
	inner join respuesta as r on r.respuesta = upper(trim(tf2.respuesta_correcta))
	inner join pregunta as p on p.id_pregunta = r.pregunta_id
    group by r.id_respuesta
    order by r.id_respuesta asc
)
;
select * from respuesta_correcta;


-- insert into pais respuesta
insert pais_respuesta(
	select pa.id_pais,r.id_respuesta from temporal_file_2 as tf2
    inner join respuesta as r on r.respuesta = trim(tf2.respuesta_posibles) and r.letra = upper(trim(tf2.respuesta_pais))
    inner join pregunta as p on p.id_pregunta = r.pregunta_id and p.pregunta = trim(tf2.pregunta)
    inner join pais as pa on pa.nombre_pais = trim(tf2.pais)
    order by tf2.pais asc
);

select * from pais_respuesta;

-- insert into frontera
insert into frontera(
	select 
	SUBSTRING(upper(trim(norte)), 1, 1) as n,
    SUBSTRING(upper(trim(sur)), 1, 1) as s,
    SUBSTRING(upper(trim(este)), 1, 1) as e,
    SUBSTRING(upper(trim(oeste)), 1, 1) as o, 
    p.id_pais as Pais_invento,
    p2.id_pais as Frontera
    from temporal_file_1 as tf1
    inner join pais as p on p.nombre_pais = trim(tf1.pais_invento)
    inner join pais as p2 on p2.nombre_pais = trim(tf1.frontera_con)
    group by Pais_invento,Frontera
    order by Pais_invento asc
);
select * from frontera;

-- insert into invento
insert into invento(
	select 
		null,
        trim(invento),
        case
			WHEN trim(anio_inventado) = '' then 
				0
            else 
				CONVERT(trim(anio_inventado), UNSIGNED INTEGER)
		end,
        p.id_pais 
	from temporal_file_1
	inner join pais as p on p.nombre_pais = trim(pais_invento)
	group by invento,anio_inventado,p.id_pais
	order by invento
);

select count(*) from invento;

-- insert into inventores
insert into inventor(
	select null,trim(inventor),p.id_pais from temporal_file_1
	inner join pais as p on p.nombre_pais = pais_inventor 
    WHERE inventor not LIKE "%,%"
	group by inventor,p.id_pais
	order by inventor
);

insert into inventor(
	select null,subCon1.inventor_sub,id_pais from(
		select trim(SUBSTRING_INDEX(inventor, ",", 1)) as inventor_sub,trim(pais_inventor) as pais_inventor from temporal_file_1 
		WHERE inventor LIKE "%,%"
		group by inventor,pais_inventor
	) as subCon1
	inner join pais as p on p.nombre_pais = subCon1.pais_inventor
    where not exists(
		select nombre_inventor from inventor where subCon1.inventor_sub = nombre_inventor
	)
);

insert into inventor(
	select null,inventor_sub,id_pais from (
		select trim(
			SUBSTRING(
			SUBSTRING_INDEX(inventor,',',2),
			length(SUBSTRING_INDEX(inventor,',',1)) + 2
			,8)
			) as inventor_sub,
			trim(pais_inventor) as pais_inventor_sub
			from temporal_file_1
		WHERE inventor LIKE "%,%"
		group by inventor,pais_inventor_sub
	) as subCon1
	inner join pais as p on p.nombre_pais = subCon1.pais_inventor_sub
	where not exists(
		select nombre_inventor from inventor
        inner join pais as p on p.id_pais = inventor.pais_id
        where nombre_inventor=subCon1.inventor_sub and p.nombre_pais = trim(subCon1.pais_inventor_sub)
	)
)
;

insert into inventor(
	select null,trim(inventor_sub),p.id_pais from (
		select trim(
			SUBSTRING(
			SUBSTRING_INDEX(inventor,',',3),
			length(SUBSTRING_INDEX(inventor,',',2)) + 2
			,8)
			) as inventor_sub,
			trim(pais_inventor) as pais_inventor_sub
			from temporal_file_1
			WHERE inventor LIKE "%,%,%"
			group by inventor,pais_invento
	) as subCon1
	inner join pais as p on p.nombre_pais = subCon1.pais_inventor_sub
	where not exists (
		select nombre_inventor from inventor where nombre_inventor = trim(subCon1.inventor_sub)
	)
);

select count(*) from inventor where nombre_inventor != '';

-- insert into inventado
select count(*) from inventado;

insert into inventado(
	select inv.id_inventor,i.id_invento from temporal_file_1 as tf1
	inner join inventor as inv on inv.nombre_inventor = trim(tf1.inventor)
	inner join invento as i on i.nombre_invento = trim(tf1.invento)
    inner join pais as p on p.id_pais = inv.pais_id and p.nombre_pais = trim(tf1.pais_inventor)
	where tf1.inventor not like "%,%"
    group by nombre_inventor,nombre_invento
);
	
insert into inventado(
	select inv.id_inventor,i.id_invento from(
		select 
			trim(SUBSTRING_INDEX(inventor, ",", 1)) as inventor_sub,
			trim(invento) as invento,
			trim(pais_inventor) as pais_inventor
		from temporal_file_1 
		WHERE inventor LIKE "%,%"
		group by inventor,invento,pais_inventor
	) as subCon1
	inner join inventor as inv on inv.nombre_inventor = trim(subCon1.inventor_sub)
	inner join invento as i on i.nombre_invento = trim(subCon1.invento)
	inner join pais as p on p.id_pais = inv.pais_id and trim(subCon1.pais_inventor) = p.nombre_pais
);
    
insert into inventado(
	select inv.id_inventor,i.id_invento from (
		select trim(
			SUBSTRING(
			SUBSTRING_INDEX(inventor,',',2),
			length(SUBSTRING_INDEX(inventor,',',1)) + 2
			,8)
			) as inventor_sub,
			trim(invento) as invento_inventor,
			trim(pais_inventor) as pais_inventor_sub
			from temporal_file_1
		WHERE inventor LIKE "%,%"
		group by inventor_sub,invento_inventor,pais_inventor_sub
	) as subCon1
	inner join invento as i on i.nombre_invento = trim(subCon1.invento_inventor)
	inner join inventor as inv on inv.nombre_inventor = trim(subCon1.inventor_sub)
	inner join pais as p on p.nombre_pais = subCon1.pais_inventor_sub and p.id_pais = inv.pais_id
);

insert into inventado(
	select inv.id_inventor,i.id_invento from (
		select trim(
			SUBSTRING(
			SUBSTRING_INDEX(inventor,',',3),
			length(SUBSTRING_INDEX(inventor,',',2)) + 2
			,8)
			) as inventor_sub,
			trim(pais_inventor) as pais_inventor_sub,
			trim(invento) as invento_inventor
			from temporal_file_1
			WHERE inventor LIKE "%,%,%"
			group by inventor,pais_invento
	) as subCon1
	inner join inventor as inv on inv.nombre_inventor = trim(subCon1.inventor_sub)
	inner join invento as i on i.nombre_invento = trim(subCon1.invento_inventor)
	inner join pais as p on p.nombre_pais = subCon1.pais_inventor_sub and inv.pais_id = p.id_pais
);

-- insert into profesional

insert into profesional(
	select 
		null,
		trim(profesional_Asignado) as profesional_Asignado,
		case 
			when salario != '' then convert(salario,unsigned integer)
			else 0
		end as salario,
		str_to_date(replace(trim(replace(fecha_contrado_Profesional,'ene','jan')),'dic','dec'),'%d-%b-%y') as fecha,
		case 
			when comision != '' then convert(comision,unsigned integer)
			else 0
		end as comision
	from temporal_file_1
	group by profesional_Asignado,salario,fecha_contrado_Profesional,comision
);

select * from profesional;

-- insert into asigna_invento

insert into asigna_invento(
	select p.id_profesional,i.id_invento from temporal_file_1
	inner join invento as i on i.nombre_invento = trim(invento)
	inner join profesional as p on p.nombre_profesional = trim(profesional_asignado)
	group by p.nombre_profesional,i.nombre_invento
	order by profesional_asignado asc
);

-- insert into area
insert into area(
	select 
		null,
        trim(area_profesional) as area_profesional,
        case
			when ranking = '' then 0
            else convert(ranking, unsigned integer)
		end,
        "",
        null 
	from temporal_file_1 as tf1
	group by area_profesional,ranking
);

insert into area(
	select null,trim(profesional_jefe_area),0,"",null from temporal_file_1
    where not exists(
		select nombre_area from area where nombre_area=trim(profesional_jefe_area)
    )
    group by profesional_jefe_area
);

select * from area;

SET SQL_SAFE_UPDATES = 0;

update area as a
inner join temporal_file_1 as tf1 on a.nombre_area = trim(tf1.profesional_jefe_area) 
set profesional_id = (select id_profesional from profesional as p where p.nombre_profesional = trim(tf1.profesional_asignado) group by id_profesional)
where nombre_area != "" and a.nombre_area = tf1.profesional_jefe_Area;

-- insert into profesional _ area

insert into profe_area(
	select p.id_profesional,a.id_area from temporal_file_1 tf1
	inner join profesional p on p.nombre_profesional = trim(tf1.profesional_Asignado)
	inner join area a on a.nombre_area = trim(tf1.Area_Profesional)
	group by p.id_profesional,a.id_area
	order by a.nombre_area
);

