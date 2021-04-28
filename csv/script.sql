CREATE database IF NOT EXISTS Proyecto2;

use Proyecto2;

create table encuesta (
    id_encuesta int auto_increment,
    nombre_encuesta VARCHAR(100) not null,
    constraint encuesta_pk primary key(id_encuesta)
);

create table pregunta (
    id_pregunta int auto_increment not null,
    pregunta varchar(255) not null,
    encuesta_id integer not null,
    constraint pregunta_pk primary key(id_pregunta),
    constraint encuesta_fk foreign key(encuesta_id) references encuesta(id_encuesta) ON DELETE CASCADE
);

create table respuesta (
    id_respuesta int auto_increment not null,
    respuesta varchar(100) not null,
    letra varchar(100) not null,
    pregunta_id integer not null,
    constraint respuesta_pk primary key(id_respuesta),
    constraint pregunta_fk foreign key(pregunta_id) references pregunta(id_pregunta) ON DELETE CASCADE
);

create table respuesta_correcta (
    respuesta_id integer not null,
    pregunta_id integer not null,
    constraint respuesta_fk foreign key(respuesta_id) references respuesta(id_respuesta) ON DELETE CASCADE,
    constraint pregunta_fk2 foreign key(pregunta_id) references pregunta(id_pregunta) ON DELETE CASCADE
);

create table region (
    id_region int auto_increment not null,
    nombre_region varchar(100) not null,
    region_id integer,
    constraint region_pk primary key(id_region),
    constraint region_fk foreign key(region_id) references region(id_region) ON DELETE CASCADE
);

create table pais(
    id_pais int auto_increment not null,
    nombre_pais varchar(100) not null,
    poblacion integer not null,
    area integer not null,
    capital_pais varchar(100) not null,
    region_id integer,
    constraint pais_pk primary key(id_pais),
    constraint region_fk2 foreign key(region_id) references region(id_region) ON DELETE CASCADE
);

create table pais_respuesta(
    pais_id integer not null,
    respuesta_id integer not null,
    constraint pais_fk foreign key(pais_id) references pais(id_pais) ON DELETE CASCADE,
    constraint respuesta_fk2 foreign key(respuesta_id) references respuesta(id_respuesta) ON DELETE CASCADE
);

create table frontera(
    norte varchar(1),
    sur varchar(1),
    este varchar(1),
    oeste varchar(1),
    pais_id_1 integer not null,
    pais_id_2 integer not null,
    constraint pais_fk2 foreign key(pais_id_1) references pais(id_pais) ON DELETE CASCADE,
    constraint pais_fk3 foreign key(pais_id_2) references pais(id_pais) ON DELETE CASCADE
);

create table invento(
    id_invento int auto_increment not null,
    nombre_invento varchar(100) not null,
    anio_invento integer not null,
    pais_id integer not null,
    constraint invento_pk primary key(id_invento),
    constraint pais_fk4 foreign key(pais_id) references pais(id_pais) ON DELETE CASCADE
);

create table inventor(
    id_inventor int auto_increment not null,
    nombre_inventor varchar(100) not null,
    pais_id integer not null,
    constraint inventor_pk primary key(id_inventor),
    constraint pais_fk5 foreign key(pais_id) references pais(id_pais) ON DELETE CASCADE
);

create table inventado(
    inventor_id integer not null,
    invento_id integer not null,
    constraint inventor_fk foreign key(inventor_id) references inventor(id_inventor) ON DELETE CASCADE,
    constraint invento_fk foreign key(invento_id) references invento(id_invento) ON DELETE CASCADE
);

create table profesional(
    id_profesional int auto_increment not null,
    nombre_profesional varchar(100) not null,
    salario_profesional DECIMAL(8,2) not null,
    fecha_contrato date not null,
    comision DECIMAL(8,2) not null,
    constraint profesional_pk primary key(id_profesional)
);

create table asigna_invento(
    profesional_id integer not null,
    invento_id integer not null,
    constraint profesional_fk foreign key(profesional_id) references profesional(id_profesional) ON DELETE CASCADE,
    constraint invento_fk2 foreign key(invento_id) references invento(id_invento) ON DELETE CASCADE
);


create table area(
    id_area int auto_increment not null,
    nombre_area varchar(100) not null,
    ranking integer not null,
    descripcion varchar(100) not null,
    profesional_id integer not null,
    constraint area_pk primary key(id_area),
    constraint profesional_fk2 foreign key(profesional_id) references profesional(id_profesional) ON DELETE CASCADE
);

create table profe_area(
    profesional_id integer not null,
    area_id integer not null,
    constraint profesional_fk3 foreign key(profesional_id) references profesional(id_profesional) ON DELETE CASCADE,
    constraint area_fk foreign key(area_id) references area(id_area) ON DELETE CASCADE
);

create table temporal_file_1(
	invento varchar(100),
    inventor varchar(100),
    profesional_Asignado varchar(100),
    Profesional_Jefe_area varchar(100),
    fecha_Contrado_Profesional varchar(100),
    salario varchar(100),
    comision varchar(100),
    Area_Profesional varchar(100),
    ranking varchar(100),
    anio_inventado varchar(100),
    pais_invento varchar(100),
    pais_inventor varchar(100),
    region_pais varchar(100),
    capital varchar(100),
    poblacion_pais varchar(100),
    area_km varchar(100),
    Frontera_con varchar(100),
    norte varchar(100),
    sur varchar(100),
    este varchar(100),
    oeste varchar(100)
);

create Table temporal_file_2(
	nombre_encuesta varchar(100),
    pregunta varchar(255),
    respuesta_posibles varchar(100),
    respuesta_correcta varchar(100),
    pais varchar(100),
    respuesta_pais varchar(1)
);

create table temporal_file_3(
	nombre_region varchar(100),
    region_padre varchar(100)
);