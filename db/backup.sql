--
-- PostgreSQL database dump
--

-- Dumped from database version 10.4
-- Dumped by pg_dump version 10.4

-- Started on 2018-08-13 13:54:59

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 197 (class 1259 OID 16393)
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.users (
    nom character varying(30),
    prenom character varying(30),
    email character varying(30),
    telephone character varying(30),
    secteur_activite character varying(30),
    disponibilite character varying(30),
    password character varying(30),
    status character varying(30)
);


ALTER TABLE public.users OWNER TO postgres;

--
-- TOC entry 2789 (class 0 OID 16393)
-- Dependencies: 197
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.users (nom, prenom, email, telephone, secteur_activite, disponibilite, password, status) FROM stdin;
Mcclain	Dave	Dave_mcclain@gmail.com	0697342468	Musicien	2018-08-25	SerialDrummer	Marier
Knopfler	Mark	Knopfler_Mark@gmail.com	0676845465	Musicien	2018-10-11	Money4Nothing	Marier
Santana	Carlos	Carlos_santana@gmail.com	0614234878	Musicien	2018-10-17	GuitareIsMyLife	Celibataire
Tran	Vincent	tran.vincent85@gmail.com	0611326332	Reconversion professionnelle	2018-09-03	tranvincent	Celibataire
Abe	Cunningham	Cunningham_Abe@gmail.com	0683197548	Musicien	2018-10-08	Groove4Ever	Celibataire
\.


-- Completed on 2018-08-13 13:54:59

--
-- PostgreSQL database dump complete
--

