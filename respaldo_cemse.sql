--
-- PostgreSQL database dump
--

-- Dumped from database version 9.6.10
-- Dumped by pg_dump version 9.6.10

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: juego; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA juego;


ALTER SCHEMA juego OWNER TO postgres;

--
-- Name: mensajeria; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA mensajeria;


ALTER SCHEMA mensajeria OWNER TO postgres;

--
-- Name: ordenes; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA ordenes;


ALTER SCHEMA ordenes OWNER TO postgres;

--
-- Name: tiger; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA tiger;


ALTER SCHEMA tiger OWNER TO postgres;

--
-- Name: tiger_data; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA tiger_data;


ALTER SCHEMA tiger_data OWNER TO postgres;

--
-- Name: topology; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA topology;


ALTER SCHEMA topology OWNER TO postgres;

--
-- Name: usuarios; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA usuarios;


ALTER SCHEMA usuarios OWNER TO postgres;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


--
-- Name: address_standardizer; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS address_standardizer WITH SCHEMA public;


--
-- Name: EXTENSION address_standardizer; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION address_standardizer IS 'Used to parse an address into constituent elements. Generally used to support geocoding address normalization step.';


--
-- Name: address_standardizer_data_us; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS address_standardizer_data_us WITH SCHEMA public;


--
-- Name: EXTENSION address_standardizer_data_us; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION address_standardizer_data_us IS 'Address Standardizer US dataset example';


--
-- Name: fuzzystrmatch; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS fuzzystrmatch WITH SCHEMA public;


--
-- Name: EXTENSION fuzzystrmatch; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION fuzzystrmatch IS 'determine similarities and distance between strings';


--
-- Name: postgis; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS postgis WITH SCHEMA public;


--
-- Name: EXTENSION postgis; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION postgis IS 'PostGIS geometry, geography, and raster spatial types and functions';


--
-- Name: postgis_tiger_geocoder; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS postgis_tiger_geocoder WITH SCHEMA tiger;


--
-- Name: EXTENSION postgis_tiger_geocoder; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION postgis_tiger_geocoder IS 'PostGIS tiger geocoder and reverse geocoder';


--
-- Name: postgis_topology; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS postgis_topology WITH SCHEMA topology;


--
-- Name: EXTENSION postgis_topology; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION postgis_topology IS 'PostGIS topology spatial types and functions';


--
-- Name: funcion_distancia(); Type: FUNCTION; Schema: juego; Owner: postgres
--

CREATE FUNCTION juego.funcion_distancia() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
BEGIN
      RAISE NOTICE  'función disparadora, acción = %, sobre fila gid = %', TG_OP,
       NEW.distancia = ST_length   (NEW.geom);
       RETURN NEW;
END;
$$;


ALTER FUNCTION juego.funcion_distancia() OWNER TO postgres;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: estado; Type: TABLE; Schema: juego; Owner: postgres
--

CREATE TABLE juego.estado (
    id_estado integer NOT NULL,
    estado character varying(255)
);


ALTER TABLE juego.estado OWNER TO postgres;

--
-- Name: Estado_id_estado_seq; Type: SEQUENCE; Schema: juego; Owner: postgres
--

CREATE SEQUENCE juego."Estado_id_estado_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE juego."Estado_id_estado_seq" OWNER TO postgres;

--
-- Name: Estado_id_estado_seq; Type: SEQUENCE OWNED BY; Schema: juego; Owner: postgres
--

ALTER SEQUENCE juego."Estado_id_estado_seq" OWNED BY juego.estado.id_estado;


--
-- Name: inventario; Type: TABLE; Schema: juego; Owner: postgres
--

CREATE TABLE juego.inventario (
    id_inventario integer NOT NULL,
    id_rol_propietario smallint,
    id_vehiculo smallint,
    cantidad integer,
    geom public.geometry(Point,3857),
    lat double precision,
    lon double precision,
    disponible integer,
    elemento integer
);


ALTER TABLE juego.inventario OWNER TO postgres;

--
-- Name: Inventario_id_inventario_seq; Type: SEQUENCE; Schema: juego; Owner: postgres
--

CREATE SEQUENCE juego."Inventario_id_inventario_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE juego."Inventario_id_inventario_seq" OWNER TO postgres;

--
-- Name: Inventario_id_inventario_seq; Type: SEQUENCE OWNED BY; Schema: juego; Owner: postgres
--

ALTER SEQUENCE juego."Inventario_id_inventario_seq" OWNED BY juego.inventario.id_inventario;


--
-- Name: inventario_x_uso; Type: TABLE; Schema: juego; Owner: postgres
--

CREATE TABLE juego.inventario_x_uso (
    id_inventario_uso integer NOT NULL,
    id_inventario smallint,
    id_recorrido integer,
    hora_salida timestamp without time zone,
    hora_llegada timestamp without time zone,
    id_estado integer DEFAULT 1,
    id_juego integer,
    geom public.geometry(Point,3857),
    cantidad integer
);


ALTER TABLE juego.inventario_x_uso OWNER TO postgres;

--
-- Name: Inventario_x_uso_id_inventario_uso_seq; Type: SEQUENCE; Schema: juego; Owner: postgres
--

CREATE SEQUENCE juego."Inventario_x_uso_id_inventario_uso_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE juego."Inventario_x_uso_id_inventario_uso_seq" OWNER TO postgres;

--
-- Name: Inventario_x_uso_id_inventario_uso_seq; Type: SEQUENCE OWNED BY; Schema: juego; Owner: postgres
--

ALTER SEQUENCE juego."Inventario_x_uso_id_inventario_uso_seq" OWNED BY juego.inventario_x_uso.id_inventario_uso;


--
-- Name: juego; Type: TABLE; Schema: juego; Owner: postgres
--

CREATE TABLE juego.juego (
    id_juego integer NOT NULL,
    descripcion character varying(255) NOT NULL,
    hora_inicio timestamp without time zone,
    hora_fin timestamp without time zone,
    id_estado smallint,
    nombre character varying,
    created_at timestamp without time zone,
    h_tactica numeric DEFAULT 0,
    mapid integer,
    id_situaciones integer,
    id_recorridos integer,
    id_movimiento integer
);


ALTER TABLE juego.juego OWNER TO postgres;

--
-- Name: Juego_id_juego_seq; Type: SEQUENCE; Schema: juego; Owner: postgres
--

CREATE SEQUENCE juego."Juego_id_juego_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE juego."Juego_id_juego_seq" OWNER TO postgres;

--
-- Name: Juego_id_juego_seq; Type: SEQUENCE OWNED BY; Schema: juego; Owner: postgres
--

ALTER SEQUENCE juego."Juego_id_juego_seq" OWNED BY juego.juego.id_juego;


--
-- Name: ordenes; Type: TABLE; Schema: juego; Owner: postgres
--

CREATE TABLE juego.ordenes (
    id_orden integer NOT NULL,
    nombre character varying(255),
    id_rol smallint,
    ruta character varying(255)
);


ALTER TABLE juego.ordenes OWNER TO postgres;

--
-- Name: Ordenes_id_orden_seq; Type: SEQUENCE; Schema: juego; Owner: postgres
--

CREATE SEQUENCE juego."Ordenes_id_orden_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE juego."Ordenes_id_orden_seq" OWNER TO postgres;

--
-- Name: Ordenes_id_orden_seq; Type: SEQUENCE OWNED BY; Schema: juego; Owner: postgres
--

ALTER SEQUENCE juego."Ordenes_id_orden_seq" OWNED BY juego.ordenes.id_orden;


--
-- Name: permisos; Type: TABLE; Schema: juego; Owner: postgres
--

CREATE TABLE juego.permisos (
    id_permiso integer NOT NULL,
    descripcion character varying(255)
);


ALTER TABLE juego.permisos OWNER TO postgres;

--
-- Name: Permisos_id_permiso_seq; Type: SEQUENCE; Schema: juego; Owner: postgres
--

CREATE SEQUENCE juego."Permisos_id_permiso_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE juego."Permisos_id_permiso_seq" OWNER TO postgres;

--
-- Name: Permisos_id_permiso_seq; Type: SEQUENCE OWNED BY; Schema: juego; Owner: postgres
--

ALTER SEQUENCE juego."Permisos_id_permiso_seq" OWNED BY juego.permisos.id_permiso;


--
-- Name: permisos_x_rol; Type: TABLE; Schema: juego; Owner: postgres
--

CREATE TABLE juego.permisos_x_rol (
    id_permiso_rol integer NOT NULL,
    id_rol smallint,
    id_permiso smallint
);


ALTER TABLE juego.permisos_x_rol OWNER TO postgres;

--
-- Name: Permisos_x_rol_id_permiso_rol_seq; Type: SEQUENCE; Schema: juego; Owner: postgres
--

CREATE SEQUENCE juego."Permisos_x_rol_id_permiso_rol_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE juego."Permisos_x_rol_id_permiso_rol_seq" OWNER TO postgres;

--
-- Name: Permisos_x_rol_id_permiso_rol_seq; Type: SEQUENCE OWNED BY; Schema: juego; Owner: postgres
--

ALTER SEQUENCE juego."Permisos_x_rol_id_permiso_rol_seq" OWNED BY juego.permisos_x_rol.id_permiso_rol;


--
-- Name: personal; Type: TABLE; Schema: juego; Owner: postgres
--

CREATE TABLE juego.personal (
    id_personal integer NOT NULL,
    "Descripcion" character varying(255),
    geometry character varying(255)
);


ALTER TABLE juego.personal OWNER TO postgres;

--
-- Name: Personal_id_personal_seq; Type: SEQUENCE; Schema: juego; Owner: postgres
--

CREATE SEQUENCE juego."Personal_id_personal_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE juego."Personal_id_personal_seq" OWNER TO postgres;

--
-- Name: Personal_id_personal_seq; Type: SEQUENCE OWNED BY; Schema: juego; Owner: postgres
--

ALTER SEQUENCE juego."Personal_id_personal_seq" OWNED BY juego.personal.id_personal;


--
-- Name: roles_x_juego; Type: TABLE; Schema: juego; Owner: postgres
--

CREATE TABLE juego.roles_x_juego (
    id_rol integer NOT NULL,
    nombre_rol character varying(255),
    id_juego smallint,
    id_usuario integer,
    director boolean DEFAULT false
);


ALTER TABLE juego.roles_x_juego OWNER TO postgres;

--
-- Name: Roles_x_juego_id_rol_seq; Type: SEQUENCE; Schema: juego; Owner: postgres
--

CREATE SEQUENCE juego."Roles_x_juego_id_rol_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE juego."Roles_x_juego_id_rol_seq" OWNER TO postgres;

--
-- Name: Roles_x_juego_id_rol_seq; Type: SEQUENCE OWNED BY; Schema: juego; Owner: postgres
--

ALTER SEQUENCE juego."Roles_x_juego_id_rol_seq" OWNED BY juego.roles_x_juego.id_rol;


--
-- Name: situaciones; Type: TABLE; Schema: juego; Owner: postgres
--

CREATE TABLE juego.situaciones (
    id_situacion integer NOT NULL,
    id_juego smallint,
    nombre character varying(255),
    id_tipo_situacion smallint,
    id_estado smallint,
    fecha timestamp without time zone,
    ruta character varying,
    descripcion character varying,
    lat double precision,
    lon double precision,
    geom public.geometry(Point,3857)
);


ALTER TABLE juego.situaciones OWNER TO postgres;

--
-- Name: Situaciones_id_situacion_seq; Type: SEQUENCE; Schema: juego; Owner: postgres
--

CREATE SEQUENCE juego."Situaciones_id_situacion_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE juego."Situaciones_id_situacion_seq" OWNER TO postgres;

--
-- Name: Situaciones_id_situacion_seq; Type: SEQUENCE OWNED BY; Schema: juego; Owner: postgres
--

ALTER SEQUENCE juego."Situaciones_id_situacion_seq" OWNED BY juego.situaciones.id_situacion;


--
-- Name: tipo_elemento; Type: TABLE; Schema: juego; Owner: postgres
--

CREATE TABLE juego.tipo_elemento (
    id_tipo_elemento integer NOT NULL,
    tipo_elemento character varying,
    descripcion character varying
);


ALTER TABLE juego.tipo_elemento OWNER TO postgres;

--
-- Name: Tipo_elemento_id_tipo_elemento_seq; Type: SEQUENCE; Schema: juego; Owner: postgres
--

CREATE SEQUENCE juego."Tipo_elemento_id_tipo_elemento_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE juego."Tipo_elemento_id_tipo_elemento_seq" OWNER TO postgres;

--
-- Name: Tipo_elemento_id_tipo_elemento_seq; Type: SEQUENCE OWNED BY; Schema: juego; Owner: postgres
--

ALTER SEQUENCE juego."Tipo_elemento_id_tipo_elemento_seq" OWNED BY juego.tipo_elemento.id_tipo_elemento;


--
-- Name: tipo_situaciones; Type: TABLE; Schema: juego; Owner: postgres
--

CREATE TABLE juego.tipo_situaciones (
    id_tipo_situacion integer NOT NULL,
    tipo_situacion character varying(255)
);


ALTER TABLE juego.tipo_situaciones OWNER TO postgres;

--
-- Name: Tipo_situaciones_id_tipo_situacion_seq; Type: SEQUENCE; Schema: juego; Owner: postgres
--

CREATE SEQUENCE juego."Tipo_situaciones_id_tipo_situacion_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE juego."Tipo_situaciones_id_tipo_situacion_seq" OWNER TO postgres;

--
-- Name: Tipo_situaciones_id_tipo_situacion_seq; Type: SEQUENCE OWNED BY; Schema: juego; Owner: postgres
--

ALTER SEQUENCE juego."Tipo_situaciones_id_tipo_situacion_seq" OWNED BY juego.tipo_situaciones.id_tipo_situacion;


--
-- Name: vehiculos; Type: TABLE; Schema: juego; Owner: postgres
--

CREATE TABLE juego.vehiculos (
    id_vehiculo integer NOT NULL,
    id_tipo_elemento smallint,
    nombre character varying(255),
    marca character varying,
    descripcion character varying(255),
    geometry character varying(255),
    capacidad character varying(255),
    id_unidad integer,
    id_icono integer,
    modelo character varying,
    velocidad numeric
);


ALTER TABLE juego.vehiculos OWNER TO postgres;

--
-- Name: Vehiculos_id_vehiculo_seq; Type: SEQUENCE; Schema: juego; Owner: postgres
--

CREATE SEQUENCE juego."Vehiculos_id_vehiculo_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE juego."Vehiculos_id_vehiculo_seq" OWNER TO postgres;

--
-- Name: Vehiculos_id_vehiculo_seq; Type: SEQUENCE OWNED BY; Schema: juego; Owner: postgres
--

ALTER SEQUENCE juego."Vehiculos_id_vehiculo_seq" OWNED BY juego.vehiculos.id_vehiculo;


--
-- Name: biblioteca; Type: TABLE; Schema: juego; Owner: postgres
--

CREATE TABLE juego.biblioteca (
    id_archivo integer NOT NULL,
    nombre_archivo character varying,
    peso numeric,
    ruta character varying,
    id_juego integer,
    nombre character varying
);


ALTER TABLE juego.biblioteca OWNER TO postgres;

--
-- Name: biblioteca_id_archivo_seq; Type: SEQUENCE; Schema: juego; Owner: postgres
--

CREATE SEQUENCE juego.biblioteca_id_archivo_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE juego.biblioteca_id_archivo_seq OWNER TO postgres;

--
-- Name: biblioteca_id_archivo_seq; Type: SEQUENCE OWNED BY; Schema: juego; Owner: postgres
--

ALTER SEQUENCE juego.biblioteca_id_archivo_seq OWNED BY juego.biblioteca.id_archivo;


--
-- Name: iconos; Type: TABLE; Schema: juego; Owner: postgres
--

CREATE TABLE juego.iconos (
    id_iconos integer NOT NULL,
    icono character varying
);


ALTER TABLE juego.iconos OWNER TO postgres;

--
-- Name: iconos_id_iconos_seq; Type: SEQUENCE; Schema: juego; Owner: postgres
--

CREATE SEQUENCE juego.iconos_id_iconos_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE juego.iconos_id_iconos_seq OWNER TO postgres;

--
-- Name: iconos_id_iconos_seq; Type: SEQUENCE OWNED BY; Schema: juego; Owner: postgres
--

ALTER SEQUENCE juego.iconos_id_iconos_seq OWNED BY juego.iconos.id_iconos;


--
-- Name: lineas; Type: TABLE; Schema: juego; Owner: postgres
--

CREATE TABLE juego.lineas (
    id_recorrido integer NOT NULL,
    geom public.geometry(LineString,3857),
    nombre_recorrido character varying,
    distancia double precision,
    id_juego integer,
    id_rol integer
);


ALTER TABLE juego.lineas OWNER TO postgres;

--
-- Name: lineas_id_seq; Type: SEQUENCE; Schema: juego; Owner: postgres
--

CREATE SEQUENCE juego.lineas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE juego.lineas_id_seq OWNER TO postgres;

--
-- Name: lineas_id_seq; Type: SEQUENCE OWNED BY; Schema: juego; Owner: postgres
--

ALTER SEQUENCE juego.lineas_id_seq OWNED BY juego.lineas.id_recorrido;


--
-- Name: materiales; Type: TABLE; Schema: juego; Owner: postgres
--

CREATE TABLE juego.materiales (
    id_material integer NOT NULL,
    material character varying,
    activo boolean DEFAULT true
);


ALTER TABLE juego.materiales OWNER TO postgres;

--
-- Name: materiales_id_material_seq; Type: SEQUENCE; Schema: juego; Owner: postgres
--

CREATE SEQUENCE juego.materiales_id_material_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE juego.materiales_id_material_seq OWNER TO postgres;

--
-- Name: materiales_id_material_seq; Type: SEQUENCE OWNED BY; Schema: juego; Owner: postgres
--

ALTER SEQUENCE juego.materiales_id_material_seq OWNED BY juego.materiales.id_material;


--
-- Name: unidades; Type: TABLE; Schema: juego; Owner: postgres
--

CREATE TABLE juego.unidades (
    id_unidad integer NOT NULL,
    unidad character varying
);


ALTER TABLE juego.unidades OWNER TO postgres;

--
-- Name: unidades_id_unidades_seq; Type: SEQUENCE; Schema: juego; Owner: postgres
--

CREATE SEQUENCE juego.unidades_id_unidades_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE juego.unidades_id_unidades_seq OWNER TO postgres;

--
-- Name: unidades_id_unidades_seq; Type: SEQUENCE OWNED BY; Schema: juego; Owner: postgres
--

ALTER SEQUENCE juego.unidades_id_unidades_seq OWNED BY juego.unidades.id_unidad;


--
-- Name: unidades_inventario; Type: TABLE; Schema: juego; Owner: postgres
--

CREATE TABLE juego.unidades_inventario (
    id_unidad integer NOT NULL,
    id_inventario_uso integer,
    id_material integer,
    cantidad integer
);


ALTER TABLE juego.unidades_inventario OWNER TO postgres;

--
-- Name: unidades_inventario_id_unidad_seq; Type: SEQUENCE; Schema: juego; Owner: postgres
--

CREATE SEQUENCE juego.unidades_inventario_id_unidad_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE juego.unidades_inventario_id_unidad_seq OWNER TO postgres;

--
-- Name: unidades_inventario_id_unidad_seq; Type: SEQUENCE OWNED BY; Schema: juego; Owner: postgres
--

ALTER SEQUENCE juego.unidades_inventario_id_unidad_seq OWNED BY juego.unidades_inventario.id_unidad;


--
-- Name: usuarios_x_juego; Type: TABLE; Schema: juego; Owner: postgres
--

CREATE TABLE juego.usuarios_x_juego (
    id_usuario_juego integer NOT NULL,
    id_juego integer,
    id_usuario integer
);


ALTER TABLE juego.usuarios_x_juego OWNER TO postgres;

--
-- Name: usuarios_x_juego_id_usuario_juego_seq; Type: SEQUENCE; Schema: juego; Owner: postgres
--

CREATE SEQUENCE juego.usuarios_x_juego_id_usuario_juego_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE juego.usuarios_x_juego_id_usuario_juego_seq OWNER TO postgres;

--
-- Name: usuarios_x_juego_id_usuario_juego_seq; Type: SEQUENCE OWNED BY; Schema: juego; Owner: postgres
--

ALTER SEQUENCE juego.usuarios_x_juego_id_usuario_juego_seq OWNED BY juego.usuarios_x_juego.id_usuario_juego;


--
-- Name: vw_distancia; Type: VIEW; Schema: juego; Owner: postgres
--

CREATE VIEW juego.vw_distancia AS
 SELECT lineas.id_recorrido AS id,
    lineas.geom,
    public.st_length(lineas.geom) AS distancia
   FROM juego.lineas;


ALTER TABLE juego.vw_distancia OWNER TO postgres;

--
-- Name: vw_inventario; Type: VIEW; Schema: juego; Owner: postgres
--

CREATE VIEW juego.vw_inventario AS
 SELECT inventario.geom,
    materiales.material,
    vehiculos.nombre,
    vehiculos.id_icono
   FROM ((juego.inventario
     LEFT JOIN juego.vehiculos ON ((inventario.id_vehiculo = vehiculos.id_vehiculo)))
     LEFT JOIN juego.materiales ON ((inventario.elemento = materiales.id_material)));


ALTER TABLE juego.vw_inventario OWNER TO postgres;

--
-- Name: vw_inventario_uso; Type: VIEW; Schema: juego; Owner: postgres
--

CREATE VIEW juego.vw_inventario_uso AS
 SELECT d.nombre_rol,
    c.nombre,
    string_agg(DISTINCT (h.material)::text, '-'::text) AS elementos,
    a.cantidad,
    a.hora_salida,
    a.hora_llegada,
    a.geom
   FROM (((((((juego.inventario_x_uso a
     LEFT JOIN juego.inventario b ON ((b.id_inventario = a.id_inventario)))
     LEFT JOIN juego.vehiculos c ON ((b.id_vehiculo = c.id_vehiculo)))
     LEFT JOIN juego.roles_x_juego d ON ((d.id_rol = b.id_rol_propietario)))
     LEFT JOIN juego.materiales e ON ((b.elemento = e.id_material)))
     LEFT JOIN juego.unidades_inventario f ON ((a.id_inventario_uso = f.id_inventario_uso)))
     LEFT JOIN juego.inventario g ON ((f.id_material = g.id_inventario)))
     LEFT JOIN juego.materiales h ON ((g.elemento = h.id_material)))
  GROUP BY d.nombre_rol, c.nombre, a.cantidad, a.hora_salida, a.hora_llegada, a.geom;


ALTER TABLE juego.vw_inventario_uso OWNER TO postgres;

--
-- Name: vw_linea; Type: VIEW; Schema: juego; Owner: postgres
--

CREATE VIEW juego.vw_linea AS
 SELECT lineas.id_recorrido AS id,
    lineas.geom,
    public.st_line_interpolate_point(lineas.geom, (0.70)::double precision) AS punto
   FROM juego.lineas;


ALTER TABLE juego.vw_linea OWNER TO postgres;

--
-- Name: vw_sitaciones; Type: VIEW; Schema: juego; Owner: postgres
--

CREATE VIEW juego.vw_sitaciones AS
 SELECT a.nombre,
    a.fecha,
    a.descripcion,
    b.tipo_situacion,
    c.estado,
    a.geom
   FROM ((juego.situaciones a
     JOIN juego.tipo_situaciones b ON ((a.id_tipo_situacion = b.id_tipo_situacion)))
     JOIN juego.estado c ON ((a.id_estado = c.id_estado)));


ALTER TABLE juego.vw_sitaciones OWNER TO postgres;

--
-- Name: adjuntos; Type: TABLE; Schema: mensajeria; Owner: postgres
--

CREATE TABLE mensajeria.adjuntos (
    id_adjunto integer NOT NULL,
    id_mensaje smallint,
    ruta character varying(255)
);


ALTER TABLE mensajeria.adjuntos OWNER TO postgres;

--
-- Name: Adjuntos_id_adjunto_seq; Type: SEQUENCE; Schema: mensajeria; Owner: postgres
--

CREATE SEQUENCE mensajeria."Adjuntos_id_adjunto_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mensajeria."Adjuntos_id_adjunto_seq" OWNER TO postgres;

--
-- Name: Adjuntos_id_adjunto_seq; Type: SEQUENCE OWNED BY; Schema: mensajeria; Owner: postgres
--

ALTER SEQUENCE mensajeria."Adjuntos_id_adjunto_seq" OWNED BY mensajeria.adjuntos.id_adjunto;


--
-- Name: estado; Type: TABLE; Schema: mensajeria; Owner: postgres
--

CREATE TABLE mensajeria.estado (
    id_estado integer NOT NULL,
    estado character varying(255)
);


ALTER TABLE mensajeria.estado OWNER TO postgres;

--
-- Name: Estado_id_estado_seq; Type: SEQUENCE; Schema: mensajeria; Owner: postgres
--

CREATE SEQUENCE mensajeria."Estado_id_estado_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mensajeria."Estado_id_estado_seq" OWNER TO postgres;

--
-- Name: Estado_id_estado_seq; Type: SEQUENCE OWNED BY; Schema: mensajeria; Owner: postgres
--

ALTER SEQUENCE mensajeria."Estado_id_estado_seq" OWNED BY mensajeria.estado.id_estado;


--
-- Name: mensaje; Type: TABLE; Schema: mensajeria; Owner: postgres
--

CREATE TABLE mensajeria.mensaje (
    id_mensaje integer NOT NULL,
    asunto character varying(255),
    mensaje character varying(255),
    fecha timestamp without time zone,
    id_estado smallint,
    remitente integer,
    id_juego integer,
    id_situacion integer,
    adjunto character varying
);


ALTER TABLE mensajeria.mensaje OWNER TO postgres;

--
-- Name: Mensaje_id_mensaje_seq; Type: SEQUENCE; Schema: mensajeria; Owner: postgres
--

CREATE SEQUENCE mensajeria."Mensaje_id_mensaje_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mensajeria."Mensaje_id_mensaje_seq" OWNER TO postgres;

--
-- Name: Mensaje_id_mensaje_seq; Type: SEQUENCE OWNED BY; Schema: mensajeria; Owner: postgres
--

ALTER SEQUENCE mensajeria."Mensaje_id_mensaje_seq" OWNED BY mensajeria.mensaje.id_mensaje;


--
-- Name: receptores; Type: TABLE; Schema: mensajeria; Owner: postgres
--

CREATE TABLE mensajeria.receptores (
    id_usuarios integer NOT NULL,
    id_mensaje smallint,
    id_rol smallint,
    id_estado integer DEFAULT 1
);


ALTER TABLE mensajeria.receptores OWNER TO postgres;

--
-- Name: Usuarios_id_usuarios_seq; Type: SEQUENCE; Schema: mensajeria; Owner: postgres
--

CREATE SEQUENCE mensajeria."Usuarios_id_usuarios_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mensajeria."Usuarios_id_usuarios_seq" OWNER TO postgres;

--
-- Name: Usuarios_id_usuarios_seq; Type: SEQUENCE OWNED BY; Schema: mensajeria; Owner: postgres
--

ALTER SEQUENCE mensajeria."Usuarios_id_usuarios_seq" OWNED BY mensajeria.receptores.id_usuarios;


--
-- Name: orden; Type: TABLE; Schema: ordenes; Owner: postgres
--

CREATE TABLE ordenes.orden (
    id_orden integer NOT NULL,
    operacion character varying,
    referencias character varying,
    huso character varying,
    mision character varying,
    situacion character varying,
    cursos character varying,
    analisis character varying,
    comparacion character varying,
    recomendaciones character varying,
    id_rol integer,
    texto character varying,
    del character varying,
    unidad_mando character varying,
    unidad_subordinada character varying,
    id_tipo_orden integer,
    titulo character varying,
    organizacion character varying,
    apoyo character varying,
    mando character varying,
    ejecucion character varying,
    clasificacion character varying,
    al character varying,
    previas character varying,
    datos_ejemplar character varying,
    firmas character varying,
    activa boolean DEFAULT true,
    ruta character varying
);


ALTER TABLE ordenes.orden OWNER TO postgres;

--
-- Name: apreciacion_id_orden_seq; Type: SEQUENCE; Schema: ordenes; Owner: postgres
--

CREATE SEQUENCE ordenes.apreciacion_id_orden_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE ordenes.apreciacion_id_orden_seq OWNER TO postgres;

--
-- Name: apreciacion_id_orden_seq; Type: SEQUENCE OWNED BY; Schema: ordenes; Owner: postgres
--

ALTER SEQUENCE ordenes.apreciacion_id_orden_seq OWNED BY ordenes.orden.id_orden;


--
-- Name: compartidas; Type: TABLE; Schema: ordenes; Owner: postgres
--

CREATE TABLE ordenes.compartidas (
    id_compartido integer NOT NULL,
    id_rol integer,
    id_orden integer,
    id_mensaje integer
);


ALTER TABLE ordenes.compartidas OWNER TO postgres;

--
-- Name: compartidas_id_compartido_seq; Type: SEQUENCE; Schema: ordenes; Owner: postgres
--

CREATE SEQUENCE ordenes.compartidas_id_compartido_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE ordenes.compartidas_id_compartido_seq OWNER TO postgres;

--
-- Name: compartidas_id_compartido_seq; Type: SEQUENCE OWNED BY; Schema: ordenes; Owner: postgres
--

ALTER SEQUENCE ordenes.compartidas_id_compartido_seq OWNED BY ordenes.compartidas.id_compartido;


--
-- Name: tipo_orden; Type: TABLE; Schema: ordenes; Owner: postgres
--

CREATE TABLE ordenes.tipo_orden (
    id_tipo_orden integer NOT NULL,
    tipo_orden character varying
);


ALTER TABLE ordenes.tipo_orden OWNER TO postgres;

--
-- Name: tipo_orden_id_tipo_orden_seq; Type: SEQUENCE; Schema: ordenes; Owner: postgres
--

CREATE SEQUENCE ordenes.tipo_orden_id_tipo_orden_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE ordenes.tipo_orden_id_tipo_orden_seq OWNER TO postgres;

--
-- Name: tipo_orden_id_tipo_orden_seq; Type: SEQUENCE OWNED BY; Schema: ordenes; Owner: postgres
--

ALTER SEQUENCE ordenes.tipo_orden_id_tipo_orden_seq OWNED BY ordenes.tipo_orden.id_tipo_orden;


--
-- Name: usuario; Type: TABLE; Schema: usuarios; Owner: postgres
--

CREATE TABLE usuarios.usuario (
    id_usuario integer NOT NULL,
    usuario character varying(255) NOT NULL,
    password character varying(255) NOT NULL,
    nombre_apellido character varying(255) NOT NULL,
    created_at timestamp without time zone,
    last_login timestamp without time zone,
    is_active boolean,
    administrador boolean DEFAULT false
);


ALTER TABLE usuarios.usuario OWNER TO postgres;

--
-- Name: biblioteca id_archivo; Type: DEFAULT; Schema: juego; Owner: postgres
--

ALTER TABLE ONLY juego.biblioteca ALTER COLUMN id_archivo SET DEFAULT nextval('juego.biblioteca_id_archivo_seq'::regclass);


--
-- Name: estado id_estado; Type: DEFAULT; Schema: juego; Owner: postgres
--

ALTER TABLE ONLY juego.estado ALTER COLUMN id_estado SET DEFAULT nextval('juego."Estado_id_estado_seq"'::regclass);


--
-- Name: iconos id_iconos; Type: DEFAULT; Schema: juego; Owner: postgres
--

ALTER TABLE ONLY juego.iconos ALTER COLUMN id_iconos SET DEFAULT nextval('juego.iconos_id_iconos_seq'::regclass);


--
-- Name: inventario id_inventario; Type: DEFAULT; Schema: juego; Owner: postgres
--

ALTER TABLE ONLY juego.inventario ALTER COLUMN id_inventario SET DEFAULT nextval('juego."Inventario_id_inventario_seq"'::regclass);


--
-- Name: inventario_x_uso id_inventario_uso; Type: DEFAULT; Schema: juego; Owner: postgres
--

ALTER TABLE ONLY juego.inventario_x_uso ALTER COLUMN id_inventario_uso SET DEFAULT nextval('juego."Inventario_x_uso_id_inventario_uso_seq"'::regclass);


--
-- Name: juego id_juego; Type: DEFAULT; Schema: juego; Owner: postgres
--

ALTER TABLE ONLY juego.juego ALTER COLUMN id_juego SET DEFAULT nextval('juego."Juego_id_juego_seq"'::regclass);


--
-- Name: lineas id_recorrido; Type: DEFAULT; Schema: juego; Owner: postgres
--

ALTER TABLE ONLY juego.lineas ALTER COLUMN id_recorrido SET DEFAULT nextval('juego.lineas_id_seq'::regclass);


--
-- Name: materiales id_material; Type: DEFAULT; Schema: juego; Owner: postgres
--

ALTER TABLE ONLY juego.materiales ALTER COLUMN id_material SET DEFAULT nextval('juego.materiales_id_material_seq'::regclass);


--
-- Name: ordenes id_orden; Type: DEFAULT; Schema: juego; Owner: postgres
--

ALTER TABLE ONLY juego.ordenes ALTER COLUMN id_orden SET DEFAULT nextval('juego."Ordenes_id_orden_seq"'::regclass);


--
-- Name: permisos id_permiso; Type: DEFAULT; Schema: juego; Owner: postgres
--

ALTER TABLE ONLY juego.permisos ALTER COLUMN id_permiso SET DEFAULT nextval('juego."Permisos_id_permiso_seq"'::regclass);


--
-- Name: permisos_x_rol id_permiso_rol; Type: DEFAULT; Schema: juego; Owner: postgres
--

ALTER TABLE ONLY juego.permisos_x_rol ALTER COLUMN id_permiso_rol SET DEFAULT nextval('juego."Permisos_x_rol_id_permiso_rol_seq"'::regclass);


--
-- Name: personal id_personal; Type: DEFAULT; Schema: juego; Owner: postgres
--

ALTER TABLE ONLY juego.personal ALTER COLUMN id_personal SET DEFAULT nextval('juego."Personal_id_personal_seq"'::regclass);


--
-- Name: roles_x_juego id_rol; Type: DEFAULT; Schema: juego; Owner: postgres
--

ALTER TABLE ONLY juego.roles_x_juego ALTER COLUMN id_rol SET DEFAULT nextval('juego."Roles_x_juego_id_rol_seq"'::regclass);


--
-- Name: situaciones id_situacion; Type: DEFAULT; Schema: juego; Owner: postgres
--

ALTER TABLE ONLY juego.situaciones ALTER COLUMN id_situacion SET DEFAULT nextval('juego."Situaciones_id_situacion_seq"'::regclass);


--
-- Name: tipo_elemento id_tipo_elemento; Type: DEFAULT; Schema: juego; Owner: postgres
--

ALTER TABLE ONLY juego.tipo_elemento ALTER COLUMN id_tipo_elemento SET DEFAULT nextval('juego."Tipo_elemento_id_tipo_elemento_seq"'::regclass);


--
-- Name: tipo_situaciones id_tipo_situacion; Type: DEFAULT; Schema: juego; Owner: postgres
--

ALTER TABLE ONLY juego.tipo_situaciones ALTER COLUMN id_tipo_situacion SET DEFAULT nextval('juego."Tipo_situaciones_id_tipo_situacion_seq"'::regclass);


--
-- Name: unidades id_unidad; Type: DEFAULT; Schema: juego; Owner: postgres
--

ALTER TABLE ONLY juego.unidades ALTER COLUMN id_unidad SET DEFAULT nextval('juego.unidades_id_unidades_seq'::regclass);


--
-- Name: unidades_inventario id_unidad; Type: DEFAULT; Schema: juego; Owner: postgres
--

ALTER TABLE ONLY juego.unidades_inventario ALTER COLUMN id_unidad SET DEFAULT nextval('juego.unidades_inventario_id_unidad_seq'::regclass);


--
-- Name: usuarios_x_juego id_usuario_juego; Type: DEFAULT; Schema: juego; Owner: postgres
--

ALTER TABLE ONLY juego.usuarios_x_juego ALTER COLUMN id_usuario_juego SET DEFAULT nextval('juego.usuarios_x_juego_id_usuario_juego_seq'::regclass);


--
-- Name: vehiculos id_vehiculo; Type: DEFAULT; Schema: juego; Owner: postgres
--

ALTER TABLE ONLY juego.vehiculos ALTER COLUMN id_vehiculo SET DEFAULT nextval('juego."Vehiculos_id_vehiculo_seq"'::regclass);


--
-- Name: adjuntos id_adjunto; Type: DEFAULT; Schema: mensajeria; Owner: postgres
--

ALTER TABLE ONLY mensajeria.adjuntos ALTER COLUMN id_adjunto SET DEFAULT nextval('mensajeria."Adjuntos_id_adjunto_seq"'::regclass);


--
-- Name: estado id_estado; Type: DEFAULT; Schema: mensajeria; Owner: postgres
--

ALTER TABLE ONLY mensajeria.estado ALTER COLUMN id_estado SET DEFAULT nextval('mensajeria."Estado_id_estado_seq"'::regclass);


--
-- Name: mensaje id_mensaje; Type: DEFAULT; Schema: mensajeria; Owner: postgres
--

ALTER TABLE ONLY mensajeria.mensaje ALTER COLUMN id_mensaje SET DEFAULT nextval('mensajeria."Mensaje_id_mensaje_seq"'::regclass);


--
-- Name: receptores id_usuarios; Type: DEFAULT; Schema: mensajeria; Owner: postgres
--

ALTER TABLE ONLY mensajeria.receptores ALTER COLUMN id_usuarios SET DEFAULT nextval('mensajeria."Usuarios_id_usuarios_seq"'::regclass);


--
-- Name: compartidas id_compartido; Type: DEFAULT; Schema: ordenes; Owner: postgres
--

ALTER TABLE ONLY ordenes.compartidas ALTER COLUMN id_compartido SET DEFAULT nextval('ordenes.compartidas_id_compartido_seq'::regclass);


--
-- Name: orden id_orden; Type: DEFAULT; Schema: ordenes; Owner: postgres
--

ALTER TABLE ONLY ordenes.orden ALTER COLUMN id_orden SET DEFAULT nextval('ordenes.apreciacion_id_orden_seq'::regclass);


--
-- Name: tipo_orden id_tipo_orden; Type: DEFAULT; Schema: ordenes; Owner: postgres
--

ALTER TABLE ONLY ordenes.tipo_orden ALTER COLUMN id_tipo_orden SET DEFAULT nextval('ordenes.tipo_orden_id_tipo_orden_seq'::regclass);


--
-- Name: Estado_id_estado_seq; Type: SEQUENCE SET; Schema: juego; Owner: postgres
--

SELECT pg_catalog.setval('juego."Estado_id_estado_seq"', 6, true);


--
-- Name: Inventario_id_inventario_seq; Type: SEQUENCE SET; Schema: juego; Owner: postgres
--

SELECT pg_catalog.setval('juego."Inventario_id_inventario_seq"', 21, true);


--
-- Name: Inventario_x_uso_id_inventario_uso_seq; Type: SEQUENCE SET; Schema: juego; Owner: postgres
--

SELECT pg_catalog.setval('juego."Inventario_x_uso_id_inventario_uso_seq"', 17, true);


--
-- Name: Juego_id_juego_seq; Type: SEQUENCE SET; Schema: juego; Owner: postgres
--

SELECT pg_catalog.setval('juego."Juego_id_juego_seq"', 9, true);


--
-- Name: Ordenes_id_orden_seq; Type: SEQUENCE SET; Schema: juego; Owner: postgres
--

SELECT pg_catalog.setval('juego."Ordenes_id_orden_seq"', 1, false);


--
-- Name: Permisos_id_permiso_seq; Type: SEQUENCE SET; Schema: juego; Owner: postgres
--

SELECT pg_catalog.setval('juego."Permisos_id_permiso_seq"', 4, true);


--
-- Name: Permisos_x_rol_id_permiso_rol_seq; Type: SEQUENCE SET; Schema: juego; Owner: postgres
--

SELECT pg_catalog.setval('juego."Permisos_x_rol_id_permiso_rol_seq"', 57, true);


--
-- Name: Personal_id_personal_seq; Type: SEQUENCE SET; Schema: juego; Owner: postgres
--

SELECT pg_catalog.setval('juego."Personal_id_personal_seq"', 1, false);


--
-- Name: Roles_x_juego_id_rol_seq; Type: SEQUENCE SET; Schema: juego; Owner: postgres
--

SELECT pg_catalog.setval('juego."Roles_x_juego_id_rol_seq"', 25, true);


--
-- Name: Situaciones_id_situacion_seq; Type: SEQUENCE SET; Schema: juego; Owner: postgres
--

SELECT pg_catalog.setval('juego."Situaciones_id_situacion_seq"', 29, true);


--
-- Name: Tipo_elemento_id_tipo_elemento_seq; Type: SEQUENCE SET; Schema: juego; Owner: postgres
--

SELECT pg_catalog.setval('juego."Tipo_elemento_id_tipo_elemento_seq"', 28, true);


--
-- Name: Tipo_situaciones_id_tipo_situacion_seq; Type: SEQUENCE SET; Schema: juego; Owner: postgres
--

SELECT pg_catalog.setval('juego."Tipo_situaciones_id_tipo_situacion_seq"', 14, true);


--
-- Name: Vehiculos_id_vehiculo_seq; Type: SEQUENCE SET; Schema: juego; Owner: postgres
--

SELECT pg_catalog.setval('juego."Vehiculos_id_vehiculo_seq"', 3, true);


--
-- Data for Name: biblioteca; Type: TABLE DATA; Schema: juego; Owner: postgres
--

COPY juego.biblioteca (id_archivo, nombre_archivo, peso, ruta, id_juego, nombre) FROM stdin;
19	detalles_sol.csv	0.12	C:/xampp/htdocs/cemse/biblioteca/detalles_sol.csv	3	\N
20	academia.png	224.05	C:/xampp/htdocs/cemse/biblioteca/academia.png	3	\N
22	Desert.jpg	826.11	/var/www/html/cemse/biblioteca/Desert.jpg	8	\N
23	arial.z	116.23	C:/xampp/htdocs/cemse/biblioteca/arial.z	8	\N
24	921517_Situaciones_494_614_1542140680287.png	318.08	C:/xampp/htdocs/cemse/biblioteca/921517_Situaciones_494_614_1542140680287.png	8	Imagen de prueba
\.


--
-- Name: biblioteca_id_archivo_seq; Type: SEQUENCE SET; Schema: juego; Owner: postgres
--

SELECT pg_catalog.setval('juego.biblioteca_id_archivo_seq', 24, true);


--
-- Data for Name: estado; Type: TABLE DATA; Schema: juego; Owner: postgres
--

COPY juego.estado (id_estado, estado) FROM stdin;
1	Creado
2	Iniciado
3	Terminado
4	Cancelado
5	Eliminado
\.


--
-- Data for Name: iconos; Type: TABLE DATA; Schema: juego; Owner: postgres
--

COPY juego.iconos (id_iconos, icono) FROM stdin;
1	1
2	2
3	3
4	1
5	1
6	1
7	1
8	1
9	1
10	1
11	1
13	1
14	1
15	1
16	1
17	1
18	1
19	1
12	1
20	1
21	1
22	1
23	1
24	1
25	1
26	1
27	1
28	1
29	1
30	1
31	1
\.


--
-- Name: iconos_id_iconos_seq; Type: SEQUENCE SET; Schema: juego; Owner: postgres
--

SELECT pg_catalog.setval('juego.iconos_id_iconos_seq', 31, true);


--
-- Data for Name: inventario; Type: TABLE DATA; Schema: juego; Owner: postgres
--

COPY juego.inventario (id_inventario, id_rol_propietario, id_vehiculo, cantidad, geom, lat, lon, disponible, elemento) FROM stdin;
2	13	\N	4	\N	\N	\N	\N	\N
3	13	1	3	\N	\N	\N	\N	\N
4	\N	\N	4	0101000020110F0000F813FAE05DF85DC11062511E2F9D4EC1	-4012638.23685861379	-7856503.51526354998	\N	\N
5	\N	1	4	0101000020110F0000AC37D34815345EC120D82C06E85F4CC1	-3719120.04824353755	-7917653.13789169118	\N	\N
7	14	\N	3	0101000020110F00005AFC9AB2056B5EC138F70ABDA01950C1	-4220546.95379429311	-7973910.79070957936	\N	\N
8	13	1	3	0101000020110F0000CE7A80EEECD65DC120B9ED0C2EC84EC1	-4034652.10100473464	-7822259.72659177892	\N	\N
6	13	1	6	0101000020110F00002EE7DBC778365EC118791B08215B4CC1	-3716674.06333841011	-7920099.12279681675	0	\N
9	13	\N	15	0101000020110F000058CB776F89D45DC108000B9836704DC1	-3858541.18783569708	-7819813.74168666452	7	\N
10	13	1	10	0101000020110F000020CAA7CD23285EC1B0316938B2E34BC1	-3655524.44071026891	-7905423.21336606145	0	\N
11	23	\N	40	\N	\N	\N	40	\N
12	24	1	2	0101000020110F000016897500922D5EC1A8032A325E634FC1	-4114108.39190717414	-7910984.00717379712	1	\N
14	24	2	6	0101000020110F000036A5FEC306405EC130B04E74994F4BC1	-3579698.90865137428	-7929883.06241731904	6	\N
15	24	\N	16	\N	\N	\N	16	\N
16	24	\N	16	0101000020110F0000F055D7E4CFEE5DC140CD826EEE5D4BC1	-3587036.86336675286	-7846719.57564304769	16	\N
17	24	\N	20	0101000020110F000036A5FEC306405EC1386E717027594BC1	-3584590.87846162543	-7929883.06241731904	20	\N
18	24	\N	21	0101000020110F000036C232BE5B4E5EC14CDB53D8E4B051C1	-4637587.38011820242	-7944558.97184806131	11	2
13	24	2	2	0101000020110F00008E9E5956A4125EC13865D2D792E047C1	-3129637.68610825762	-7883409.34921993129	0	\N
19	24	\N	10	0101000020110F0000B093AFBEAA105DC1181A0A0A5A564CC1	-3714228.0784332864	-7619242.97946636379	5	2
21	24	\N	15	0101000020110F0000F4B4E8E296F35DC1003C7E8B45164BC1	-3550347.0897898674	-7851611.54545329884	15	3
20	24	\N	12	\N	\N	\N	0	3
\.


--
-- Data for Name: inventario_x_uso; Type: TABLE DATA; Schema: juego; Owner: postgres
--

COPY juego.inventario_x_uso (id_inventario_uso, id_inventario, id_recorrido, hora_salida, hora_llegada, id_estado, id_juego, geom, cantidad) FROM stdin;
12	12	11	2018-11-14 11:41:22	2018-11-14 13:05:15	3	8	0101000020110F0000DBBB01B9120C5EC1330FB3FE2C5B49C1	5
17	13	11	\N	\N	1	8	\N	2
2	6	8	2018-11-07 05:56:11	2018-11-07 09:58:53	4	3	0101000020110F00008FD204AE1ED85DC1A368F68B91CA4EC1	34
4	6	2	\N	\N	4	\N	\N	5
3	6	7	2018-11-10 06:39:43	2018-11-10 09:13:23	3	\N	0101000020110F00007581255C4F045EC12C22A0F56E144EC1	6
1	6	7	2018-11-10 06:39:43	2018-11-10 09:13:23	3	3	0101000020110F00007581255C4F045EC12C22A0F56E144EC1	8
5	6	7	2018-11-10 06:39:43	2018-11-10 09:13:23	3	\N	0101000020110F00007581255C4F045EC12C22A0F56E144EC1	7
6	9	7	2018-11-10 06:39:43	2018-11-10 09:13:23	3	\N	0101000020110F00007581255C4F045EC12C22A0F56E144EC1	9
7	9	7	2018-11-10 06:39:43	2018-11-10 09:13:23	3	\N	0101000020110F00007581255C4F045EC12C22A0F56E144EC1	6
10	10	7	2018-11-10 06:39:43	2018-11-10 09:13:23	3	\N	0101000020110F00007581255C4F045EC12C22A0F56E144EC1	4
11	10	10	2018-11-10 07:08:05	2018-11-10 09:13:23	3	\N	0101000020110F00004990B34193F65DC1D6635C1D94264CC1	1
9	10	9	2018-11-10 06:39:57	2018-11-10 09:13:23	2	\N	0101000020110F0000412DF9C1E1395EC15B248051EB1F4DC1	4
8	9	9	2018-11-10 06:39:57	2018-11-10 09:13:23	2	\N	0101000020110F0000412DF9C1E1395EC15B248051EB1F4DC1	5
14	13	13	2018-11-16 13:27:07	2018-11-21 17:55:17	3	\N	0101000020110F0000CA1B6FF025D25DC1B865671CF9AF49C1	8
15	\N	\N	\N	\N	1	\N	\N	9
16	\N	\N	\N	\N	1	\N	\N	6
13	13	12	2018-11-15 12:49:46	2018-11-16 13:20:25	4	\N	0101000020110F00008B80C92203435EC11062F736C8AA4AC1	2
\.


--
-- Data for Name: juego; Type: TABLE DATA; Schema: juego; Owner: postgres
--

COPY juego.juego (id_juego, descripcion, hora_inicio, hora_fin, id_estado, nombre, created_at, h_tactica, mapid, id_situaciones, id_recorridos, id_movimiento) FROM stdin;
1	juego de prueba	\N	\N	1	prueba1	2018-09-06 17:09:58.31029	3	\N	\N	\N	\N
7	Este juego de simulación estará centrado en las ciudades costeras de la quinta región de Chile.	\N	\N	5	Juego 2	2018-09-25 12:00:11.240399	0	\N	\N	\N	\N
2	juego de prueba	\N	\N	3	prueba1	2018-09-06 17:11:40.057832	0	\N	\N	\N	\N
8	EJERCICIO DE COMPROBACION DE PLANIFICACION DE CUARTELES DE EMERGENCIA	\N	\N	2	TORMENTA	2018-11-14 10:51:24.071205	2	921517	2496381	2512185	2507330
3	juego	\N	\N	4	nuevo	2018-09-06 17:12:56.5155	22	\N	\N	\N	\N
9	Juego de prueba	\N	\N	1	Prueba	2018-11-19 14:14:48.920514	0	123144124	324124	3241324	512453
\.


--
-- Data for Name: lineas; Type: TABLE DATA; Schema: juego; Owner: postgres
--

COPY juego.lineas (id_recorrido, geom, nombre_recorrido, distancia, id_juego, id_rol) FROM stdin;
14	0102000020110F000003000000B54DEE6CEE295EC190710189325B4EC1DBBB01B9120C5EC1D845795D26504EC12E1B871FF3FB5DC1B17854133B694EC1	prueba	\N	3	\N
11	0102000020110F00000A000000BD0B11697C335EC118EFF6EFD91D4AC19779B04C872A5EC18C22BA76210D4AC1F19658AFF5235EC1AFEFDEC00CF449C1895C7C52321C5EC15D0DFB8B94D849C107AD73D3CE195EC189DA1FD67FBF49C14755EF139D185EC137B65E9D95AD49C1829E5956A4125EC1217CF6A8EB9049C17D3F4858DD0D5EC18950A8316C7B49C1DBBB01B9120C5EC17BD46239506849C1DBBB01B9120C5EC1330FB3FE2C5B49C1	serena-vallenar	110149.643092668994	8	\N
3	0102000020110F000006000000081B4D6B66065EC11B056CFB19064EC1F7302EDBB2065EC1F0A52049C60B4EC13E4EB9E35A055EC123C38EF7A70F4EC156ADE73BE8045EC17B134CC4B7174EC1BB9EB064F7025EC121F6A361491E4EC113A65AFD52015EC12155B55F10234EC1	chicureo	16365.6064137590001	3	\N
10	0102000020110F000007000000339EE5ED8A275EC1E1F05BD6A5994BC1C904F892001B5EC17C7BBB4BECB34BC1EAD835B3671A5EC194B5234096D04BC120C38EF7A70F5EC16FA621F238F34BC1CF9ECDBEBDFD5DC1B8CAE22A23054CC1E8B4E8E296F35DC1CDE7162578134CC14990B34193F65DC1D6635C1D94264CC1	\N	97643.3869634719013	3	\N
9	0102000020110F00000700000015CAA7CD23285EC11EE171B715E64BC1829E5956A4125EC1CDE7162578134CC1E0F6C5E608EA5DC163A399DD3AC44CC15372230EF2265EC18CFA35CC39EF4CC1700B9D0063485EC1D3A86EA937454DC1A7F5F544A33D5EC12AD3EC7E51AE4DC1FB78C87B54545EC1DC38A3EA7AE04DC1	Combarbala - Valpo	343086.697350230999	3	\N
8	0102000020110F000005000000D9803D8B1C2E5EC104BE2D94C4794DC1AB6B7EA08FF95DC194E97B0B448F4DC11940302910E45DC155899A6B17DE4DC10E23FC2EBBD55DC1340410C2CD444EC18FD204AE1ED85DC1A368F68B91CA4EC1	la ligua - rancagua	224027.325597096002	3	\N
7	0102000020110F00000E000000F819B77D8D4F5EC1F6268DF038BF4EC1D087566198465EC1D1942CD443B64EC119BBDF3353405EC184115A9D929F4EC17B96AA924F435EC156C1D6840F8D4EC1E59D7185713C5EC1732FEAD0336F4EC178379994883E5EC1DEA48A5BED544EC1F6879015253C5EC10C30D2A166454EC19F37D34815345EC1C30B11697C334EC177A5722C202B5EC159D1340CB92B4EC19779B04C872A5EC16EE74F3092214EC143F6DD15D6135EC13AFDF6EB512C4EC18D2967E8900D5EC1D2630991C71F4EC1659706CC9B045EC16A292D3404184EC17581255C4F045EC12C22A0F56E144EC1	san pedro - santiago	144642.162453464989	3	\N
2	0102000020110F000010000000A3F66ED8B5F95DC1084C70AEE29C4EC14EEFC43F5AFB5DC10CED5EB01B984EC1A95580D67CFE5DC16F69181151964EC159C3E505FBFF5DC1062F3CB48D8E4EC12390798D06015EC1EC86FA274C854EC1BB9EB064F7025EC1FF9C154C257B4EC1856B44EC02045EC18D781A5FAE734EC1C313C02CD1025EC1253E3E02EB6B4EC10B314B3579015EC1493E78B677614EC113A65AFD52015EC10337EB77E25D4EC1753812289BFA5DC1749DC368CB5B4EC1E7FDFB164BFD5DC10C30D2A166454EC18DE053B4DC035EC1C5284563D1414EC11B1B6AC52C015EC18F4DB4B861344EC1659706CC9B045EC1E0DF4E89E3324EC1659706CC9B045EC1D9803D8B1C2E4EC1	paine - santiago	75660.5754543134972	3	\N
12	0102000020110F0000080000002546EDC53F3B5EC11B513D76D24A4BC12AA5FEC306405EC170EB860AA9184BC119BBDF3353405EC12A85E8CD4C104BC17B96AA924F435EC1A117BD525B044BC109D1C0A39F405EC11F028AFFB4E44AC1DA1264F384415EC174A3EC6907CB4AC18B80C92203435EC17B9CD3938BB24AC18B80C92203435EC11062F736C8AA4AC1	Ovalle - la serena	83491.7315681382024	8	\N
13	0102000020110F00000A0000009BEF38A873E65DC1B83AAEE9DF694BC18C73F3AF57D35DC1E6DC6C8D7E114BC159E8AB69DEE25DC1BE689CA42AD84AC13B4F32776DC15DC1A74B68AAD5C94AC1D838A3EA7AE05DC178D797C181904AC177989CB974BB5DC15BDF0CD1496A4AC11940302910E45DC13AE781E011444AC10665D9322DCC5DC18C22BA76210D4AC16DC30260C1FA5DC1E4BC030BF8DA49C1CA1B6FF025D25DC1B865671CF9AF49C1	Probando cache	388094.745125412999	8	\N
\.


--
-- Name: lineas_id_seq; Type: SEQUENCE SET; Schema: juego; Owner: postgres
--

SELECT pg_catalog.setval('juego.lineas_id_seq', 14, true);


--
-- Data for Name: materiales; Type: TABLE DATA; Schema: juego; Owner: postgres
--

COPY juego.materiales (id_material, material, activo) FROM stdin;
1	Pala	f
2	Voluntario	t
3	Paramedicos	t
\.


--
-- Name: materiales_id_material_seq; Type: SEQUENCE SET; Schema: juego; Owner: postgres
--

SELECT pg_catalog.setval('juego.materiales_id_material_seq', 3, true);


--
-- Data for Name: ordenes; Type: TABLE DATA; Schema: juego; Owner: postgres
--

COPY juego.ordenes (id_orden, nombre, id_rol, ruta) FROM stdin;
\.


--
-- Data for Name: permisos; Type: TABLE DATA; Schema: juego; Owner: postgres
--

COPY juego.permisos (id_permiso, descripcion) FROM stdin;
1	Mensajeria
2	Ordenes
3	Situaciones
\.


--
-- Data for Name: permisos_x_rol; Type: TABLE DATA; Schema: juego; Owner: postgres
--

COPY juego.permisos_x_rol (id_permiso_rol, id_rol, id_permiso) FROM stdin;
20	13	1
22	13	3
23	14	2
24	14	3
25	15	1
26	15	2
27	15	3
28	16	1
29	16	2
30	16	3
31	17	1
32	17	2
33	17	3
34	18	1
35	18	2
36	18	3
37	19	1
38	19	2
39	19	3
40	20	1
41	20	2
42	20	3
43	21	1
44	21	2
45	21	3
46	22	1
47	22	2
48	22	3
49	23	1
50	23	2
51	23	3
52	24	1
53	24	2
54	24	3
55	25	1
56	25	2
57	25	3
\.


--
-- Data for Name: personal; Type: TABLE DATA; Schema: juego; Owner: postgres
--

COPY juego.personal (id_personal, "Descripcion", geometry) FROM stdin;
\.


--
-- Data for Name: roles_x_juego; Type: TABLE DATA; Schema: juego; Owner: postgres
--

COPY juego.roles_x_juego (id_rol, nombre_rol, id_juego, id_usuario, director) FROM stdin;
14	bombero	3	131973934	f
13	director	3	131973934	t
16	prueba_1	1	131973934	f
15	jesus	3	131973934	f
17	Director	1	131973934	t
18	Alcalde	1	262585395	\N
19	Alcalde	7	132659567	\N
20	Bomberos	7	132659567	\N
21	Carabineros	7	131973934	\N
22	SAMU	7	131973934	\N
23	Jefe de bomberos	8	123452343	\N
24	Jefe de la defensa civil	8	123452343	\N
25	Director	8	123452343	t
\.


--
-- Data for Name: situaciones; Type: TABLE DATA; Schema: juego; Owner: postgres
--

COPY juego.situaciones (id_situacion, id_juego, nombre, id_tipo_situacion, id_estado, fecha, ruta, descripcion, lat, lon, geom) FROM stdin;
25	3	Volcan	5	1	2018-10-05 15:41:00	foto34.jpg	erupcion en volcan	-4010803.74817973748	-7927437.07751214504	\N
26	3	Prueba1	4	2	\N	foto35.jpg	dawsda	-3933755.22366828099	-7871179.42469425499	0101000020110F0000D0302EDBB2065EC18829A19C1D034EC1
27	3	acdsad	7	3	\N	foto36.jpg	dsaasdsa	-3955601.88181505725	-7868784.79591754638	0101000020110F00002650F0325C045EC1D850DFF0C82D4EC1
28	3	wdasdsada	2	2	\N	apostilla_jesusMartinez2.jpg	dasdas	-3905626.39725935832	-7896250.76997183077	0101000020110F0000EE3747B12E1F5EC10865D9322DCC4DC1
29	8	ALUVION	2	1	2021-11-30 12:02:00	Penguins.jpg	ALUVION	-3587132.40965209901	-7837700.00630538538	0101000020110F0000B44E670001E65DC1E07A6F341E5E4BC1
\.


--
-- Data for Name: tipo_elemento; Type: TABLE DATA; Schema: juego; Owner: postgres
--

COPY juego.tipo_elemento (id_tipo_elemento, tipo_elemento, descripcion) FROM stdin;
1	Vehículo de tracción animal	Vehículo arrastrado por animales.
2	Bicicleta	Es el ciclo de dos ruedas.
3	Ciclomotor	Vehículo de dos o tres ruedas provisto de un motor de cilindrada no superior a 50 cm3, si es de combustión interna, y con una velocidad máxima por construcción no superior a 45 km/h. Vehículo de cuatro ruedas cuya masa en vacío sea inferior a 350 kg no incluida la masa de las baterías en el caso de los vehículos eléctricos, cuya velocidad máxima por construcción no sea superior a 45 km/h y con un motor de cilindrada inferior o igual a 50 cm3 para los motores de combustión interna, o cuya potencia máxima neta sea inferior o igual a 4 kW para los demás tipos de motores.
4	Motocicleta	Automóvil de dos ruedas o con sidecar.
5	\tMotocarro	Vehículo de tres ruedas dotado de caja o plataforma para el transporte de cosas.
6	Automóvil de tres ruedas	\tVehículo de tres ruedas y cuatriciclos.
7	Quad-Atv	Vehículo de cuatro ó más ruedas fabricado para usos específicos muy concretos, con utilización fundamentalmente fuera de carretera, con sistema de dirección mediante manillar en el que el conductor va sentado a horcajadas y dotado de un sistema de tracción adecuado al uso fuera de carretera y cuya velocidad puede estar limitada en función de sus características técnicas o uso.
8	Autobús o autocar MMA 3.500 kg	Automóvil concebido y construido para el transporte de más de 9 personas incluido el conductor, cuya masa máxima autorizada no exceda de 3.500 kg.
9	Camión MMA 3.500 kg	El que posee una cabina con capacidad hasta 9 plazas, no integrada en resto de la carrocería, y cuya masa máxima autorizada no exceda de 3.500 kg.
10	Furgón/Furgoneta MMA 3.500 kg 	Automóvil destinado al transporte de mercancías cuya cabina está integrada en el resto de la carrocería con masa máxima autorizada igual o inferior a 3.500 kg.
11	\tVehículo mixto adaptable	Automóvil especialmente dispuesto para el transporte, simultáneo o no, de mercancías y personas hasta un máximo de 9 incluido el conductor, y en el que se puede sustituir eventualmente la carga, parcial o totalmente, por personas mediante la adición de asiento.
12	Tractor agrícola	Vehículo especial autopropulsado, de dos o más ejes, concebido y construido para arrastrar o empujar aperos, maquinaria o remolques agrícolas.
13	Tractocarro	Vehículo especial autopropulsado de dos o más ejes, especialmente concebido para el transporte en campo de productos agrícolas.
14	\tAutobús o autocar < = 3.500 Kgr.	Automóvil concebido y construído para el transporte de más de 9 personas incluído el conductor, cuya masa máxima autorizada no exceda de 3.500 Kgr.
15	Autobús o autocar articulado	El compuesto por dos secciones rígidas unidas por otra articulada que las comunica.
16	Trolebús	Automóvil destinado al transporte de personas con capacidad para 10, o más plazas, incluido el conductor, accionado por motor eléctrico con toma de corriente por trole, que circula por carriles.
17	Autobús o autocar de dos pisos	Autobús o autocar en el que los espacios destinados a los pasajeros están dispuestos, al menos parcialmente, en dos niveles superpuestos, de los cuales el superior no dispone de plazas sin asiento.
18	Camión 3.500 kg <MMA 12.000 kg	El que posee una cabina con capacidad hasta 9 plazas, no integrada en resto de la carrocería, y cuya masa máxima autorizada es superior a 3.500 kg. e igual o inferior a 12.000 kg.
19	Camión MMA > 12.000 kg	El que posee una cabina con capacidad hasta 9 plazas, no integrada en resto de la carrocería, y cuya masa máxima autorizada sea superior a 12.000 kg.
20	Tractocamión	Automóvil para realizar principalmente el arrastre de un semirremolque.
21	Furgón 3.500 Kgrs<MMA<=12.000 Kgrs.	Camión el el que la cabina está integrada en el resto de la carrocería, con masa máxima autorizada superior a 3.500 Kgrs.e igual o inferior a 12.000 Kgrs.
22	Furgón MMA>12.000 Kgrs.	Camión el el que la cabina está integrada en el resto de la carrocería, y cuya masa máxima autorizada sea superior a 12.000 Kgrs.
23	Extractor de fangos	Vehículo dotado de una bomba de absorción para la limpieza de pozos negros y alcantarillas.
28	Barredora	\tVehículo para barrer carreteras y calles de poblaciones.
24	Autobomba	Vehículo equipado con una autobomba de presión para movimiento de materiales fluidificados.
25	Grupo electrógeno	Vehículo dotado con los elementos necesarios para la producción de energía eléctrica.
26	Compresor	Vehículo destinado a producir aire comprimido y transmitirlo a diversas herramientas o a locales con ambiente enrarecido.
27	Carretilla transportadora elevadora	Vehículo provísto de pequeña grúa u horquilla-plataforma para transportar o elevar pequeñas cargas en recorridos generalmente cortos.
\.


--
-- Data for Name: tipo_situaciones; Type: TABLE DATA; Schema: juego; Owner: postgres
--

COPY juego.tipo_situaciones (id_tipo_situacion, tipo_situacion) FROM stdin;
2	Sismo
1	Incendio
3	Artefactos Explosivos
4	Inundación
5	Erupción Volcánica
6	Temporales/marejadas
7	Deslizamiento
8	Aluvión
9	Terremoto
10	Tsunami
11	Sequía
12	Lluvia
13	Incendio Forestal
14	Maremoto
\.


--
-- Data for Name: unidades; Type: TABLE DATA; Schema: juego; Owner: postgres
--

COPY juego.unidades (id_unidad, unidad) FROM stdin;
1	Litros
2	Metros Cúbicos
3	Personas
4	Kilogramos
5	Toneladas
\.


--
-- Name: unidades_id_unidades_seq; Type: SEQUENCE SET; Schema: juego; Owner: postgres
--

SELECT pg_catalog.setval('juego.unidades_id_unidades_seq', 5, true);


--
-- Data for Name: unidades_inventario; Type: TABLE DATA; Schema: juego; Owner: postgres
--

COPY juego.unidades_inventario (id_unidad, id_inventario_uso, id_material, cantidad) FROM stdin;
1	12	2	5
2	\N	18	3
3	\N	18	3
4	12	18	3
8	12	18	10
9	12	18	10
10	17	19	5
11	17	20	12
\.


--
-- Name: unidades_inventario_id_unidad_seq; Type: SEQUENCE SET; Schema: juego; Owner: postgres
--

SELECT pg_catalog.setval('juego.unidades_inventario_id_unidad_seq', 11, true);


--
-- Data for Name: usuarios_x_juego; Type: TABLE DATA; Schema: juego; Owner: postgres
--

COPY juego.usuarios_x_juego (id_usuario_juego, id_juego, id_usuario) FROM stdin;
18	3	131973934
19	3	262585395
20	3	999999999
21	1	131973934
22	1	262585395
23	7	131973934
24	7	132659567
25	8	123452343
\.


--
-- Name: usuarios_x_juego_id_usuario_juego_seq; Type: SEQUENCE SET; Schema: juego; Owner: postgres
--

SELECT pg_catalog.setval('juego.usuarios_x_juego_id_usuario_juego_seq', 25, true);


--
-- Data for Name: vehiculos; Type: TABLE DATA; Schema: juego; Owner: postgres
--

COPY juego.vehiculos (id_vehiculo, id_tipo_elemento, nombre, marca, descripcion, geometry, capacidad, id_unidad, id_icono, modelo, velocidad) FROM stdin;
1	17	Autobus Corto	Dodge	vehiculo de prueba	\N	32	3	2	Ram	80
2	21	ACTROS 3000	MB	CAMION DE TRANSPOTE TIPO A	\N	40	3	14	ACTROS 3000	40
3	19	camion de prueba	dodge	\N	\N	3000	2	3	Dop	80
\.


--
-- Name: Adjuntos_id_adjunto_seq; Type: SEQUENCE SET; Schema: mensajeria; Owner: postgres
--

SELECT pg_catalog.setval('mensajeria."Adjuntos_id_adjunto_seq"', 4, true);


--
-- Name: Estado_id_estado_seq; Type: SEQUENCE SET; Schema: mensajeria; Owner: postgres
--

SELECT pg_catalog.setval('mensajeria."Estado_id_estado_seq"', 2, true);


--
-- Name: Mensaje_id_mensaje_seq; Type: SEQUENCE SET; Schema: mensajeria; Owner: postgres
--

SELECT pg_catalog.setval('mensajeria."Mensaje_id_mensaje_seq"', 26, true);


--
-- Name: Usuarios_id_usuarios_seq; Type: SEQUENCE SET; Schema: mensajeria; Owner: postgres
--

SELECT pg_catalog.setval('mensajeria."Usuarios_id_usuarios_seq"', 42, true);


--
-- Data for Name: adjuntos; Type: TABLE DATA; Schema: mensajeria; Owner: postgres
--

COPY mensajeria.adjuntos (id_adjunto, id_mensaje, ruta) FROM stdin;
4	2	dasdsa
\.


--
-- Data for Name: estado; Type: TABLE DATA; Schema: mensajeria; Owner: postgres
--

COPY mensajeria.estado (id_estado, estado) FROM stdin;
1	Leído
2	No Leído
\.


--
-- Data for Name: mensaje; Type: TABLE DATA; Schema: mensajeria; Owner: postgres
--

COPY mensajeria.mensaje (id_mensaje, asunto, mensaje, fecha, id_estado, remitente, id_juego, id_situacion, adjunto) FROM stdin;
2	probando	esto es una prueba	2018-10-09 13:19:05.665612	2	13	3	\N	\N
3	prueba	esto es una <b>prueba</b>	2018-10-10 14:44:13.884754	1	13	3	\N	\N
5	prueba	esto es una <b>prueba</b>	2018-10-10 14:45:06.889066	2	13	3	\N	\N
4	prueba	esto es una <b>prueba</b>	2018-10-10 14:44:26.122254	2	13	3	\N	\N
6	saludo	<p><u style="font-size: 1em;">hola </u><b style="font-size: 1em;">espero estés <strike>bien</strike></b></p>	2018-10-10 14:59:10.486249	2	13	3	27	\N
7	prueba situacion	prueba	2018-10-10 17:52:48.63589	2	14	3	\N	\N
8	prueba situacion 2	dawdwa	2018-10-10 17:54:54.73698	2	13	3	25	\N
9	prueba situacion 2	dwasdsa	2018-09-11 17:21:50	1	13	3	\N	\N
11	otra prueba	dsadasas	2018-10-12 04:34:42	1	13	3	25	\N
10	prueba de hora tactica	dasdas	2018-10-11 17:33:34	2	13	3	27	\N
12	orden de prueba	esto es una orden de prueba	2018-11-09 09:19:29	1	13	3	\N	\N
13	orden de prueba 1	<blockquote style="text-align: center;">mensaje <strong>estatico</strong></blockquote>	2018-11-09 09:24:31	1	13	3	\N	\N
14	orden de prueba 1	<blockquote style="text-align: center;">mensaje <strong>estatico</strong></blockquote>	2018-11-09 09:25:26	1	13	3	\N	\N
16	orden de prueba 2	<p>mensaje </p><del>estatico</del>	2018-11-09 09:26:29	1	13	3	25	\N
17	orden de prueba 2	<p>mensaje </p><del>estatico</del>	2018-11-09 09:26:29	1	13	3	25	\N
15	orden de prueba 2	<p>mensaje </p><del>estatico</del>	2018-11-09 09:26:29	2	13	3	25	\N
18	galvarino gallardo	texto de relleno	2018-11-09 13:19:13	2	13	3	25	\N
19	envio orden frago	adjunto lo solicitado	2018-11-10 06:59:54	2	13	3	25	\N
20	INFORMA SITUACION	hola !	2018-11-14 12:49:58	2	24	8	29	\N
23	otra prueba	dasdfasf	2018-11-20 17:45:03	1	24	8	29	\N
24	prueba situacion	czczxc	2018-11-20 17:46:22	2	24	8	29	\N
21	correo de prueba	hi	2018-11-15 12:43:07	2	24	8	29	\N
22	prueba situacion 2	dasdadw	2018-11-20 17:43:21	2	24	8	29	\N
25	prueba de hora tactica	dasdsa	2018-11-20 17:51:41	2	24	8	29	921517_Situaciones_3318_1230_1542134457603.png
26	prueba situacion 2	qwqeq	2018-11-23 12:41:19	1	24	8	29	Captura1.PNG
\.


--
-- Data for Name: receptores; Type: TABLE DATA; Schema: mensajeria; Owner: postgres
--

COPY mensajeria.receptores (id_usuarios, id_mensaje, id_rol, id_estado) FROM stdin;
3	2	13	1
4	2	14	1
5	4	14	1
6	4	13	1
7	4	15	1
8	5	14	1
9	5	13	1
10	5	15	1
11	6	14	1
12	7	13	1
13	8	13	1
14	9	13	1
15	10	13	1
16	11	15	1
17	12	14	1
18	12	15	1
19	13	14	1
20	13	15	1
21	14	14	1
22	14	15	1
23	15	14	1
24	15	13	1
25	15	15	1
26	16	14	1
27	16	13	1
28	16	15	1
29	17	14	1
30	17	13	1
31	17	15	1
32	18	15	1
33	19	15	1
34	20	23	1
36	21	23	1
40	24	24	2
35	20	24	2
38	22	23	2
39	23	24	2
41	25	24	2
37	21	24	2
42	26	24	2
\.


--
-- Name: apreciacion_id_orden_seq; Type: SEQUENCE SET; Schema: ordenes; Owner: postgres
--

SELECT pg_catalog.setval('ordenes.apreciacion_id_orden_seq', 29, true);


--
-- Data for Name: compartidas; Type: TABLE DATA; Schema: ordenes; Owner: postgres
--

COPY ordenes.compartidas (id_compartido, id_rol, id_orden, id_mensaje) FROM stdin;
1	14	2	\N
2	13	2	\N
3	15	2	\N
9	15	3	15
8	13	3	15
7	14	3	15
6	15	4	15
5	13	4	15
4	14	4	15
10	15	3	18
11	15	2	18
12	15	13	19
13	23	27	21
14	24	27	21
15	24	27	26
\.


--
-- Name: compartidas_id_compartido_seq; Type: SEQUENCE SET; Schema: ordenes; Owner: postgres
--

SELECT pg_catalog.setval('ordenes.compartidas_id_compartido_seq', 15, true);


--
-- Data for Name: orden; Type: TABLE DATA; Schema: ordenes; Owner: postgres
--

COPY ordenes.orden (id_orden, operacion, referencias, huso, mision, situacion, cursos, analisis, comparacion, recomendaciones, id_rol, texto, del, unidad_mando, unidad_subordinada, id_tipo_orden, titulo, organizacion, apoyo, mando, ejecucion, clasificacion, al, previas, datos_ejemplar, firmas, activa, ruta) FROM stdin;
1	\N	\N	-04:00 GMT	dwadwa	\N	dwadwa	\N	awdwa	\N	\N	\N	\N	\N	\N	1	prueba	\N	\N	\N	\N	\N	\N	\N	\N	\N	t	\N
2	wad	wadaw	\N	dawd	\N	\N	\N	\N	\N	13	\N	\N	\N	\N	4	dwadwa	\N	\N	\N	\N	\N	\N	\N	\N	\N	t	\N
3	\N	probando texto	\N	\N	\N	\N	\N	\N	\N	13	\N	general	\N	\N	7	123456	\N	\N	\N	\N	prueba de unidad	cabo	prueba prueba	\N	\N	t	\N
5	darfgte	asdad	15	dasdas	\N	\N	dsadas	\N	\N	13	\N	\N	\N	\N	1	dsada	\N	\N	\N	\N	\N	\N	\N	\N	\N	t	\N
6	\N	\N	\N	\N	\N	\N	\N	\N	\N	13	\N	\N	\N	\N	1	\N	\N	\N	\N	\N	\N	\N	\N	dasddas\r\n\r\ndasdas as	dsadsadas	t	\N
7	\N	\N	\N	fedas	asdasd	\N	\N	\N	\N	13	\N	\N	\N	\N	3	\N	<p>dasd<strong>sadasdasd</strong></p>	\N	\N	\N	\N	\N	\N	\N	dwadwadwa	t	\N
8	\N	\N	\N	\N	\N	\N	\N	\N	\N	13	\N	\N	\N	\N	4	\N	\N	\N	\N	\N	\N	\N	\N	\N	dawdasdawdwa	t	\N
9	\N	dasdasdqw	\N	\N	\N	\N	\N	\N	\N	13	\N	\N	\N	\N	4	\N	\N	\N	\N	\N	\N	\N	\N	dwadas78687	dasd23123	t	\N
10	\N	\N	\N	gdfgfd	\N	\N	\N	\N	\N	13	\N	\N	\N	\N	3	\N	\N	dwadwadawgdg	fdsfsfw3	\N	\N	\N	\N	\N	\N	t	\N
12	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N
11	\N	31234	grthret	hrt	uyiktyuk	\N	\N	\N	\N	13	\N	\N	\N	\N	2	\N	\N	\N	uykktyu	\N	\N	\N	\N	dwqdqw	yukyu	f	\N
4	\N	dwqdasdsa	\N	\N	\N	\N	\N	\N	\N	13	\N	almirante	\N	\N	7	81789	\N	\N	\N	\N	primaria	capitan	dasdsa	\N	\N	f	\N
13	\N	dioasmdiuasnuas	-4:00 GMT	DESPLEGAR	SITUACIÓN DE REFERENCIA	\N	\N	\N	\N	13	\N	\N	\N	\N	4	24	\N	APOYO AL COMBATE	<ol><li>MANDO Y COMUNICACIONES<br></li><li>MANDO 2</li></ol>	EJECUCION	\N	\N	\N	DOCUMENTO REFERENCIA 24	FIRMA JESUS MARTINEZ	t	\N
27	\N	<p><span style="color: rgb(102, 102, 102); font-family: Verdana, Geneva, sans-serif; font-size: 10px;">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,</span></p>	\N	<p><span style="color: rgb(102, 102, 102); font-family: Verdana, Geneva, sans-serif; font-size: 10px;">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,</span></p>	<p><span style="color: rgb(102, 102, 102); font-family: Verdana, Geneva, sans-serif; font-size: 10px;">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,</span></p>	\N	\N	\N	\N	24	\N	\N	\N	\N	3	1	<p><span style="color: rgb(102, 102, 102); font-family: Verdana, Geneva, sans-serif; font-size: 10px;">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,</span></p>	<p><span style="color: rgb(102, 102, 102); font-family: Verdana, Geneva, sans-serif; font-size: 10px;">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,</span></p>	<p><span style="color: rgb(102, 102, 102); font-family: Verdana, Geneva, sans-serif; font-size: 10px;">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,</span></p>	<p><span style="color: rgb(102, 102, 102); font-family: Verdana, Geneva, sans-serif; font-size: 10px;">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,</span></p>	\N	\N	\N	EJEMPLAR 123/6523 Nº 12 (S)	<p>JORGE VÁSQUES ALBORNOS</p><p>MAYOR</p><p>Jefe del Centro de Modelación y Simulación del Ejercito</p>	t	\N
15	\N	\N	\N	\N	\N	\N	\N	\N	FASDASFASFASFSA	13	\N	\N	\N	\N	1	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	t	\N
16	\N	dsaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa	\N	\N	\N	\N	\N	\N	\N	13	\N	dasdasdasd	\N	\N	7	asdasdasd515	\N	\N	\N	\N	clasificacion de unidad	asdasdasdasd	<p>ffffffffffffffffffffffffff<strong><em>ffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff</em></strong>fffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff</p>	ascsadsadsaddddddddddddddddddddddddddddddddddddd	asdasdasdasdasdas	t	\N
14	operacion 	<p>qweeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeqwggwdsfasfasdfasfadsfasdfasqweeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeqwweeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeqwggwdsfasfasdfasfadsfasdfeeeeeeeeeeeeeeeeeeeeweeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeqwggwdsfasfasdeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeqwggwdsfaeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeqwggwdsfasfasdfasfqweeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeqwggwdsfasfasdfasfaeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeqwggwdsfasfasdfasfadsfasweeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeqwggwdsfasfasdfasfadsfaeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeqwggwdsfasfasdfasfeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeqwggwdsfasfaseeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeqwggwdsfasfasdfasfadsfasdeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeqwggwdsfasfasdfasfadsfasdfaqweeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeqwggwdsfasfasdfasfadsfasdfaqweeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeqwggwdsfasfasdfasfadsfasdfaqweeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeqwggwdsfasfasdfasfadsfasdfaqweeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeqwggwdsfasfasdfasfadsfasdfaqweeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeqwggwdsfasfasdfasfadsfasdfa</p>	-4:00 GMT	aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa	FFFFFFFFFFFFFFFFFFFFFFFFFFFFFADSGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGTRPIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIEWQOPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPKFSDAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAKFDSAMVFFFFFFFFFFFFFFFFFFFFFFFFFFFFFLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLERRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRFFFFFFFFFFFFFFFFFFFFFFFFFFFFFADSGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGTRPIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIEWQOPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPKFSDAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAKFDSAMVFFFFFFFFFFFFFFFFFFFFFFFFFFFFFLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLERRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRFFFFFFFFFFFFFFFFFFFFFFFFFFFFFADSGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGTRPIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIEWQOPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPKFSDAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAKFDSAMVFFFFFFFFFFFFFFFFFFFFFFFFFFFFFLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLERRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRR	hhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh	KKKKKKKKKKKKJKSRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRAFASOPDAPFASPDFASDKKKKKKKKKKKKJKSRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRAFASOPDAPFASPDFASDKKKKKKKKKKKKJKSRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRAFASOPDAPFASPDFASDKKKKKKKKKKKKJKSRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRAFASOPDAPFASPDFASDKKKKKKKKKKKKJKSRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRAFASOPDAPFASPDFASDKKKKKKKKKKKKJKSRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRAFASOPDAPFASPDFASDKKKKKKKKKKKKJKSRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRAFASOPDAPFASPDFASDKKKKKKKKKKKKJKSRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRAFASOPDAPFASPDFASDKKKKKKKKKKKKJKSRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRAFASOPDAPFASPDFASDKKKKKKKKKKKKJKSRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRAFASOPDAPFASPDFASDKKKKKKKKKKKKJKSRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRAFASOPDAPFASPDFASDKKKKKKKKKKKKJKSRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRAFASOPDAPFASPDFASDKKKKKKKKKKKKJKSRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRAFASOPDAPFASPDFASDKKKKKKKKKKKKJKSRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRAFASOPDAPFASPDFASDKKKKKKKKKKKKJKSRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRAFASOPDAPFASPDFASDKKKKKKKKKKKKJKSRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRAFASOPDAPFASPDFASDKKKKKKKKKKKKJKSRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRAFASOPDAPFASPDFASDKKKKKKKKKKKKJKSRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRAFASOPDAPFASPDFASDKKKKKKKKKKKKJKSRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRAFASOPDAPFASPDFASDKKKKKKKKKKKKJKSRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRAFASOPDAPFASPDFASDKKKKKKKKKKKKJKSRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRAFASOPDAPFASPDFASD	QWEIUQUIDSAHIUDFIUSBFISADBIFUBASDIUGBASDGQWEIUQUIDSAHIUDFIUSBFISADBIFUBASDIUGBASDGQWEIUQUIDSAHIUDFIUSBFISADBIFUBASDIUGBASDGQWEIUQUIDSAHIUDFIUSBFISADBIFUBASDIUGBASDGQWEIUQUIDSAHIUDFIUSBFISADBIFUBASDIUGBASDGQWEIUQUIDSAHIUDFIUSBFISADBIFUBASDIUGBASDGQWEIUQUIDSAHIUDFIUSBFISADBIFUBASDIUGBASDGQWEIUQUIDSAHIUDFIUSBFISADBIFUBASDIUGBASDGQWEIUQUIDSAHIUDFIUSBFISADBIFUBASDIUGBASDGQWEIUQUIDSAHIUDFIUSBFISADBIFUBASDIUGBASDGQWEIUQUIDSAHIUDFIUSBFISADBIFUBASDIUGBASDGQWEIUQUIDSAHIUDFIUSBFISADBIFUBASDIUGBASDGQWEIUQUIDSAHIUDFIUSBFISADBIFUBASDIUGBASDGQWEIUQUIDSAHIUDFIUSBFISADBIFUBASDIUGBASDGQWEIUQUIDSAHIUDFIUSBFISADBIFUBASDIUGBASDGQWEIUQUIDSAHIUDFIUSBFISADBIFUBASDIUGBASDGQWEIUQUIDSAHIUDFIUSBFISADBIFUBASDIUGBASDGQWEIUQUIDSAHIUDFIUSBFISADBIFUBASDIUGBASDGQWEIUQUIDSAHIUDFIUSBFISADBIFUBASDIUGBASDG	DWAAAAAAAAAAAAAPAFPOSDMFPOASEMFEPOASDMFPOASMDFOPSDAOFKASPDOFKASPODFKPOARKPEOWGPWOERJTMGPOWERMHPOERWMHPOET	13	\N	\N	\N	\N	1	titulo	\N	\N	\N	\N	\N	\N	\N	<p>dasdasdawdawdawdwdwaa</p><p>dwadawdawdawdawdawd</p><p>awdawdawdawdasdas</p><p>dfsfsdfasdfsadfsadfasd</p>	<p><span style="text-align: left;">ppppppppppppppppppp</span><span style="text-align: left; font-size: 1rem;">p</span></p><p><span style="text-align: left; font-size: 1rem;">pppppppppppppppppp</span></p>	t	\N
19	\N	asdgsadgsdagsadsadg	gsadgsdagsadgsdagsadgsadg	asgdsadgsa	gadsgasdgadsgsadg	\N	\N	\N	\N	13	\N	\N	\N	\N	4	gsadgsdagsda	\N	dgssdagdsag	asdgasdg	\N	\N	\N	dasfdasfasdgasdgsadgfasgsfgds	fasdfsadgasfgsadgsda	sadgsadgdsa	t	\N
17	\N	<p>adsasdfasdgasdgdsagfasdgadsffsadfsadfasdffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffadsasdfasdgasdgdsagfasdgadsffsadfsadfasdffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffadsasdfasdgasdgdsagfasdgadsffsadfsadfasdffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffadsasdfasdgasdgdsagfasdgadsffsadfsadfasdffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffadsasdfasdgasdgdsagfasdgadsffsadfsadfasdffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffadsasdfasdgasdgdsagfasdgadsffsadfsadfasdffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffadsasdfasdgasdgdsagfasdgadsffsadfsadfasdffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffadsasdfasdgasdgdsagfasdgadsffsadfsadfasdffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff</p>	<p>adsasdfasdgasdgdsagfasdgadsffsadfsadfasdffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffadsasdfasdgasdgdsagfasdgadsffsadfsadfasdffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffadsasdfasdgasdgdsagfasdgadsffsadfsadfasdffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffadsasdfasdgasdgdsagfasdgadsffsadfsadfasdffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffadsasdfasdgasdgdsagfasdgadsffsadfsadfasdffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffadsasdfasdgasdgdsagfasdgadsffsadfsadfasdffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffadsasdfasdgasdgdsagfasdgadsffsadfsadfasdffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffadsasdfasdgasdgdsagfasdgadsffsadfsadfasdffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff</p>	\N	<p>adsasdfasdgasdgdsagfasdgadsffsadfsadfasdffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffadsasdfasdgasdgdsagfasdgadsffsadfsadfasdffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffadsasdfasdgasdgdsagfasdgadsffsadfsadfasdffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffadsasdfasdgasdgdsagfasdgadsffsadfsadfasdffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffadsasdfasdgasdgdsagfasdgadsffsadfsadfasdffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffadsasdfasdgasdgdsagfasdgadsffsadfsadfasdffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffadsasdfasdgasdgdsagfasdgadsffsadfsadfasdffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffadsasdfasdgasdgdsagfasdgadsffsadfsadfasdffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffadsasdfasdgasdgdsagfasdgadsffsadfsadfasdffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffadsasdfasdgasdgdsagfasdgadsffsadfsadfasdffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffadsasdfasdgasdgdsagfasdgadsffsadfsadfasdffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffadsasdfasdgasdgdsagfasdgadsffsadfsadfasdffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffadsasdfasdgasdgdsagfasdgadsffsadfsadfasdffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffadsasdfasdgasdgdsagfasdgadsffsadfsadfasdffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffadsasdfasdgasdgdsagfasdgadsffsadfsadfasdffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffadsasdfasdgasdgdsagfasdgadsffsadfsadfasdffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffadsasdfasdgasdgdsagfasdgadsffsadfsadfasdffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffadsasdfasdgasdgdsagfasdgadsffsadfsadfasdffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffadsasdfasdgasdgdsagfasdgadsffsadfsadfasdffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffadsasdfasdgasdgdsagfasdgadsffsadfsadfasdffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffadsasdfasdgasdgdsagfasdgadsffsadfsadfasdffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffadsasdfasdgasdgdsagfasdgadsffsadfsadfasdffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffadsasdfasdgasdgdsagfasdgadsffsadfsadfasdffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffadsasdfasdgasdgdsagfasdgadsffsadfsadfasdffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff</p>	\N	\N	\N	\N	13	\N	\N	\N	\N	4	542532	\N	\N	\N	\N	\N	\N	adsfsadfsadfasdfsdaf	dasdddddddddddddddddddddddddddddddddddd fsdaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaafffffff fasdddddddddddddddddddddddddddddddddd	<p>fasdfsa</p><p>fasdfasdf</p><p>sadfasdfasdfasdfas</p>	t	\N
18	\N	ASDDDDDDDDDDFASDPAS;DPLAPWDLAW	ASFADASD	ASDSADÑKPNASPFINAWIOEFBEIUFIUABISUFBAOUfiansdPINSPFISNAPOINFPIS	DIPASNDPIASDPMIASNFPINASOFIDNAFG	\N	\N	\N	\N	13	\N	\N	\N	\N	2	MISION SECRETA 	GGASOIDNASIDNOAISDN ASIJNMODIASNFOIASNFOIADNFOIAN	BYWRTEWRFEWFSGSDGSDFBFEDS BSFEWBNYWE EW YEWTEWTWE	SDGDSGDSGEW WGDSGDS DG SDDHF S DFSDSDG&nbsp;	ADSADAFWGQEHRTYBYBYYB	\N	\N	\N	dsaddddddddddddqwreqwfqwefqw&nbsp; fewqfqwefqweqwrrrrrr qwerwqerqwerqt trheyuyteutr rtyjutyitrirtu trkyurir	<p>DFSFSDFSD</p><p>SDFSDFSDF</p><p>sfdsfsd</p>	t	\N
20	\N	sadfsadfsad	afsdsdafsadfsdfasadf	\N	fadsasdfasdfsda	\N	\N	\N	\N	13	\N	\N	\N	\N	3	fasdfsadfasdf	\N	\N	\N	\N	\N	\N	dasdasdawadasdasda	dasdasdasfdsafasf	\N	t	\N
21	\N	<p>dasdasdawdwa</p><p>dasdasdas</p><p>dasdasd</p>	\N	<p><ol><li>dasdasd<br></li><li>dasdsadasd<br></li><li>asdasdas<br></li><li>dsad<br></li></ol></p>	\N	\N	\N	\N	\N	13	\N	12564 MAY 	\N	\N	6	asdasas	\N	\N	\N	\N	\N	56165 JUN  2014	\N	\N	dasdsad	t	\N
23	\N	adsfafaf	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	132213	\N	\N	\N	\N	\N	\N	\N	\N	dasdsa	t	921517_Situaciones_3318_1230_15421344576031.png
22	\N	adasdasfsadfasdfasd	afsdafsdagasfgdshf	\N	fdsafsadfasdfsadfsadfasdf	\N	\N	\N	\N	13	\N	\N	\N	\N	5	12321	gfjfdghgdjgkiugl	\N	\N	\N	\N	\N	\N	\N	fdsafsadfasdfas	t	921517_Situaciones_3318_1230_15421344576031.png
24	\N	dasdasdas	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	165185	dasdsadsa	\N	\N	\N	\N	\N	\N	\N	dsadasd	t	921517_Situaciones_494_614_1542140680287.png
25	\N	123123d	dsadsadas	\N	dasdsadas	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	21312321	\N	\N	\N	\N	\N	\N	\N	\N	sadasfas	t	921517_Situaciones_494_614_15421406802871.png
26	\N	dasdasd	asdad	\N	\N	\N	\N	\N	\N	13	\N	\N	\N	\N	5	213123	\N	\N	\N	\N	\N	\N	\N	\N	sdasdas	t	921517_Situaciones_494_614_15421406802872.png
28	\N	NINGUNA	\N	\N	\N	\N	\N	\N	\N	23	\N	\N	\N	\N	5	1	LOREM IPSUN	\N	\N	\N	\N	\N	\N	\N	JESUS MARTINEZ	t	921517_Situaciones_730_854_1542207638742.png
29	\N	dasdsadas	\N	\N	\N	\N	\N	\N	\N	24	\N	\N	\N	\N	3	11321	\N	\N	\N	\N	\N	\N	sdadasdasd	\N	\N	t	\N
\.


--
-- Data for Name: tipo_orden; Type: TABLE DATA; Schema: ordenes; Owner: postgres
--

COPY ordenes.tipo_orden (id_tipo_orden, tipo_orden) FROM stdin;
2	Plan u orden
1	Apreciación
3	Preparatoria (WARNO)
4	Orden Aislada (FRAGO)
5	Orden Gráfica
6	Organización de Tarea
7	Comunicación de Decisión
\.


--
-- Name: tipo_orden_id_tipo_orden_seq; Type: SEQUENCE SET; Schema: ordenes; Owner: postgres
--

SELECT pg_catalog.setval('ordenes.tipo_orden_id_tipo_orden_seq', 7, true);


--
-- Data for Name: spatial_ref_sys; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.spatial_ref_sys (srid, auth_name, auth_srid, srtext, proj4text) FROM stdin;
\.


--
-- Data for Name: us_gaz; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.us_gaz (id, seq, word, stdword, token, is_custom) FROM stdin;
\.


--
-- Data for Name: us_lex; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.us_lex (id, seq, word, stdword, token, is_custom) FROM stdin;
\.


--
-- Data for Name: us_rules; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.us_rules (id, rule, is_custom) FROM stdin;
\.


--
-- Data for Name: geocode_settings; Type: TABLE DATA; Schema: tiger; Owner: postgres
--

COPY tiger.geocode_settings (name, setting, unit, category, short_desc) FROM stdin;
\.


--
-- Data for Name: pagc_gaz; Type: TABLE DATA; Schema: tiger; Owner: postgres
--

COPY tiger.pagc_gaz (id, seq, word, stdword, token, is_custom) FROM stdin;
\.


--
-- Data for Name: pagc_lex; Type: TABLE DATA; Schema: tiger; Owner: postgres
--

COPY tiger.pagc_lex (id, seq, word, stdword, token, is_custom) FROM stdin;
\.


--
-- Data for Name: pagc_rules; Type: TABLE DATA; Schema: tiger; Owner: postgres
--

COPY tiger.pagc_rules (id, rule, is_custom) FROM stdin;
\.


--
-- Data for Name: topology; Type: TABLE DATA; Schema: topology; Owner: postgres
--

COPY topology.topology (id, name, srid, "precision", hasz) FROM stdin;
\.


--
-- Data for Name: layer; Type: TABLE DATA; Schema: topology; Owner: postgres
--

COPY topology.layer (topology_id, layer_id, schema_name, table_name, feature_column, feature_type, level, child_id) FROM stdin;
\.


--
-- Data for Name: usuario; Type: TABLE DATA; Schema: usuarios; Owner: postgres
--

COPY usuarios.usuario (id_usuario, usuario, password, nombre_apellido, created_at, last_login, is_active, administrador) FROM stdin;
262585395	jesus	a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3	jesus martinez	\N	2018-09-12 12:47:48.367891	t	f
132659567	JuanP	03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4	Juan Perez	\N	\N	t	\N
131973934	cristian	a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3	cristian higuera	\N	2018-11-13 16:27:37.70135	t	\N
999999999	admin	a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3	Administrador	2018-09-06 14:16:23.350311	2018-11-23 14:42:16.468723	t	t
123452343	rpino	11150cd8483d1bf79892c106fcda4463eec35c32eadfcc7b667887e76142e583	RICARDO NOPI	\N	2018-11-23 14:57:07.749479	t	\N
\.


--
-- Name: estado Estado_pkey; Type: CONSTRAINT; Schema: juego; Owner: postgres
--

ALTER TABLE ONLY juego.estado
    ADD CONSTRAINT "Estado_pkey" PRIMARY KEY (id_estado);


--
-- Name: inventario Inventario_pkey; Type: CONSTRAINT; Schema: juego; Owner: postgres
--

ALTER TABLE ONLY juego.inventario
    ADD CONSTRAINT "Inventario_pkey" PRIMARY KEY (id_inventario);


--
-- Name: inventario_x_uso Inventario_x_uso_pkey; Type: CONSTRAINT; Schema: juego; Owner: postgres
--

ALTER TABLE ONLY juego.inventario_x_uso
    ADD CONSTRAINT "Inventario_x_uso_pkey" PRIMARY KEY (id_inventario_uso);


--
-- Name: juego Juego_pkey; Type: CONSTRAINT; Schema: juego; Owner: postgres
--

ALTER TABLE ONLY juego.juego
    ADD CONSTRAINT "Juego_pkey" PRIMARY KEY (id_juego);


--
-- Name: ordenes Ordenes_pkey; Type: CONSTRAINT; Schema: juego; Owner: postgres
--

ALTER TABLE ONLY juego.ordenes
    ADD CONSTRAINT "Ordenes_pkey" PRIMARY KEY (id_orden);


--
-- Name: permisos Permisos_pkey; Type: CONSTRAINT; Schema: juego; Owner: postgres
--

ALTER TABLE ONLY juego.permisos
    ADD CONSTRAINT "Permisos_pkey" PRIMARY KEY (id_permiso);


--
-- Name: permisos_x_rol Permisos_x_rol_pkey; Type: CONSTRAINT; Schema: juego; Owner: postgres
--

ALTER TABLE ONLY juego.permisos_x_rol
    ADD CONSTRAINT "Permisos_x_rol_pkey" PRIMARY KEY (id_permiso_rol);


--
-- Name: personal Personal_pkey; Type: CONSTRAINT; Schema: juego; Owner: postgres
--

ALTER TABLE ONLY juego.personal
    ADD CONSTRAINT "Personal_pkey" PRIMARY KEY (id_personal);


--
-- Name: roles_x_juego Roles_x_juego_pkey; Type: CONSTRAINT; Schema: juego; Owner: postgres
--

ALTER TABLE ONLY juego.roles_x_juego
    ADD CONSTRAINT "Roles_x_juego_pkey" PRIMARY KEY (id_rol);


--
-- Name: situaciones Situaciones_pkey; Type: CONSTRAINT; Schema: juego; Owner: postgres
--

ALTER TABLE ONLY juego.situaciones
    ADD CONSTRAINT "Situaciones_pkey" PRIMARY KEY (id_situacion);


--
-- Name: tipo_elemento Tipo_elemento_pkey; Type: CONSTRAINT; Schema: juego; Owner: postgres
--

ALTER TABLE ONLY juego.tipo_elemento
    ADD CONSTRAINT "Tipo_elemento_pkey" PRIMARY KEY (id_tipo_elemento);


--
-- Name: tipo_situaciones Tipo_situaciones_pkey; Type: CONSTRAINT; Schema: juego; Owner: postgres
--

ALTER TABLE ONLY juego.tipo_situaciones
    ADD CONSTRAINT "Tipo_situaciones_pkey" PRIMARY KEY (id_tipo_situacion);


--
-- Name: vehiculos Vehiculos_pkey; Type: CONSTRAINT; Schema: juego; Owner: postgres
--

ALTER TABLE ONLY juego.vehiculos
    ADD CONSTRAINT "Vehiculos_pkey" PRIMARY KEY (id_vehiculo);


--
-- Name: biblioteca biblioteca_pkey; Type: CONSTRAINT; Schema: juego; Owner: postgres
--

ALTER TABLE ONLY juego.biblioteca
    ADD CONSTRAINT biblioteca_pkey PRIMARY KEY (id_archivo);


--
-- Name: iconos iconos_pkey; Type: CONSTRAINT; Schema: juego; Owner: postgres
--

ALTER TABLE ONLY juego.iconos
    ADD CONSTRAINT iconos_pkey PRIMARY KEY (id_iconos);


--
-- Name: lineas lineas_pkey; Type: CONSTRAINT; Schema: juego; Owner: postgres
--

ALTER TABLE ONLY juego.lineas
    ADD CONSTRAINT lineas_pkey PRIMARY KEY (id_recorrido);


--
-- Name: materiales materiales_pkey; Type: CONSTRAINT; Schema: juego; Owner: postgres
--

ALTER TABLE ONLY juego.materiales
    ADD CONSTRAINT materiales_pkey PRIMARY KEY (id_material);


--
-- Name: unidades_inventario unidades_inventario_pkey; Type: CONSTRAINT; Schema: juego; Owner: postgres
--

ALTER TABLE ONLY juego.unidades_inventario
    ADD CONSTRAINT unidades_inventario_pkey PRIMARY KEY (id_unidad);


--
-- Name: unidades unidades_pkey; Type: CONSTRAINT; Schema: juego; Owner: postgres
--

ALTER TABLE ONLY juego.unidades
    ADD CONSTRAINT unidades_pkey PRIMARY KEY (id_unidad);


--
-- Name: usuarios_x_juego usuarios_x_juego_id_juego_id_usuario_key; Type: CONSTRAINT; Schema: juego; Owner: postgres
--

ALTER TABLE ONLY juego.usuarios_x_juego
    ADD CONSTRAINT usuarios_x_juego_id_juego_id_usuario_key UNIQUE (id_juego, id_usuario);


--
-- Name: usuarios_x_juego usuarios_x_juego_pkey; Type: CONSTRAINT; Schema: juego; Owner: postgres
--

ALTER TABLE ONLY juego.usuarios_x_juego
    ADD CONSTRAINT usuarios_x_juego_pkey PRIMARY KEY (id_usuario_juego);


--
-- Name: adjuntos Adjuntos_pkey; Type: CONSTRAINT; Schema: mensajeria; Owner: postgres
--

ALTER TABLE ONLY mensajeria.adjuntos
    ADD CONSTRAINT "Adjuntos_pkey" PRIMARY KEY (id_adjunto);


--
-- Name: estado Estado_pkey; Type: CONSTRAINT; Schema: mensajeria; Owner: postgres
--

ALTER TABLE ONLY mensajeria.estado
    ADD CONSTRAINT "Estado_pkey" PRIMARY KEY (id_estado);


--
-- Name: mensaje Mensaje_pkey; Type: CONSTRAINT; Schema: mensajeria; Owner: postgres
--

ALTER TABLE ONLY mensajeria.mensaje
    ADD CONSTRAINT "Mensaje_pkey" PRIMARY KEY (id_mensaje);


--
-- Name: receptores Usuarios_pkey; Type: CONSTRAINT; Schema: mensajeria; Owner: postgres
--

ALTER TABLE ONLY mensajeria.receptores
    ADD CONSTRAINT "Usuarios_pkey" PRIMARY KEY (id_usuarios);


--
-- Name: orden apreciacion_pkey; Type: CONSTRAINT; Schema: ordenes; Owner: postgres
--

ALTER TABLE ONLY ordenes.orden
    ADD CONSTRAINT apreciacion_pkey PRIMARY KEY (id_orden);


--
-- Name: compartidas compartidas_pkey; Type: CONSTRAINT; Schema: ordenes; Owner: postgres
--

ALTER TABLE ONLY ordenes.compartidas
    ADD CONSTRAINT compartidas_pkey PRIMARY KEY (id_compartido);


--
-- Name: tipo_orden tipo_orden_pkey; Type: CONSTRAINT; Schema: ordenes; Owner: postgres
--

ALTER TABLE ONLY ordenes.tipo_orden
    ADD CONSTRAINT tipo_orden_pkey PRIMARY KEY (id_tipo_orden);


--
-- Name: usuario Usuario_pkey; Type: CONSTRAINT; Schema: usuarios; Owner: postgres
--

ALTER TABLE ONLY usuarios.usuario
    ADD CONSTRAINT "Usuario_pkey" PRIMARY KEY (id_usuario);


--
-- Name: usuario usuario_usuario_key; Type: CONSTRAINT; Schema: usuarios; Owner: postgres
--

ALTER TABLE ONLY usuarios.usuario
    ADD CONSTRAINT usuario_usuario_key UNIQUE (usuario);


--
-- Name: idx_geom_inv; Type: INDEX; Schema: juego; Owner: postgres
--

CREATE INDEX idx_geom_inv ON juego.inventario USING gist (geom);


--
-- Name: idx_id_situ; Type: INDEX; Schema: juego; Owner: postgres
--

CREATE INDEX idx_id_situ ON juego.situaciones USING gist (geom);


--
-- Name: idx_inve; Type: INDEX; Schema: juego; Owner: postgres
--

CREATE INDEX idx_inve ON juego.inventario_x_uso USING gist (geom);


--
-- Name: idx_lins; Type: INDEX; Schema: juego; Owner: postgres
--

CREATE INDEX idx_lins ON juego.lineas USING gist (geom);


--
-- Name: lineas distancia_trigger; Type: TRIGGER; Schema: juego; Owner: postgres
--

CREATE TRIGGER distancia_trigger AFTER INSERT OR UPDATE ON juego.lineas FOR EACH ROW EXECUTE PROCEDURE juego.funcion_distancia();


--
-- Name: biblioteca biblioteca_id_juego_fkey; Type: FK CONSTRAINT; Schema: juego; Owner: postgres
--

ALTER TABLE ONLY juego.biblioteca
    ADD CONSTRAINT biblioteca_id_juego_fkey FOREIGN KEY (id_juego) REFERENCES juego.juego(id_juego);


--
-- Name: inventario fk_id_elemento; Type: FK CONSTRAINT; Schema: juego; Owner: postgres
--

ALTER TABLE ONLY juego.inventario
    ADD CONSTRAINT fk_id_elemento FOREIGN KEY (id_vehiculo) REFERENCES juego.vehiculos(id_vehiculo);


--
-- Name: juego fk_id_estado; Type: FK CONSTRAINT; Schema: juego; Owner: postgres
--

ALTER TABLE ONLY juego.juego
    ADD CONSTRAINT fk_id_estado FOREIGN KEY (id_estado) REFERENCES juego.estado(id_estado);


--
-- Name: situaciones fk_id_estado; Type: FK CONSTRAINT; Schema: juego; Owner: postgres
--

ALTER TABLE ONLY juego.situaciones
    ADD CONSTRAINT fk_id_estado FOREIGN KEY (id_estado) REFERENCES juego.estado(id_estado);


--
-- Name: inventario_x_uso fk_id_inventario; Type: FK CONSTRAINT; Schema: juego; Owner: postgres
--

ALTER TABLE ONLY juego.inventario_x_uso
    ADD CONSTRAINT fk_id_inventario FOREIGN KEY (id_inventario) REFERENCES juego.inventario(id_inventario);


--
-- Name: roles_x_juego fk_id_juego; Type: FK CONSTRAINT; Schema: juego; Owner: postgres
--

ALTER TABLE ONLY juego.roles_x_juego
    ADD CONSTRAINT fk_id_juego FOREIGN KEY (id_juego) REFERENCES juego.juego(id_juego);


--
-- Name: situaciones fk_id_juego; Type: FK CONSTRAINT; Schema: juego; Owner: postgres
--

ALTER TABLE ONLY juego.situaciones
    ADD CONSTRAINT fk_id_juego FOREIGN KEY (id_juego) REFERENCES juego.juego(id_juego);


--
-- Name: inventario fk_id_rol; Type: FK CONSTRAINT; Schema: juego; Owner: postgres
--

ALTER TABLE ONLY juego.inventario
    ADD CONSTRAINT fk_id_rol FOREIGN KEY (id_rol_propietario) REFERENCES juego.roles_x_juego(id_rol);


--
-- Name: ordenes fk_id_rol; Type: FK CONSTRAINT; Schema: juego; Owner: postgres
--

ALTER TABLE ONLY juego.ordenes
    ADD CONSTRAINT fk_id_rol FOREIGN KEY (id_rol) REFERENCES juego.roles_x_juego(id_rol);


--
-- Name: permisos_x_rol fk_id_rol; Type: FK CONSTRAINT; Schema: juego; Owner: postgres
--

ALTER TABLE ONLY juego.permisos_x_rol
    ADD CONSTRAINT fk_id_rol FOREIGN KEY (id_rol) REFERENCES juego.roles_x_juego(id_rol);


--
-- Name: permisos_x_rol fk_permiso; Type: FK CONSTRAINT; Schema: juego; Owner: postgres
--

ALTER TABLE ONLY juego.permisos_x_rol
    ADD CONSTRAINT fk_permiso FOREIGN KEY (id_permiso) REFERENCES juego.permisos(id_permiso);


--
-- Name: vehiculos fk_tipo_elemento; Type: FK CONSTRAINT; Schema: juego; Owner: postgres
--

ALTER TABLE ONLY juego.vehiculos
    ADD CONSTRAINT fk_tipo_elemento FOREIGN KEY (id_tipo_elemento) REFERENCES juego.tipo_elemento(id_tipo_elemento);


--
-- Name: situaciones fk_tipo_situacion; Type: FK CONSTRAINT; Schema: juego; Owner: postgres
--

ALTER TABLE ONLY juego.situaciones
    ADD CONSTRAINT fk_tipo_situacion FOREIGN KEY (id_tipo_situacion) REFERENCES juego.tipo_situaciones(id_tipo_situacion);


--
-- Name: inventario inventario_elemento_fkey; Type: FK CONSTRAINT; Schema: juego; Owner: postgres
--

ALTER TABLE ONLY juego.inventario
    ADD CONSTRAINT inventario_elemento_fkey FOREIGN KEY (elemento) REFERENCES juego.materiales(id_material);


--
-- Name: inventario_x_uso inventario_x_uso_id_estado_fkey; Type: FK CONSTRAINT; Schema: juego; Owner: postgres
--

ALTER TABLE ONLY juego.inventario_x_uso
    ADD CONSTRAINT inventario_x_uso_id_estado_fkey FOREIGN KEY (id_estado) REFERENCES juego.estado(id_estado);


--
-- Name: inventario_x_uso inventario_x_uso_id_juego_fkey; Type: FK CONSTRAINT; Schema: juego; Owner: postgres
--

ALTER TABLE ONLY juego.inventario_x_uso
    ADD CONSTRAINT inventario_x_uso_id_juego_fkey FOREIGN KEY (id_juego) REFERENCES juego.juego(id_juego);


--
-- Name: inventario_x_uso inventario_x_uso_id_recorrido_fkey; Type: FK CONSTRAINT; Schema: juego; Owner: postgres
--

ALTER TABLE ONLY juego.inventario_x_uso
    ADD CONSTRAINT inventario_x_uso_id_recorrido_fkey FOREIGN KEY (id_recorrido) REFERENCES juego.lineas(id_recorrido);


--
-- Name: lineas lineas_id_juego_fkey; Type: FK CONSTRAINT; Schema: juego; Owner: postgres
--

ALTER TABLE ONLY juego.lineas
    ADD CONSTRAINT lineas_id_juego_fkey FOREIGN KEY (id_juego) REFERENCES juego.juego(id_juego);


--
-- Name: lineas lineas_id_rol_fkey; Type: FK CONSTRAINT; Schema: juego; Owner: postgres
--

ALTER TABLE ONLY juego.lineas
    ADD CONSTRAINT lineas_id_rol_fkey FOREIGN KEY (id_rol) REFERENCES juego.roles_x_juego(id_rol);


--
-- Name: roles_x_juego roles_x_juego_id_usuario_fkey; Type: FK CONSTRAINT; Schema: juego; Owner: postgres
--

ALTER TABLE ONLY juego.roles_x_juego
    ADD CONSTRAINT roles_x_juego_id_usuario_fkey FOREIGN KEY (id_usuario) REFERENCES usuarios.usuario(id_usuario);


--
-- Name: unidades_inventario unidades_inventario_id_inventario_uso_fkey; Type: FK CONSTRAINT; Schema: juego; Owner: postgres
--

ALTER TABLE ONLY juego.unidades_inventario
    ADD CONSTRAINT unidades_inventario_id_inventario_uso_fkey FOREIGN KEY (id_inventario_uso) REFERENCES juego.inventario_x_uso(id_inventario_uso);


--
-- Name: unidades_inventario unidades_inventario_id_material_fkey; Type: FK CONSTRAINT; Schema: juego; Owner: postgres
--

ALTER TABLE ONLY juego.unidades_inventario
    ADD CONSTRAINT unidades_inventario_id_material_fkey FOREIGN KEY (id_material) REFERENCES juego.inventario(id_inventario);


--
-- Name: usuarios_x_juego usuarios_x_juego_id_juego_fkey; Type: FK CONSTRAINT; Schema: juego; Owner: postgres
--

ALTER TABLE ONLY juego.usuarios_x_juego
    ADD CONSTRAINT usuarios_x_juego_id_juego_fkey FOREIGN KEY (id_juego) REFERENCES juego.juego(id_juego);


--
-- Name: usuarios_x_juego usuarios_x_juego_id_usuario_fkey; Type: FK CONSTRAINT; Schema: juego; Owner: postgres
--

ALTER TABLE ONLY juego.usuarios_x_juego
    ADD CONSTRAINT usuarios_x_juego_id_usuario_fkey FOREIGN KEY (id_usuario) REFERENCES usuarios.usuario(id_usuario);


--
-- Name: vehiculos vehiculos_id_unidad_fkey; Type: FK CONSTRAINT; Schema: juego; Owner: postgres
--

ALTER TABLE ONLY juego.vehiculos
    ADD CONSTRAINT vehiculos_id_unidad_fkey FOREIGN KEY (id_unidad) REFERENCES juego.unidades(id_unidad);


--
-- Name: mensaje Mensaje_id_juego_fkey; Type: FK CONSTRAINT; Schema: mensajeria; Owner: postgres
--

ALTER TABLE ONLY mensajeria.mensaje
    ADD CONSTRAINT "Mensaje_id_juego_fkey" FOREIGN KEY (id_juego) REFERENCES juego.juego(id_juego);


--
-- Name: mensaje fk_estado; Type: FK CONSTRAINT; Schema: mensajeria; Owner: postgres
--

ALTER TABLE ONLY mensajeria.mensaje
    ADD CONSTRAINT fk_estado FOREIGN KEY (id_estado) REFERENCES mensajeria.estado(id_estado);


--
-- Name: adjuntos fk_id_mensaje; Type: FK CONSTRAINT; Schema: mensajeria; Owner: postgres
--

ALTER TABLE ONLY mensajeria.adjuntos
    ADD CONSTRAINT fk_id_mensaje FOREIGN KEY (id_mensaje) REFERENCES mensajeria.mensaje(id_mensaje);


--
-- Name: receptores fk_id_mensaje; Type: FK CONSTRAINT; Schema: mensajeria; Owner: postgres
--

ALTER TABLE ONLY mensajeria.receptores
    ADD CONSTRAINT fk_id_mensaje FOREIGN KEY (id_mensaje) REFERENCES mensajeria.mensaje(id_mensaje);


--
-- Name: mensaje mensaje_id_situacion_fkey; Type: FK CONSTRAINT; Schema: mensajeria; Owner: postgres
--

ALTER TABLE ONLY mensajeria.mensaje
    ADD CONSTRAINT mensaje_id_situacion_fkey FOREIGN KEY (id_situacion) REFERENCES juego.situaciones(id_situacion);


--
-- Name: receptores receptores_id_estado_fkey; Type: FK CONSTRAINT; Schema: mensajeria; Owner: postgres
--

ALTER TABLE ONLY mensajeria.receptores
    ADD CONSTRAINT receptores_id_estado_fkey FOREIGN KEY (id_estado) REFERENCES mensajeria.estado(id_estado);


--
-- Name: orden apreciacion_id_rol_fkey; Type: FK CONSTRAINT; Schema: ordenes; Owner: postgres
--

ALTER TABLE ONLY ordenes.orden
    ADD CONSTRAINT apreciacion_id_rol_fkey FOREIGN KEY (id_rol) REFERENCES juego.roles_x_juego(id_rol);


--
-- Name: compartidas compartidas_id_mensaje_fkey; Type: FK CONSTRAINT; Schema: ordenes; Owner: postgres
--

ALTER TABLE ONLY ordenes.compartidas
    ADD CONSTRAINT compartidas_id_mensaje_fkey FOREIGN KEY (id_mensaje) REFERENCES mensajeria.mensaje(id_mensaje);


--
-- Name: compartidas compartidas_id_orden_fkey; Type: FK CONSTRAINT; Schema: ordenes; Owner: postgres
--

ALTER TABLE ONLY ordenes.compartidas
    ADD CONSTRAINT compartidas_id_orden_fkey FOREIGN KEY (id_orden) REFERENCES ordenes.orden(id_orden);


--
-- Name: compartidas compartidas_id_rol_fkey; Type: FK CONSTRAINT; Schema: ordenes; Owner: postgres
--

ALTER TABLE ONLY ordenes.compartidas
    ADD CONSTRAINT compartidas_id_rol_fkey FOREIGN KEY (id_rol) REFERENCES juego.roles_x_juego(id_rol);


--
-- Name: orden orden_id_tipo_orden_fkey; Type: FK CONSTRAINT; Schema: ordenes; Owner: postgres
--

ALTER TABLE ONLY ordenes.orden
    ADD CONSTRAINT orden_id_tipo_orden_fkey FOREIGN KEY (id_tipo_orden) REFERENCES ordenes.tipo_orden(id_tipo_orden);


--
-- PostgreSQL database dump complete
--

