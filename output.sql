--
-- PostgreSQL database dump
--

-- Dumped from database version 10.3 (Ubuntu 10.3-1.pgdg16.04+1)
-- Dumped by pg_dump version 10.4 (Ubuntu 10.4-1.pgdg16.04+1)

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
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: tasks; Type: TABLE; Schema: public; Owner: hsnlaycjomkcpy
--

CREATE TABLE public.tasks (
    task_id integer NOT NULL,
    user_id integer NOT NULL,
    task_name character varying(100) NOT NULL,
    task_details text,
    due_date timestamp without time zone,
    task_duration double precision,
    color character varying(100) NOT NULL
);


ALTER TABLE public.tasks OWNER TO hsnlaycjomkcpy;

--
-- Name: tasks_task_id_seq; Type: SEQUENCE; Schema: public; Owner: hsnlaycjomkcpy
--

CREATE SEQUENCE public.tasks_task_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tasks_task_id_seq OWNER TO hsnlaycjomkcpy;

--
-- Name: tasks_task_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: hsnlaycjomkcpy
--

ALTER SEQUENCE public.tasks_task_id_seq OWNED BY public.tasks.task_id;


--
-- Name: user_preferences; Type: TABLE; Schema: public; Owner: hsnlaycjomkcpy
--

CREATE TABLE public.user_preferences (
    preference_id integer NOT NULL,
    user_id integer NOT NULL,
    dark_theme boolean NOT NULL,
    start_on_mon boolean NOT NULL
);


ALTER TABLE public.user_preferences OWNER TO hsnlaycjomkcpy;

--
-- Name: user_preferences_preference_id_seq; Type: SEQUENCE; Schema: public; Owner: hsnlaycjomkcpy
--

CREATE SEQUENCE public.user_preferences_preference_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.user_preferences_preference_id_seq OWNER TO hsnlaycjomkcpy;

--
-- Name: user_preferences_preference_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: hsnlaycjomkcpy
--

ALTER SEQUENCE public.user_preferences_preference_id_seq OWNED BY public.user_preferences.preference_id;


--
-- Name: users; Type: TABLE; Schema: public; Owner: hsnlaycjomkcpy
--

CREATE TABLE public.users (
    user_id integer NOT NULL,
    email character varying(100) NOT NULL,
    password character varying(100) NOT NULL,
    creation_date timestamp without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);


ALTER TABLE public.users OWNER TO hsnlaycjomkcpy;

--
-- Name: users_user_id_seq; Type: SEQUENCE; Schema: public; Owner: hsnlaycjomkcpy
--

CREATE SEQUENCE public.users_user_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.users_user_id_seq OWNER TO hsnlaycjomkcpy;

--
-- Name: users_user_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: hsnlaycjomkcpy
--

ALTER SEQUENCE public.users_user_id_seq OWNED BY public.users.user_id;


--
-- Name: tasks task_id; Type: DEFAULT; Schema: public; Owner: hsnlaycjomkcpy
--

ALTER TABLE ONLY public.tasks ALTER COLUMN task_id SET DEFAULT nextval('public.tasks_task_id_seq'::regclass);


--
-- Name: user_preferences preference_id; Type: DEFAULT; Schema: public; Owner: hsnlaycjomkcpy
--

ALTER TABLE ONLY public.user_preferences ALTER COLUMN preference_id SET DEFAULT nextval('public.user_preferences_preference_id_seq'::regclass);


--
-- Name: users user_id; Type: DEFAULT; Schema: public; Owner: hsnlaycjomkcpy
--

ALTER TABLE ONLY public.users ALTER COLUMN user_id SET DEFAULT nextval('public.users_user_id_seq'::regclass);


--
-- Data for Name: tasks; Type: TABLE DATA; Schema: public; Owner: hsnlaycjomkcpy
--

COPY public.tasks (task_id, user_id, task_name, task_details, due_date, task_duration, color) FROM stdin;
10	9	Web 2	Web Engineering 	2018-06-07 22:00:00	60	#dd7ec2
11	9	Tech Comm	Technical Communications	2018-06-07 22:00:00	60	#328524
12	9	Software Design	Some Java Project	2018-06-09 22:00:00	60	#aab1a3
13	9	System Security	Lot's of reading	2018-06-09 22:00:00	60	#81e8cf
\.


--
-- Data for Name: user_preferences; Type: TABLE DATA; Schema: public; Owner: hsnlaycjomkcpy
--

COPY public.user_preferences (preference_id, user_id, dark_theme, start_on_mon) FROM stdin;
8	9	f	f
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: hsnlaycjomkcpy
--

COPY public.users (user_id, email, password, creation_date) FROM stdin;
9	Tester@gmail.com	$2y$10$nRGZ8yIjpjqNYpzGkcdGoufjkF.B5vCXRpNU9/BJiW45U8DlPJ3Zi	2018-06-02 11:43:41.59447
\.


--
-- Name: tasks_task_id_seq; Type: SEQUENCE SET; Schema: public; Owner: hsnlaycjomkcpy
--

SELECT pg_catalog.setval('public.tasks_task_id_seq', 13, true);


--
-- Name: user_preferences_preference_id_seq; Type: SEQUENCE SET; Schema: public; Owner: hsnlaycjomkcpy
--

SELECT pg_catalog.setval('public.user_preferences_preference_id_seq', 8, true);


--
-- Name: users_user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: hsnlaycjomkcpy
--

SELECT pg_catalog.setval('public.users_user_id_seq', 9, true);


--
-- Name: tasks tasks_pkey; Type: CONSTRAINT; Schema: public; Owner: hsnlaycjomkcpy
--

ALTER TABLE ONLY public.tasks
    ADD CONSTRAINT tasks_pkey PRIMARY KEY (task_id);


--
-- Name: user_preferences user_preferences_pkey; Type: CONSTRAINT; Schema: public; Owner: hsnlaycjomkcpy
--

ALTER TABLE ONLY public.user_preferences
    ADD CONSTRAINT user_preferences_pkey PRIMARY KEY (preference_id);


--
-- Name: users users_email_key; Type: CONSTRAINT; Schema: public; Owner: hsnlaycjomkcpy
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_key UNIQUE (email);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: hsnlaycjomkcpy
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (user_id);


--
-- Name: tasks tasks_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: hsnlaycjomkcpy
--

ALTER TABLE ONLY public.tasks
    ADD CONSTRAINT tasks_user_id_fkey FOREIGN KEY (user_id) REFERENCES public.users(user_id);


--
-- Name: user_preferences user_preferences_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: hsnlaycjomkcpy
--

ALTER TABLE ONLY public.user_preferences
    ADD CONSTRAINT user_preferences_user_id_fkey FOREIGN KEY (user_id) REFERENCES public.users(user_id);


--
-- Name: SCHEMA public; Type: ACL; Schema: -; Owner: hsnlaycjomkcpy
--

REVOKE ALL ON SCHEMA public FROM postgres;
REVOKE ALL ON SCHEMA public FROM PUBLIC;
GRANT ALL ON SCHEMA public TO hsnlaycjomkcpy;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- Name: LANGUAGE plpgsql; Type: ACL; Schema: -; Owner: postgres
--

GRANT ALL ON LANGUAGE plpgsql TO hsnlaycjomkcpy;


--
-- PostgreSQL database dump complete
--

