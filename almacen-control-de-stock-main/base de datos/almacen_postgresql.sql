--
-- PostgreSQL database dump
--

-- Dumped from database version 9.5.0
-- Dumped by pg_dump version 9.6.0

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: almacens; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE almacens (
    id integer NOT NULL,
    nombre character varying(100) DEFAULT NULL::character varying,
    created_at timestamp without time zone NOT NULL,
    updated_at timestamp without time zone NOT NULL
);


ALTER TABLE almacens OWNER TO postgres;

--
-- Name: almacens_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE almacens_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE almacens_id_seq OWNER TO postgres;

--
-- Name: almacens_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE almacens_id_seq OWNED BY almacens.id;


--
-- Name: clientes; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE clientes (
    id integer NOT NULL,
    nombres character varying(150) NOT NULL,
    apellidos character varying(150) NOT NULL,
    identificacion character varying(150) NOT NULL,
    telefono character varying(150) NOT NULL,
    email character varying(150) NOT NULL,
    direccion character varying(150) NOT NULL,
    ruta_id integer NOT NULL,
    created_at timestamp without time zone,
    updated_at timestamp without time zone
);


ALTER TABLE clientes OWNER TO postgres;

--
-- Name: clientes_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE clientes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE clientes_id_seq OWNER TO postgres;

--
-- Name: clientes_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE clientes_id_seq OWNED BY clientes.id;


--
-- Name: failed_jobs; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE failed_jobs (
    id bigint NOT NULL,
    uuid character varying(255) NOT NULL,
    connection text NOT NULL,
    queue text NOT NULL,
    payload text NOT NULL,
    exception text NOT NULL,
    failed_at timestamp(0) without time zone DEFAULT now() NOT NULL
);


ALTER TABLE failed_jobs OWNER TO postgres;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE failed_jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE failed_jobs_id_seq OWNER TO postgres;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE failed_jobs_id_seq OWNED BY failed_jobs.id;


--
-- Name: forma_de_pagos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE forma_de_pagos (
    id integer NOT NULL,
    nombre character varying(100) NOT NULL,
    cod character varying(100) NOT NULL,
    created_at timestamp without time zone,
    updated_at timestamp without time zone
);


ALTER TABLE forma_de_pagos OWNER TO postgres;

--
-- Name: forma_de_pagos_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE forma_de_pagos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE forma_de_pagos_id_seq OWNER TO postgres;

--
-- Name: forma_de_pagos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE forma_de_pagos_id_seq OWNED BY forma_de_pagos.id;


--
-- Name: migrations; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);


ALTER TABLE migrations OWNER TO postgres;

--
-- Name: migrations_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE migrations_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE migrations_id_seq OWNER TO postgres;

--
-- Name: migrations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE migrations_id_seq OWNED BY migrations.id;


--
-- Name: password_resets; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE password_resets (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);


ALTER TABLE password_resets OWNER TO postgres;

--
-- Name: personal_access_tokens; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE personal_access_tokens (
    id bigint NOT NULL,
    tokenable_type character varying(255) NOT NULL,
    tokenable_id bigint NOT NULL,
    name character varying(255) NOT NULL,
    token character varying(64) NOT NULL,
    abilities text,
    last_used_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE personal_access_tokens OWNER TO postgres;

--
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE personal_access_tokens_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE personal_access_tokens_id_seq OWNER TO postgres;

--
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE personal_access_tokens_id_seq OWNED BY personal_access_tokens.id;


--
-- Name: productos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE productos (
    id integer NOT NULL,
    nombre character varying(100) NOT NULL,
    stock integer,
    precio double precision NOT NULL,
    precio_rebaja double precision,
    marca character varying(100) NOT NULL,
    descripcion text NOT NULL,
    created_at timestamp without time zone,
    updated_at timestamp without time zone
);


ALTER TABLE productos OWNER TO postgres;

--
-- Name: productos_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE productos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE productos_id_seq OWNER TO postgres;

--
-- Name: productos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE productos_id_seq OWNED BY productos.id;


--
-- Name: rutas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE rutas (
    id integer NOT NULL,
    nombre character varying(100) NOT NULL,
    direccion text NOT NULL,
    created_at timestamp without time zone,
    updated_at timestamp without time zone
);


ALTER TABLE rutas OWNER TO postgres;

--
-- Name: rutas_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE rutas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE rutas_id_seq OWNER TO postgres;

--
-- Name: rutas_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE rutas_id_seq OWNED BY rutas.id;


--
-- Name: stock_historias; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE stock_historias (
    id integer NOT NULL,
    vehiculo character varying(100) NOT NULL,
    vehiculo_id integer NOT NULL,
    producto character varying(255) NOT NULL,
    producto_id integer NOT NULL,
    stock_actual bigint NOT NULL,
    created_at timestamp without time zone,
    updated_at timestamp without time zone
);


ALTER TABLE stock_historias OWNER TO postgres;

--
-- Name: stock_historias_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE stock_historias_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE stock_historias_id_seq OWNER TO postgres;

--
-- Name: stock_historias_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE stock_historias_id_seq OWNED BY stock_historias.id;


--
-- Name: stock_vehiculos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE stock_vehiculos (
    id integer NOT NULL,
    vehiculos_id integer NOT NULL,
    productos_id integer NOT NULL,
    stock_product character varying(100) DEFAULT NULL::character varying
);


ALTER TABLE stock_vehiculos OWNER TO postgres;

--
-- Name: stock_vehiculos_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE stock_vehiculos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE stock_vehiculos_id_seq OWNER TO postgres;

--
-- Name: stock_vehiculos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE stock_vehiculos_id_seq OWNED BY stock_vehiculos.id;


--
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE users (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    email_verified_at timestamp(0) without time zone,
    password character varying(255) NOT NULL,
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE users OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE users_id_seq OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE users_id_seq OWNED BY users.id;


--
-- Name: vehiculos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE vehiculos (
    id integer NOT NULL,
    nombre character varying(100) NOT NULL,
    modelo character varying(255) NOT NULL,
    marca character varying(255) NOT NULL,
    color character varying(255) NOT NULL,
    rutas_json jsonb,
    created_at timestamp without time zone,
    updated_at timestamp without time zone
);


ALTER TABLE vehiculos OWNER TO postgres;

--
-- Name: vehiculos_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE vehiculos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE vehiculos_id_seq OWNER TO postgres;

--
-- Name: vehiculos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE vehiculos_id_seq OWNED BY vehiculos.id;


--
-- Name: venta_clientes; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE venta_clientes (
    id integer NOT NULL,
    codigo character varying(100) NOT NULL,
    cifnif character varying(150) NOT NULL,
    direccion character varying(250) NOT NULL,
    nombres character varying(100) NOT NULL,
    apellidos character varying(100) NOT NULL,
    telefono character varying(100) NOT NULL,
    ciudad character varying(150),
    fpago character varying(100),
    ruta_id integer NOT NULL,
    vehiculo_id integer NOT NULL,
    total_precio numeric(15,2) NOT NULL,
    fecha_venta date,
    created_at timestamp without time zone,
    updated_at timestamp without time zone
);


ALTER TABLE venta_clientes OWNER TO postgres;

--
-- Name: venta_clientes_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE venta_clientes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE venta_clientes_id_seq OWNER TO postgres;

--
-- Name: venta_clientes_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE venta_clientes_id_seq OWNED BY venta_clientes.id;


--
-- Name: venta_clientes_lineas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE venta_clientes_lineas (
    id integer NOT NULL,
    nombre character varying(200) NOT NULL,
    stock_venta integer NOT NULL,
    precio numeric(15,2) NOT NULL,
    precio_total numeric(15,2),
    venta_cliente_id integer NOT NULL,
    producto_id integer NOT NULL,
    created_at timestamp without time zone,
    updated_at timestamp without time zone
);


ALTER TABLE venta_clientes_lineas OWNER TO postgres;

--
-- Name: venta_clientes_lineas_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE venta_clientes_lineas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE venta_clientes_lineas_id_seq OWNER TO postgres;

--
-- Name: venta_clientes_lineas_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE venta_clientes_lineas_id_seq OWNED BY venta_clientes_lineas.id;


--
-- Name: almacens id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY almacens ALTER COLUMN id SET DEFAULT nextval('almacens_id_seq'::regclass);


--
-- Name: clientes id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY clientes ALTER COLUMN id SET DEFAULT nextval('clientes_id_seq'::regclass);


--
-- Name: failed_jobs id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY failed_jobs ALTER COLUMN id SET DEFAULT nextval('failed_jobs_id_seq'::regclass);


--
-- Name: forma_de_pagos id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY forma_de_pagos ALTER COLUMN id SET DEFAULT nextval('forma_de_pagos_id_seq'::regclass);


--
-- Name: migrations id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY migrations ALTER COLUMN id SET DEFAULT nextval('migrations_id_seq'::regclass);


--
-- Name: personal_access_tokens id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY personal_access_tokens ALTER COLUMN id SET DEFAULT nextval('personal_access_tokens_id_seq'::regclass);


--
-- Name: productos id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY productos ALTER COLUMN id SET DEFAULT nextval('productos_id_seq'::regclass);


--
-- Name: rutas id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY rutas ALTER COLUMN id SET DEFAULT nextval('rutas_id_seq'::regclass);


--
-- Name: stock_historias id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY stock_historias ALTER COLUMN id SET DEFAULT nextval('stock_historias_id_seq'::regclass);


--
-- Name: stock_vehiculos id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY stock_vehiculos ALTER COLUMN id SET DEFAULT nextval('stock_vehiculos_id_seq'::regclass);


--
-- Name: users id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY users ALTER COLUMN id SET DEFAULT nextval('users_id_seq'::regclass);


--
-- Name: vehiculos id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY vehiculos ALTER COLUMN id SET DEFAULT nextval('vehiculos_id_seq'::regclass);


--
-- Name: venta_clientes id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY venta_clientes ALTER COLUMN id SET DEFAULT nextval('venta_clientes_id_seq'::regclass);


--
-- Name: venta_clientes_lineas id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY venta_clientes_lineas ALTER COLUMN id SET DEFAULT nextval('venta_clientes_lineas_id_seq'::regclass);


--
-- Data for Name: almacens; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY almacens (id, nombre, created_at, updated_at) FROM stdin;
1	Almacen 1	2021-05-24 12:57:33	2021-05-24 12:57:33
2	Almacen 2	2021-05-24 12:57:33	2021-05-24 12:57:33
\.


--
-- Name: almacens_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('almacens_id_seq', 1, false);


--
-- Data for Name: clientes; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY clientes (id, nombres, apellidos, identificacion, telefono, email, direccion, ruta_id, created_at, updated_at) FROM stdin;
1	Pedro J	Avila	25129301	0545645646	pedrojam14@gmail.com	asadsd	1	2021-05-28 10:35:05	2021-05-28 10:35:05
2	Arnoldo 	Perez	4546545646	56564656	pepdxpd		1	2021-05-28 10:35:42	2021-05-28 10:35:42
5	pedro	Smit	251293013	04127709844	pedrojam134@gmail.com	ALTAGRACIA DE ORITUCO URB EL DIAMANTE CASA NUMERO 58, Principal	2	2021-05-28 23:46:00	2021-07-16 16:32:46
9	Pruebas cliente	pruebas	544645646546	64654564879	pruebascli@almacen.com	new york	18	2021-07-16 18:20:25	2021-07-16 18:20:25
\.


--
-- Name: clientes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('clientes_id_seq', 1, false);


--
-- Data for Name: failed_jobs; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY failed_jobs (id, uuid, connection, queue, payload, exception, failed_at) FROM stdin;
\.


--
-- Name: failed_jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('failed_jobs_id_seq', 1, false);


--
-- Data for Name: forma_de_pagos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY forma_de_pagos (id, nombre, cod, created_at, updated_at) FROM stdin;
1	Contado	cond	2021-05-30 20:15:54	2021-05-30 20:15:54
2	credito	cred	2021-05-30 20:15:54	2021-05-30 20:15:54
\.


--
-- Name: forma_de_pagos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('forma_de_pagos_id_seq', 1, false);


--
-- Data for Name: migrations; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY migrations (id, migration, batch) FROM stdin;
1	2014_10_12_000000_create_users_table	1
2	2014_10_12_100000_create_password_resets_table	1
3	2019_08_19_000000_create_failed_jobs_table	1
4	2019_12_14_000001_create_personal_access_tokens_table	1
\.


--
-- Name: migrations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('migrations_id_seq', 4, true);


--
-- Data for Name: password_resets; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY password_resets (email, token, created_at) FROM stdin;
\.


--
-- Data for Name: personal_access_tokens; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY personal_access_tokens (id, tokenable_type, tokenable_id, name, token, abilities, last_used_at, created_at, updated_at) FROM stdin;
\.


--
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('personal_access_tokens_id_seq', 1, false);


--
-- Data for Name: productos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY productos (id, nombre, stock, precio, precio_rebaja, marca, descripcion, created_at, updated_at) FROM stdin;
1	Galletas de chocolate2	70	100	\N	Royale club	asdasdasd	2021-05-24 14:43:35	2021-06-04 20:05:55
2	Galletas	900	10000	\N	Gap		2021-06-04 18:32:34	2021-07-16 18:19:18
25	Chocolates	80	2000	\N	sav	asdaksjdhajsdhak	2021-07-16 18:16:13	2021-07-16 18:19:18
\.


--
-- Name: productos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('productos_id_seq', 1, false);


--
-- Data for Name: rutas; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY rutas (id, nombre, direccion, created_at, updated_at) FROM stdin;
1	Ruta 2	Direccion central al cruce, calle 4, casa numero 80	2021-05-24 14:44:35	2021-06-07 14:59:30
2	Ruta 1	Direccion central, calle 7, casa numero 100	2021-05-24 14:44:35	2021-05-24 14:44:35
3	Ruta 4	asdasdasdasdasd	2021-06-07 14:59:44	2021-06-07 14:59:44
18	Ruta para video	New york calle 2	2021-07-16 18:17:06	2021-07-16 18:17:19
\.


--
-- Name: rutas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('rutas_id_seq', 1, false);


--
-- Data for Name: stock_historias; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY stock_historias (id, vehiculo, vehiculo_id, producto, producto_id, stock_actual, created_at, updated_at) FROM stdin;
32	Vehiculo9	4	paquete de galletas	1	135	2021-05-28 01:55:18	2021-05-28 01:55:18
33	Vehiculo9	4	Galletas de chocolate	2	98	2021-05-28 01:55:18	2021-05-28 01:55:18
34	vehiculo4	6	paquete de galletas	1	3	2021-05-28 02:00:21	2021-05-28 02:00:21
35	Vehiculo2	2	paquete de galletas	1	24	2021-05-31 03:44:04	2021-05-31 03:44:04
36	vehiculo 2	3	paquete de galletas	1	20	2021-05-31 03:45:43	2021-05-31 03:45:43
37	Vehiculo9	4	Pruebas productos	5	0	2021-06-08 01:23:03	2021-06-08 01:23:03
38	Vehiculo2	2	Pruebas productos	5	0	2021-06-09 15:14:33	2021-06-09 15:14:33
39	Vehiculo2	2	Galletas	2	3	2021-06-09 15:14:33	2021-06-09 15:14:33
40	Vehiculo2	2	Galletas	2	8	2021-06-09 15:14:49	2021-06-09 15:14:49
41	Vehiculo2	2	Pruebas productos	5	7	2021-06-09 15:17:17	2021-06-09 15:17:17
42	Vehiculo de pruebas	9	chocolate	9	0	2021-07-16 15:34:12	2021-07-16 15:34:12
43	Vehiculo de pruebas	10	Chocolate	12	0	2021-07-16 16:02:06	2021-07-16 16:02:06
44	Vehiculo de pruebas	10	Galletas	2	0	2021-07-16 16:02:06	2021-07-16 16:02:06
45	Vehiculo para pruebas	11	Chocolates  2	14	0	2021-07-16 16:30:42	2021-07-16 16:30:42
46	Vehiculo para pruebas	11	Galletas	2	0	2021-07-16 16:30:42	2021-07-16 16:30:42
47	Rutas para video	12	Chocolates	20	0	2021-07-16 17:45:15	2021-07-16 17:45:15
48	Rutas para video	12	Galletas	2	0	2021-07-16 17:45:15	2021-07-16 17:45:15
49	Vehiculo de video	13	Chocolates para video	24	0	2021-07-16 18:08:35	2021-07-16 18:08:35
50	Vehiculo de video	13	Galletas	2	0	2021-07-16 18:08:36	2021-07-16 18:08:36
51	Vehiculo para video	14	Chocolates	25	0	2021-07-16 18:19:18	2021-07-16 18:19:18
52	Vehiculo para video	14	Galletas	2	0	2021-07-16 18:19:18	2021-07-16 18:19:18
\.


--
-- Name: stock_historias_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('stock_historias_id_seq', 1, false);


--
-- Data for Name: stock_vehiculos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY stock_vehiculos (id, vehiculos_id, productos_id, stock_product) FROM stdin;
1	2	1	2
2	2	2	8
3	4	1	103
4	4	2	93
5	3	1	8
6	3	2	10
7	6	1	3
8	6	2	3
9	4	5	2
10	2	5	7
11	9	9	17
12	10	12	15
13	10	2	20
14	11	14	20
15	11	2	20
16	12	20	20
\.


--
-- Name: stock_vehiculos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('stock_vehiculos_id_seq', 1, false);


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY users (id, name, email, email_verified_at, password, remember_token, created_at, updated_at) FROM stdin;
1	RJMF	romulo@prueba.com	\N	$2y$10$f/WZwUHfWqIHfySPHdrdZ.yyd6pFkdv8bhGmHBN96Pgz7b4sEe2Z2	tEfnEJVCbuXIScSETtWUpzXjEfrG6EMnks73wBUw0KfRaHJBbQdu7ASUZ6zU	2024-06-14 17:20:12	2024-06-14 17:20:12
\.


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('users_id_seq', 1, true);


--
-- Data for Name: vehiculos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY vehiculos (id, nombre, modelo, marca, color, rutas_json, created_at, updated_at) FROM stdin;
2	Vehiculo2	chevrolet	blazer	verde	[{"id": 1, "nombre": "Ruta 1", "direccion": "Direccion central al cruce, calle 4, casa numero 80", "created_at": "2021-05-24T14:44:35.000000Z", "updated_at": "2021-05-24T14:44:35.000000Z"}, {"id": 2, "nombre": "Ruta 1", "direccion": "Direccion central, calle 7, casa numero 100", "created_at": "2021-05-24T14:44:35.000000Z", "updated_at": "2021-05-24T14:44:35.000000Z"}]	2021-05-25 18:23:44	2021-06-09 15:17:17
3	vehiculo 2	chevrolet3	blazer	azul	[{"id": 1, "nombre": "Ruta 1", "direccion": "Direccion central al cruce, calle 4, casa numero 80", "created_at": "2021-05-24T14:44:35.000000Z", "updated_at": "2021-05-24T14:44:35.000000Z"}, {"id": 2, "nombre": "Ruta 1", "direccion": "Direccion central, calle 7, casa numero 100", "created_at": "2021-05-24T14:44:35.000000Z", "updated_at": "2021-05-24T14:44:35.000000Z"}]	2021-05-25 18:25:43	2021-05-31 03:45:50
4	Vehiculo9	chevrolet	adads	asdasd	[{"id": 1, "nombre": "Ruta 1", "direccion": "Direccion central al cruce, calle 4, casa numero 80", "created_at": "2021-05-24T14:44:35.000000Z", "updated_at": "2021-05-24T14:44:35.000000Z"}]	2021-05-26 16:18:33	2021-06-08 01:23:03
7	Vehiculo10	chevrolet	blazer	rojo	[{"id": 1, "nombre": "Ruta 2", "direccion": "Direccion central al cruce, calle 4, casa numero 80", "created_at": "2021-05-24T14:44:35.000000Z", "updated_at": "2021-06-07T14:59:30.000000Z"}, {"id": 2, "nombre": "Ruta 1", "direccion": "Direccion central, calle 7, casa numero 100", "created_at": "2021-05-24T14:44:35.000000Z", "updated_at": "2021-05-24T14:44:35.000000Z"}]	2021-07-16 14:32:45	2021-07-16 14:32:45
14	Vehiculo para video	chevrolet	blazer	amarillo	[{"id": 18, "nombre": "Ruta para video", "direccion": "New york calle 2", "created_at": "2021-07-16T18:17:06.000000Z", "updated_at": "2021-07-16T18:17:19.000000Z"}, {"id": 2, "nombre": "Ruta 1", "direccion": "Direccion central, calle 7, casa numero 100", "created_at": "2021-05-24T14:44:35.000000Z", "updated_at": "2021-05-24T14:44:35.000000Z"}]	2021-07-16 18:18:31	2021-07-16 18:19:18
15	ff	ff	ff	fff	[{"id": 3, "nombre": "Ruta 4", "direccion": "asdasdasdasdasd", "created_at": "2021-06-07T14:59:44.000000Z", "updated_at": "2021-06-07T14:59:44.000000Z"}]	2022-07-02 02:21:47	2022-07-02 02:21:47
\.


--
-- Name: vehiculos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('vehiculos_id_seq', 1, false);


--
-- Data for Name: venta_clientes; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY venta_clientes (id, codigo, cifnif, direccion, nombres, apellidos, telefono, ciudad, fpago, ruta_id, vehiculo_id, total_precio, fecha_venta, created_at, updated_at) FROM stdin;
8	00000001	4546545646	Ruta 1	Arnoldo	Perez2	56564656	\N	cond	1	4	1100.00	2021-06-01	2021-06-01 20:25:03	2021-06-06 17:17:52
9	00000002	251293013	Ruta 1	pedro45	pedro4	04127709844	\N	cond	2	3	600.00	2021-06-01	2021-06-01 20:30:50	2021-06-01 20:30:50
11	00000003	4546545646	Ruta 1	Arnoldo	Perez	56564656	\N	cond	1	4	600.00	2021-06-04	2021-06-04 14:03:28	2021-06-04 14:32:41
14	00000004	544645646546	Ruta para video	Pruebas cliente	pruebas	64654564879	\N	cond	18	14	26000.00	2021-07-16	2021-07-16 18:22:56	2021-07-16 18:22:56
\.


--
-- Name: venta_clientes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('venta_clientes_id_seq', 1, false);


--
-- Data for Name: venta_clientes_lineas; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY venta_clientes_lineas (id, nombre, stock_venta, precio, precio_total, venta_cliente_id, producto_id, created_at, updated_at) FROM stdin;
8	paquete de galletas	3	100.00	300.00	6	1	2021-06-01 19:19:48	2021-06-04 14:28:07
10	paquete de galletas	9	100.00	900.00	8	1	2021-06-01 20:25:03	2021-06-03 00:54:38
11	Galletas de  chocolate	2	100.00	200.00	8	2	2021-06-01 20:25:03	2021-06-01 20:25:03
12	paquete de galletas	3	100.00	300.00	9	1	2021-06-01 20:30:50	2021-06-01 20:30:50
13	Galletas de  chocolate	3	100.00	300.00	9	2	2021-06-01 20:30:50	2021-06-01 20:30:00
\.


--
-- Name: venta_clientes_lineas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('venta_clientes_lineas_id_seq', 1, false);


--
-- Name: almacens almacens_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY almacens
    ADD CONSTRAINT almacens_pkey PRIMARY KEY (id);


--
-- Name: clientes clientes_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY clientes
    ADD CONSTRAINT clientes_pkey PRIMARY KEY (id);


--
-- Name: failed_jobs failed_jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY failed_jobs
    ADD CONSTRAINT failed_jobs_pkey PRIMARY KEY (id);


--
-- Name: failed_jobs failed_jobs_uuid_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY failed_jobs
    ADD CONSTRAINT failed_jobs_uuid_unique UNIQUE (uuid);


--
-- Name: forma_de_pagos forma_de_pagos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY forma_de_pagos
    ADD CONSTRAINT forma_de_pagos_pkey PRIMARY KEY (id);


--
-- Name: migrations migrations_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);


--
-- Name: personal_access_tokens personal_access_tokens_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_pkey PRIMARY KEY (id);


--
-- Name: personal_access_tokens personal_access_tokens_token_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_token_unique UNIQUE (token);


--
-- Name: productos productos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY productos
    ADD CONSTRAINT productos_pkey PRIMARY KEY (id);


--
-- Name: rutas rutas_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY rutas
    ADD CONSTRAINT rutas_pkey PRIMARY KEY (id);


--
-- Name: stock_historias stock_historias_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY stock_historias
    ADD CONSTRAINT stock_historias_pkey PRIMARY KEY (id);


--
-- Name: stock_vehiculos stock_vehiculos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY stock_vehiculos
    ADD CONSTRAINT stock_vehiculos_pkey PRIMARY KEY (id);


--
-- Name: users users_email_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY users
    ADD CONSTRAINT users_email_unique UNIQUE (email);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: vehiculos vehiculos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY vehiculos
    ADD CONSTRAINT vehiculos_pkey PRIMARY KEY (id);


--
-- Name: venta_clientes_lineas venta_clientes_lineas_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY venta_clientes_lineas
    ADD CONSTRAINT venta_clientes_lineas_pkey PRIMARY KEY (id);


--
-- Name: venta_clientes venta_clientes_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY venta_clientes
    ADD CONSTRAINT venta_clientes_pkey PRIMARY KEY (id);


--
-- Name: password_resets_email_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX password_resets_email_index ON password_resets USING btree (email);


--
-- Name: personal_access_tokens_tokenable_type_tokenable_id_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX personal_access_tokens_tokenable_type_tokenable_id_index ON personal_access_tokens USING btree (tokenable_type, tokenable_id);


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

