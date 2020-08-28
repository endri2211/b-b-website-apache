--
-- PostgreSQL database dump
--

-- Dumped from database version 12.2
-- Dumped by pg_dump version 12.2

-- Started on 2020-05-31 21:10:30 CEST

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 3167 (class 0 OID 43422)
-- Dependencies: 204
-- Data for Name: camere; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.camere (numero, tipo, prezzo) FROM stdin;
1	singola	39.00
2	singola	39.00
3	matrimoniale	49.00
4	matrimoniale	49.00
5	tripla	59.00
6	tripla	59.00
\.


--
-- TOC entry 3171 (class 0 OID 43447)
-- Dependencies: 208
-- Data for Name: prenotazioni; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.prenotazioni (utente, arrivo, partenza, numerocamera, prezzo, id) FROM stdin;
1	2020-05-20	2020-05-25	2	195.00	1
2	2020-05-20	2020-05-25	1	195.00	2
3	2020-05-20	2020-05-25	3	245.00	3
4	2020-05-20	2020-05-25	4	245.00	4
4	2020-06-01	2020-06-05	1	156.00	5
4	2020-06-01	2020-06-05	3	196.00	6
\.


--
-- TOC entry 3169 (class 0 OID 43437)
-- Dependencies: 206
-- Data for Name: recensioni; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.recensioni (email, nome, recensione, star, foto, id, dd) FROM stdin;
d.bifolco@gmail.com	Daniele	<p><b>Fantastico!!</b></p>La struttura e fantastica, il proprietario è gentilissimo.\r\npulizia top.	4	../images/foto_mia.jpeg	1	2020-05-31
r.donadio@gmail.com	Roberto	<p><b>Ottimo servizio</b></p>La struttura è pulita il personale gentile e la colazione fantastica!!\r\nci ritornerò 	4	../images/2020-05-31 20.40.56.jpg	2	2020-05-31
r.davino@gmail.com	Riccardo	<p><b>Tutto ok </b></p>Il giardino è stupendo e la sera si dorme bene.	4	../images/2020-05-31 20.40.01.jpg	3	2020-05-31
e.celaj@gmail.com	Endri	<p><b>Bello il posto!</b></p>Davvero bello il posto e inoltre molto vicino alla costiera amalfitana o a Pompei. ottimo per i turisti	4	../images/photo_2020-05-31 20.49.41.jpeg	4	2020-05-31
\.


--
-- TOC entry 3166 (class 0 OID 43410)
-- Dependencies: 203
-- Data for Name: utente; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.utente (nome, cognome, email, password, immagine_profilo, id) FROM stdin;
Daniele	Bifolco	d.bifolco@gmail.com	$2y$10$SAXP2N.LgDv/lYWrwsLqZOKWfS6XmZ1Noz9MJI56S9n/mT9Ip8BCG	../images/foto_mia.jpeg	1
Riccardo	D'avino	r.davino@gmail.com	$2y$10$/uzOjMp9lKkbeygHB6bx/eBC4Mj1s7Zm3rhknpsgZ2L9NZuZQSIwm	../images/2020-05-31 20.40.01.jpg	2
Roberto	Donadio	r.donadio@gmail.com	$2y$10$jCgGESByFB2EmRF.Z9OHe.G9xkzpYvulgDjR7jB2EGElECmgWxvFC	../images/2020-05-31 20.40.56.jpg	3
Endri	Celaj	e.celaj@gmail.com	$2y$10$g1jC9NnRyEygbYjGdWjVE.6i3xV1FoKfrDvYyAV/i2XzZ5dO.ebG.	../images/photo_2020-05-31 20.49.41.jpeg	4
\.


--
-- TOC entry 3185 (class 0 OID 0)
-- Dependencies: 207
-- Name: prenotazioni_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.prenotazioni_id_seq', 6, true);


--
-- TOC entry 3186 (class 0 OID 0)
-- Dependencies: 205
-- Name: recensioni_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.recensioni_id_seq', 4, true);


--
-- TOC entry 3187 (class 0 OID 0)
-- Dependencies: 202
-- Name: utente_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.utente_id_seq', 4, true);


-- Completed on 2020-05-31 21:10:32 CEST

--
-- PostgreSQL database dump complete
--

