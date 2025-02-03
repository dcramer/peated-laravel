--
-- PostgreSQL database dump
--

-- Dumped from database version 15.7 (Debian 15.7-1.pgdg110+1)
-- Dumped by pg_dump version 17.2 (Homebrew)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: drizzle; Type: SCHEMA; Schema: -; Owner: -
--

CREATE SCHEMA drizzle;


--
-- Name: postgis; Type: EXTENSION; Schema: -; Owner: -
--

CREATE EXTENSION IF NOT EXISTS postgis WITH SCHEMA public;


--
-- Name: EXTENSION postgis; Type: COMMENT; Schema: -; Owner: -
--

COMMENT ON EXTENSION postgis IS 'PostGIS geometry and geography spatial types and functions';


--
-- Name: vector; Type: EXTENSION; Schema: -; Owner: -
--

CREATE EXTENSION IF NOT EXISTS vector WITH SCHEMA public;


--
-- Name: EXTENSION vector; Type: COMMENT; Schema: -; Owner: -
--

COMMENT ON EXTENSION vector IS 'vector data type and ivfflat and hnsw access methods';


--
-- Name: badge_award_object_type; Type: TYPE; Schema: public; Owner: -
--

CREATE TYPE public.badge_award_object_type AS ENUM (
    'bottle',
    'entity',
    'country',
    'region'
);


--
-- Name: badge_formula; Type: TYPE; Schema: public; Owner: -
--

CREATE TYPE public.badge_formula AS ENUM (
    'default',
    'linear',
    'fibonacci'
);


--
-- Name: badge_type; Type: TYPE; Schema: public; Owner: -
--

CREATE TYPE public.badge_type AS ENUM (
    'bottle',
    'region',
    'category',
    'age',
    'entity',
    'everyTasting'
);


--
-- Name: category; Type: TYPE; Schema: public; Owner: -
--

CREATE TYPE public.category AS ENUM (
    'blend',
    'bourbon',
    'rye',
    'single_grain',
    'single_malt',
    'spirit',
    'single_pot_still'
);


--
-- Name: content_source; Type: TYPE; Schema: public; Owner: -
--

CREATE TYPE public.content_source AS ENUM (
    'generated',
    'user'
);


--
-- Name: currency; Type: TYPE; Schema: public; Owner: -
--

CREATE TYPE public.currency AS ENUM (
    'usd',
    'gbp',
    'eur'
);


--
-- Name: entity_type; Type: TYPE; Schema: public; Owner: -
--

CREATE TYPE public.entity_type AS ENUM (
    'brand',
    'distiller',
    'bottler'
);


--
-- Name: external_site_type; Type: TYPE; Schema: public; Owner: -
--

CREATE TYPE public.external_site_type AS ENUM (
    'astorwines',
    'healthyspirits',
    'totalwines',
    'woodencork',
    'whiskyadvocate',
    'smws',
    'smwsa',
    'totalwine',
    'reservebar'
);


--
-- Name: flavor_profile; Type: TYPE; Schema: public; Owner: -
--

CREATE TYPE public.flavor_profile AS ENUM (
    'young_spritely',
    'sweet_fruit_mellow',
    'spicy_sweet',
    'spicy_dry',
    'deep_rich_dried_fruit',
    'old_dignified',
    'light_delicate',
    'juicy_oak_vanilla',
    'oily_coastal',
    'lightly_peated',
    'peated',
    'heavily_peated'
);


--
-- Name: follow_status; Type: TYPE; Schema: public; Owner: -
--

CREATE TYPE public.follow_status AS ENUM (
    'none',
    'pending',
    'following'
);


--
-- Name: identity_provider; Type: TYPE; Schema: public; Owner: -
--

CREATE TYPE public.identity_provider AS ENUM (
    'google'
);


--
-- Name: notification_type; Type: TYPE; Schema: public; Owner: -
--

CREATE TYPE public.notification_type AS ENUM (
    'comment',
    'toast',
    'friend_request'
);


--
-- Name: object_type; Type: TYPE; Schema: public; Owner: -
--

CREATE TYPE public.object_type AS ENUM (
    'bottle',
    'edition',
    'entity',
    'tasting',
    'toast',
    'follow',
    'comment'
);


--
-- Name: price_scraper_type; Type: TYPE; Schema: public; Owner: -
--

CREATE TYPE public.price_scraper_type AS ENUM (
    'totalwines',
    'woodencork',
    'astorwines',
    'healthyspirits'
);


--
-- Name: servingStyle; Type: TYPE; Schema: public; Owner: -
--

CREATE TYPE public."servingStyle" AS ENUM (
    'neat',
    'rocks',
    'splash'
);


--
-- Name: tag_category; Type: TYPE; Schema: public; Owner: -
--

CREATE TYPE public.tag_category AS ENUM (
    'cereal',
    'fruity',
    'floral',
    'peaty',
    'feinty',
    'sulphury',
    'woody',
    'winey'
);


--
-- Name: type; Type: TYPE; Schema: public; Owner: -
--

CREATE TYPE public.type AS ENUM (
    'add',
    'update',
    'delete'
);


SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: __drizzle_migrations; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.__drizzle_migrations (
    id integer NOT NULL,
    hash text NOT NULL,
    created_at bigint
);


--
-- Name: __drizzle_migrations_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.__drizzle_migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: __drizzle_migrations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.__drizzle_migrations_id_seq OWNED BY public.__drizzle_migrations.id;


--
-- Name: badge_award; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.badge_award (
    id bigint NOT NULL,
    badge_id bigint NOT NULL,
    user_id bigint NOT NULL,
    xp smallint DEFAULT 0 NOT NULL,
    level smallint DEFAULT 0 NOT NULL,
    created_at timestamp without time zone DEFAULT now() NOT NULL
);


--
-- Name: badge_award_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.badge_award_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: badge_award_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.badge_award_id_seq OWNED BY public.badge_award.id;


--
-- Name: badge_award_tracked_object; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.badge_award_tracked_object (
    id bigint NOT NULL,
    award_id bigint NOT NULL,
    object_type public.badge_award_object_type NOT NULL,
    object_id bigint,
    created_at timestamp without time zone DEFAULT now() NOT NULL
);


--
-- Name: badge_award_tracked_object_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.badge_award_tracked_object_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: badge_award_tracked_object_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.badge_award_tracked_object_id_seq OWNED BY public.badge_award_tracked_object.id;


--
-- Name: badges; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.badges (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    checks jsonb DEFAULT '[]'::jsonb NOT NULL,
    image_url text,
    max_level integer DEFAULT 50 NOT NULL,
    tracker public.badge_award_object_type DEFAULT 'bottle'::public.badge_award_object_type NOT NULL,
    formula public.badge_formula DEFAULT 'default'::public.badge_formula NOT NULL
);


--
-- Name: badges_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.badges_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: badges_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.badges_id_seq OWNED BY public.badges.id;


--
-- Name: bottle; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.bottle (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    category public.category,
    brand_id bigint NOT NULL,
    stated_age smallint,
    created_at timestamp without time zone DEFAULT now() NOT NULL,
    created_by_id bigint NOT NULL,
    total_tastings bigint DEFAULT 0 NOT NULL,
    bottler_id bigint,
    full_name character varying(255) NOT NULL,
    avg_rating double precision,
    description text,
    tasting_notes jsonb,
    suggested_tags character varying(64)[] DEFAULT ARRAY[]::character varying[] NOT NULL,
    flavor_profile public.flavor_profile,
    description_src public.content_source,
    search_vector tsvector,
    updated_at timestamp without time zone DEFAULT now() NOT NULL,
    vintage_year smallint,
    cask_size character varying(255),
    cask_type character varying(255),
    cask_fill character varying(255),
    release_year smallint,
    single_cask boolean,
    cask_strength boolean,
    edition character varying(255),
    image_url text
);


--
-- Name: bottle_alias; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.bottle_alias (
    bottle_id bigint,
    name character varying(255) NOT NULL,
    created_at timestamp without time zone DEFAULT now() NOT NULL,
    embedding public.vector(3072),
    ignored boolean DEFAULT false
);


--
-- Name: bottle_distiller; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.bottle_distiller (
    bottle_id bigint NOT NULL,
    distiller_id bigint NOT NULL
);


--
-- Name: bottle_flavor_profile; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.bottle_flavor_profile (
    bottle_id bigint NOT NULL,
    flavor_profile public.flavor_profile NOT NULL,
    count integer DEFAULT 0 NOT NULL
);


--
-- Name: bottle_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.bottle_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: bottle_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.bottle_id_seq OWNED BY public.bottle.id;


--
-- Name: bottle_tag; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.bottle_tag (
    bottle_id bigint NOT NULL,
    tag character varying(64) NOT NULL,
    count integer DEFAULT 0 NOT NULL
);


--
-- Name: bottle_tombstone; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.bottle_tombstone (
    bottle_id bigint NOT NULL,
    new_bottle_id bigint
);


--
-- Name: change; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.change (
    id bigint NOT NULL,
    object_id bigint NOT NULL,
    object_type public.object_type NOT NULL,
    data jsonb DEFAULT '{}'::jsonb NOT NULL,
    created_at timestamp without time zone DEFAULT now() NOT NULL,
    created_by_id bigint NOT NULL,
    type public.type DEFAULT 'add'::public.type NOT NULL,
    display_name text
);


--
-- Name: change_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.change_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: change_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.change_id_seq OWNED BY public.change.id;


--
-- Name: collection; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.collection (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    created_at timestamp without time zone DEFAULT now() NOT NULL,
    created_by_id bigint NOT NULL,
    total_bottles bigint DEFAULT 0 NOT NULL
);


--
-- Name: collection_bottle; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.collection_bottle (
    collection_id bigint NOT NULL,
    bottle_id bigint NOT NULL,
    id bigint NOT NULL,
    created_at timestamp without time zone DEFAULT now() NOT NULL
);


--
-- Name: collection_bottle_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.collection_bottle_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: collection_bottle_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.collection_bottle_id_seq OWNED BY public.collection_bottle.id;


--
-- Name: collection_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.collection_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: collection_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.collection_id_seq OWNED BY public.collection.id;


--
-- Name: comments; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.comments (
    id bigint NOT NULL,
    tasting_id bigint NOT NULL,
    comment text NOT NULL,
    created_at timestamp without time zone DEFAULT now() NOT NULL,
    created_by_id bigint NOT NULL
);


--
-- Name: comments_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.comments_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: comments_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.comments_id_seq OWNED BY public.comments.id;


--
-- Name: country; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.country (
    id bigint NOT NULL,
    name text NOT NULL,
    slug text NOT NULL,
    location public.geometry(Point,4326),
    total_bottles bigint DEFAULT 0 NOT NULL,
    total_distillers bigint DEFAULT 0 NOT NULL,
    description text,
    description_src public.content_source,
    summary text,
    alpha2 character(2)
);


--
-- Name: country_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.country_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: country_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.country_id_seq OWNED BY public.country.id;


--
-- Name: entity; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.entity (
    id bigint NOT NULL,
    name text NOT NULL,
    country text,
    region text,
    type public.entity_type[] NOT NULL,
    created_at timestamp without time zone DEFAULT now() NOT NULL,
    created_by_id bigint NOT NULL,
    total_bottles bigint DEFAULT 0 NOT NULL,
    total_tastings bigint DEFAULT 0 NOT NULL,
    location public.geometry(Point,4326),
    description text,
    year_established smallint,
    website character varying(255),
    short_name text,
    description_src public.content_source,
    address text,
    country_id bigint,
    search_vector tsvector,
    updated_at timestamp without time zone DEFAULT now() NOT NULL,
    region_id bigint
);


--
-- Name: entity_alias; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.entity_alias (
    entity_id bigint,
    name character varying(255) NOT NULL,
    created_at timestamp without time zone DEFAULT now() NOT NULL
);


--
-- Name: entity_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.entity_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: entity_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.entity_id_seq OWNED BY public.entity.id;


--
-- Name: entity_tombstone; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.entity_tombstone (
    entity_id bigint NOT NULL,
    new_entity_id bigint
);


--
-- Name: event; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.event (
    id bigint NOT NULL,
    name text NOT NULL,
    date_start date NOT NULL,
    date_end date,
    description text,
    website character varying(255),
    country_id bigint,
    address text,
    location public.geometry(Point,4326),
    repeats boolean DEFAULT false NOT NULL,
    created_at timestamp without time zone DEFAULT now() NOT NULL
);


--
-- Name: event_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.event_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: event_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.event_id_seq OWNED BY public.event.id;


--
-- Name: external_site; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.external_site (
    id bigint NOT NULL,
    type public.external_site_type NOT NULL,
    name text NOT NULL,
    last_run_at timestamp without time zone,
    created_at timestamp without time zone DEFAULT now() NOT NULL,
    next_run_at timestamp without time zone,
    run_every integer DEFAULT 60
);


--
-- Name: external_site_config; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.external_site_config (
    external_site_id bigint NOT NULL,
    key character varying(255) NOT NULL,
    data jsonb NOT NULL,
    created_at timestamp without time zone DEFAULT now() NOT NULL,
    updated_at timestamp without time zone DEFAULT now() NOT NULL
);


--
-- Name: external_site_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.external_site_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: external_site_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.external_site_id_seq OWNED BY public.external_site.id;


--
-- Name: flight; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.flight (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    description text,
    public boolean DEFAULT false NOT NULL,
    created_at timestamp without time zone DEFAULT now() NOT NULL,
    created_by_id bigint NOT NULL,
    public_id character varying(12) NOT NULL
);


--
-- Name: flight_bottle; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.flight_bottle (
    flight_id bigint NOT NULL,
    bottle_id bigint NOT NULL
);


--
-- Name: flight_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.flight_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: flight_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.flight_id_seq OWNED BY public.flight.id;


--
-- Name: follow; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.follow (
    from_user_id bigint NOT NULL,
    to_user_id bigint NOT NULL,
    status public.follow_status DEFAULT 'pending'::public.follow_status NOT NULL,
    created_at timestamp without time zone DEFAULT now() NOT NULL,
    id bigint NOT NULL
);


--
-- Name: follow_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.follow_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: follow_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.follow_id_seq OWNED BY public.follow.id;


--
-- Name: identity; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.identity (
    id bigint NOT NULL,
    provider public.identity_provider NOT NULL,
    external_id text NOT NULL,
    user_id bigint NOT NULL
);


--
-- Name: identity_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.identity_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: identity_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.identity_id_seq OWNED BY public.identity.id;


--
-- Name: notifications; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.notifications (
    id bigint NOT NULL,
    user_id bigint NOT NULL,
    from_user_id bigint,
    object_id bigint NOT NULL,
    type public.notification_type NOT NULL,
    created_at timestamp without time zone NOT NULL,
    read boolean DEFAULT false NOT NULL
);


--
-- Name: notifications_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.notifications_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: notifications_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.notifications_id_seq OWNED BY public.notifications.id;


--
-- Name: region; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.region (
    id bigint NOT NULL,
    name text NOT NULL,
    slug text NOT NULL,
    country_id bigint NOT NULL,
    location public.geometry(Point,4326),
    description text,
    description_src public.content_source,
    total_bottles bigint DEFAULT 0 NOT NULL,
    total_distillers bigint DEFAULT 0 NOT NULL
);


--
-- Name: region_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.region_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: region_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.region_id_seq OWNED BY public.region.id;


--
-- Name: review; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.review (
    id bigint NOT NULL,
    external_site_id bigint NOT NULL,
    name text NOT NULL,
    bottle_id bigint,
    rating integer NOT NULL,
    issue text NOT NULL,
    url text NOT NULL,
    created_at timestamp without time zone DEFAULT now() NOT NULL,
    updated_at timestamp without time zone DEFAULT now() NOT NULL,
    hidden boolean DEFAULT false
);


--
-- Name: review_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.review_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: review_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.review_id_seq OWNED BY public.review.id;


--
-- Name: store_price; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.store_price (
    id bigint NOT NULL,
    external_site_id bigint NOT NULL,
    name text NOT NULL,
    bottle_id bigint,
    price integer NOT NULL,
    url text NOT NULL,
    created_at timestamp without time zone DEFAULT now() NOT NULL,
    updated_at timestamp without time zone DEFAULT now() NOT NULL,
    volume integer NOT NULL,
    currency public.currency NOT NULL,
    hidden boolean DEFAULT false,
    image_url text
);


--
-- Name: store_price_history; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.store_price_history (
    id bigint NOT NULL,
    price_id bigint NOT NULL,
    price integer NOT NULL,
    date date DEFAULT now() NOT NULL,
    volume integer NOT NULL,
    currency public.currency DEFAULT 'usd'::public.currency NOT NULL
);


--
-- Name: store_price_history_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.store_price_history_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: store_price_history_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.store_price_history_id_seq OWNED BY public.store_price_history.id;


--
-- Name: store_price_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.store_price_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: store_price_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.store_price_id_seq OWNED BY public.store_price.id;


--
-- Name: tag; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.tag (
    name character varying(64) NOT NULL,
    synonyms character varying(64)[] DEFAULT '{}'::character varying[] NOT NULL,
    tag_category public.tag_category NOT NULL,
    flavor_profile public.flavor_profile[] DEFAULT '{}'::public.flavor_profile[] NOT NULL
);


--
-- Name: tasting; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.tasting (
    id bigint NOT NULL,
    bottle_id bigint NOT NULL,
    notes text,
    tags character varying(64)[] DEFAULT ARRAY[]::character varying[] NOT NULL,
    rating double precision,
    image_url text,
    created_at timestamp without time zone DEFAULT now() NOT NULL,
    created_by_id bigint NOT NULL,
    toasts integer DEFAULT 0 NOT NULL,
    comments integer DEFAULT 0 NOT NULL,
    serving_style public."servingStyle",
    friends bigint[] DEFAULT ARRAY[]::bigint[] NOT NULL,
    flight_id bigint,
    color integer
);


--
-- Name: tasting_badge_award; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.tasting_badge_award (
    id bigint NOT NULL,
    tasting_id bigint NOT NULL,
    award_id bigint NOT NULL,
    level smallint NOT NULL,
    created_at timestamp without time zone DEFAULT now() NOT NULL
);


--
-- Name: tasting_badge_award_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.tasting_badge_award_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: tasting_badge_award_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.tasting_badge_award_id_seq OWNED BY public.tasting_badge_award.id;


--
-- Name: tasting_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.tasting_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: tasting_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.tasting_id_seq OWNED BY public.tasting.id;


--
-- Name: toasts; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.toasts (
    tasting_id bigint NOT NULL,
    created_at timestamp without time zone DEFAULT now() NOT NULL,
    created_by_id bigint NOT NULL,
    id bigint NOT NULL
);


--
-- Name: toasts_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.toasts_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: toasts_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.toasts_id_seq OWNED BY public.toasts.id;


--
-- Name: user; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public."user" (
    id bigint NOT NULL,
    email text NOT NULL,
    password_hash character varying(256),
    picture_url text,
    active boolean DEFAULT true NOT NULL,
    admin boolean DEFAULT false NOT NULL,
    created_at timestamp without time zone DEFAULT now() NOT NULL,
    mod boolean DEFAULT false NOT NULL,
    username text NOT NULL,
    private boolean DEFAULT false NOT NULL,
    notify_comments boolean DEFAULT true,
    verified boolean DEFAULT false NOT NULL
);


--
-- Name: user_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.user_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: user_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.user_id_seq OWNED BY public."user".id;


--
-- Name: __drizzle_migrations id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.__drizzle_migrations ALTER COLUMN id SET DEFAULT nextval('public.__drizzle_migrations_id_seq'::regclass);


--
-- Name: badge_award id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.badge_award ALTER COLUMN id SET DEFAULT nextval('public.badge_award_id_seq'::regclass);


--
-- Name: badge_award_tracked_object id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.badge_award_tracked_object ALTER COLUMN id SET DEFAULT nextval('public.badge_award_tracked_object_id_seq'::regclass);


--
-- Name: badges id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.badges ALTER COLUMN id SET DEFAULT nextval('public.badges_id_seq'::regclass);


--
-- Name: bottle id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.bottle ALTER COLUMN id SET DEFAULT nextval('public.bottle_id_seq'::regclass);


--
-- Name: change id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.change ALTER COLUMN id SET DEFAULT nextval('public.change_id_seq'::regclass);


--
-- Name: collection id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.collection ALTER COLUMN id SET DEFAULT nextval('public.collection_id_seq'::regclass);


--
-- Name: collection_bottle id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.collection_bottle ALTER COLUMN id SET DEFAULT nextval('public.collection_bottle_id_seq'::regclass);


--
-- Name: comments id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.comments ALTER COLUMN id SET DEFAULT nextval('public.comments_id_seq'::regclass);


--
-- Name: country id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.country ALTER COLUMN id SET DEFAULT nextval('public.country_id_seq'::regclass);


--
-- Name: entity id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.entity ALTER COLUMN id SET DEFAULT nextval('public.entity_id_seq'::regclass);


--
-- Name: event id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.event ALTER COLUMN id SET DEFAULT nextval('public.event_id_seq'::regclass);


--
-- Name: external_site id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.external_site ALTER COLUMN id SET DEFAULT nextval('public.external_site_id_seq'::regclass);


--
-- Name: flight id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.flight ALTER COLUMN id SET DEFAULT nextval('public.flight_id_seq'::regclass);


--
-- Name: follow id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.follow ALTER COLUMN id SET DEFAULT nextval('public.follow_id_seq'::regclass);


--
-- Name: identity id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.identity ALTER COLUMN id SET DEFAULT nextval('public.identity_id_seq'::regclass);


--
-- Name: notifications id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.notifications ALTER COLUMN id SET DEFAULT nextval('public.notifications_id_seq'::regclass);


--
-- Name: region id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.region ALTER COLUMN id SET DEFAULT nextval('public.region_id_seq'::regclass);


--
-- Name: review id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.review ALTER COLUMN id SET DEFAULT nextval('public.review_id_seq'::regclass);


--
-- Name: store_price id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.store_price ALTER COLUMN id SET DEFAULT nextval('public.store_price_id_seq'::regclass);


--
-- Name: store_price_history id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.store_price_history ALTER COLUMN id SET DEFAULT nextval('public.store_price_history_id_seq'::regclass);


--
-- Name: tasting id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tasting ALTER COLUMN id SET DEFAULT nextval('public.tasting_id_seq'::regclass);


--
-- Name: tasting_badge_award id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tasting_badge_award ALTER COLUMN id SET DEFAULT nextval('public.tasting_badge_award_id_seq'::regclass);


--
-- Name: toasts id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.toasts ALTER COLUMN id SET DEFAULT nextval('public.toasts_id_seq'::regclass);


--
-- Name: user id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public."user" ALTER COLUMN id SET DEFAULT nextval('public.user_id_seq'::regclass);


--
-- Name: __drizzle_migrations __drizzle_migrations_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.__drizzle_migrations
    ADD CONSTRAINT __drizzle_migrations_pkey PRIMARY KEY (id);


--
-- Name: badge_award badge_award_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.badge_award
    ADD CONSTRAINT badge_award_pkey PRIMARY KEY (id);


--
-- Name: badge_award_tracked_object badge_award_tracked_object_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.badge_award_tracked_object
    ADD CONSTRAINT badge_award_tracked_object_pkey PRIMARY KEY (id);


--
-- Name: badges badges_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.badges
    ADD CONSTRAINT badges_pkey PRIMARY KEY (id);


--
-- Name: bottle_distiller bottle_distiller_bottle_id_distiller_id; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.bottle_distiller
    ADD CONSTRAINT bottle_distiller_bottle_id_distiller_id PRIMARY KEY (bottle_id, distiller_id);


--
-- Name: bottle_flavor_profile bottle_flavor_profile_bottle_id_flavor_profile_pk; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.bottle_flavor_profile
    ADD CONSTRAINT bottle_flavor_profile_bottle_id_flavor_profile_pk PRIMARY KEY (bottle_id, flavor_profile);


--
-- Name: bottle bottle_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.bottle
    ADD CONSTRAINT bottle_pkey PRIMARY KEY (id);


--
-- Name: bottle_tag bottle_tag_bottle_id_tag; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.bottle_tag
    ADD CONSTRAINT bottle_tag_bottle_id_tag PRIMARY KEY (bottle_id, tag);


--
-- Name: bottle_tombstone bottle_tombstone_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.bottle_tombstone
    ADD CONSTRAINT bottle_tombstone_pkey PRIMARY KEY (bottle_id);


--
-- Name: change change_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.change
    ADD CONSTRAINT change_pkey PRIMARY KEY (id);


--
-- Name: collection_bottle collection_bottle_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.collection_bottle
    ADD CONSTRAINT collection_bottle_pkey PRIMARY KEY (id);


--
-- Name: collection collection_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.collection
    ADD CONSTRAINT collection_pkey PRIMARY KEY (id);


--
-- Name: comments comments_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.comments
    ADD CONSTRAINT comments_pkey PRIMARY KEY (id);


--
-- Name: country country_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.country
    ADD CONSTRAINT country_pkey PRIMARY KEY (id);


--
-- Name: entity entity_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.entity
    ADD CONSTRAINT entity_pkey PRIMARY KEY (id);


--
-- Name: entity_tombstone entity_tombstone_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.entity_tombstone
    ADD CONSTRAINT entity_tombstone_pkey PRIMARY KEY (entity_id);


--
-- Name: event event_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.event
    ADD CONSTRAINT event_pkey PRIMARY KEY (id);


--
-- Name: external_site_config external_site_config_external_site_id_key_pk; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.external_site_config
    ADD CONSTRAINT external_site_config_external_site_id_key_pk PRIMARY KEY (external_site_id, key);


--
-- Name: external_site external_site_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.external_site
    ADD CONSTRAINT external_site_pkey PRIMARY KEY (id);


--
-- Name: flight_bottle flight_bottle_flight_id_bottle_id; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.flight_bottle
    ADD CONSTRAINT flight_bottle_flight_id_bottle_id PRIMARY KEY (flight_id, bottle_id);


--
-- Name: flight flight_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.flight
    ADD CONSTRAINT flight_pkey PRIMARY KEY (id);


--
-- Name: follow follow_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.follow
    ADD CONSTRAINT follow_pkey PRIMARY KEY (id);


--
-- Name: identity identity_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.identity
    ADD CONSTRAINT identity_pkey PRIMARY KEY (id);


--
-- Name: notifications notifications_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.notifications
    ADD CONSTRAINT notifications_pkey PRIMARY KEY (id);


--
-- Name: region region_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.region
    ADD CONSTRAINT region_pkey PRIMARY KEY (id);


--
-- Name: review review_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.review
    ADD CONSTRAINT review_pkey PRIMARY KEY (id);


--
-- Name: review review_url_unique; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.review
    ADD CONSTRAINT review_url_unique UNIQUE (url);


--
-- Name: store_price_history store_price_history_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.store_price_history
    ADD CONSTRAINT store_price_history_pkey PRIMARY KEY (id);


--
-- Name: store_price store_price_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.store_price
    ADD CONSTRAINT store_price_pkey PRIMARY KEY (id);


--
-- Name: tag tag_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tag
    ADD CONSTRAINT tag_pkey PRIMARY KEY (name);


--
-- Name: tasting_badge_award tasting_badge_award_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tasting_badge_award
    ADD CONSTRAINT tasting_badge_award_pkey PRIMARY KEY (id);


--
-- Name: tasting tasting_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tasting
    ADD CONSTRAINT tasting_pkey PRIMARY KEY (id);


--
-- Name: user user_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public."user"
    ADD CONSTRAINT user_pkey PRIMARY KEY (id);


--
-- Name: badge_award_tracked_object_unq; Type: INDEX; Schema: public; Owner: -
--

CREATE UNIQUE INDEX badge_award_tracked_object_unq ON public.badge_award_tracked_object USING btree (award_id, object_type, object_id);


--
-- Name: badge_award_unq; Type: INDEX; Schema: public; Owner: -
--

CREATE UNIQUE INDEX badge_award_unq ON public.badge_award USING btree (badge_id, user_id);


--
-- Name: badge_name_unq; Type: INDEX; Schema: public; Owner: -
--

CREATE UNIQUE INDEX badge_name_unq ON public.badges USING btree (lower((name)::text));


--
-- Name: bottle_alias_bottle_idx; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX bottle_alias_bottle_idx ON public.bottle_alias USING btree (bottle_id);


--
-- Name: bottle_alias_name_idx; Type: INDEX; Schema: public; Owner: -
--

CREATE UNIQUE INDEX bottle_alias_name_idx ON public.bottle_alias USING btree (lower((name)::text));


--
-- Name: bottle_bottler_idx; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX bottle_bottler_idx ON public.bottle USING btree (bottler_id);


--
-- Name: bottle_brand_idx; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX bottle_brand_idx ON public.bottle USING btree (brand_id);


--
-- Name: bottle_category_idx; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX bottle_category_idx ON public.bottle USING btree (category);


--
-- Name: bottle_created_by_idx; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX bottle_created_by_idx ON public.bottle USING btree (created_by_id);


--
-- Name: bottle_flavor_profile_idx; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX bottle_flavor_profile_idx ON public.bottle USING btree (flavor_profile);


--
-- Name: bottle_search_idx; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX bottle_search_idx ON public.bottle USING gin (search_vector);


--
-- Name: change_created_by_idx; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX change_created_by_idx ON public.change USING btree (created_by_id);


--
-- Name: collection_bottle_bottle_idx; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX collection_bottle_bottle_idx ON public.collection_bottle USING btree (bottle_id);


--
-- Name: collection_bottle_unq; Type: INDEX; Schema: public; Owner: -
--

CREATE UNIQUE INDEX collection_bottle_unq ON public.collection_bottle USING btree (collection_id, bottle_id);


--
-- Name: collection_created_by_idx; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX collection_created_by_idx ON public.collection USING btree (created_by_id);


--
-- Name: collection_name_unq; Type: INDEX; Schema: public; Owner: -
--

CREATE UNIQUE INDEX collection_name_unq ON public.collection USING btree (name, created_by_id);


--
-- Name: comment_unq; Type: INDEX; Schema: public; Owner: -
--

CREATE UNIQUE INDEX comment_unq ON public.comments USING btree (tasting_id, created_by_id, created_at);


--
-- Name: country_name_unq; Type: INDEX; Schema: public; Owner: -
--

CREATE UNIQUE INDEX country_name_unq ON public.country USING btree (lower(name));


--
-- Name: country_slug_unq; Type: INDEX; Schema: public; Owner: -
--

CREATE UNIQUE INDEX country_slug_unq ON public.country USING btree (lower(slug));


--
-- Name: entity_alias_entity_idx; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX entity_alias_entity_idx ON public.entity_alias USING btree (entity_id);


--
-- Name: entity_alias_name_idx; Type: INDEX; Schema: public; Owner: -
--

CREATE UNIQUE INDEX entity_alias_name_idx ON public.entity_alias USING btree (lower((name)::text));


--
-- Name: entity_country_by_idx; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX entity_country_by_idx ON public.entity USING btree (country_id);


--
-- Name: entity_created_by_idx; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX entity_created_by_idx ON public.entity USING btree (created_by_id);


--
-- Name: entity_name_unq; Type: INDEX; Schema: public; Owner: -
--

CREATE UNIQUE INDEX entity_name_unq ON public.entity USING btree (lower(name));


--
-- Name: entity_region_idx; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX entity_region_idx ON public.entity USING btree (region_id);


--
-- Name: entity_search_idx; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX entity_search_idx ON public.entity USING gin (search_vector);


--
-- Name: event_country_id; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX event_country_id ON public.event USING btree (country_id);


--
-- Name: event_name_unq; Type: INDEX; Schema: public; Owner: -
--

CREATE UNIQUE INDEX event_name_unq ON public.event USING btree (date_start, lower(name));


--
-- Name: external_site_type; Type: INDEX; Schema: public; Owner: -
--

CREATE UNIQUE INDEX external_site_type ON public.external_site USING btree (type);


--
-- Name: flight_public_id; Type: INDEX; Schema: public; Owner: -
--

CREATE UNIQUE INDEX flight_public_id ON public.flight USING btree (public_id);


--
-- Name: follow_to_user_idx; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX follow_to_user_idx ON public.follow USING btree (to_user_id);


--
-- Name: follow_unq; Type: INDEX; Schema: public; Owner: -
--

CREATE UNIQUE INDEX follow_unq ON public.follow USING btree (from_user_id, to_user_id);


--
-- Name: identity_unq; Type: INDEX; Schema: public; Owner: -
--

CREATE UNIQUE INDEX identity_unq ON public.identity USING btree (provider, external_id);


--
-- Name: identity_user_idx; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX identity_user_idx ON public.identity USING btree (user_id);


--
-- Name: notifications_unq; Type: INDEX; Schema: public; Owner: -
--

CREATE UNIQUE INDEX notifications_unq ON public.notifications USING btree (user_id, object_id, type, created_at);


--
-- Name: region_country_idx; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX region_country_idx ON public.region USING btree (country_id);


--
-- Name: region_name_unq; Type: INDEX; Schema: public; Owner: -
--

CREATE UNIQUE INDEX region_name_unq ON public.region USING btree (country_id, lower(name));


--
-- Name: region_slug_unq; Type: INDEX; Schema: public; Owner: -
--

CREATE UNIQUE INDEX region_slug_unq ON public.region USING btree (country_id, lower(slug));


--
-- Name: review_bottle_idx; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX review_bottle_idx ON public.review USING btree (bottle_id);


--
-- Name: review_unq_name; Type: INDEX; Schema: public; Owner: -
--

CREATE UNIQUE INDEX review_unq_name ON public.review USING btree (external_site_id, lower(name), issue);


--
-- Name: store_price_bottle_idx; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX store_price_bottle_idx ON public.store_price USING btree (bottle_id);


--
-- Name: store_price_history_unq; Type: INDEX; Schema: public; Owner: -
--

CREATE UNIQUE INDEX store_price_history_unq ON public.store_price_history USING btree (price_id, volume, date);


--
-- Name: store_price_unq_name; Type: INDEX; Schema: public; Owner: -
--

CREATE UNIQUE INDEX store_price_unq_name ON public.store_price USING btree (external_site_id, lower(name), volume);


--
-- Name: tasting_badge_award_award_id; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX tasting_badge_award_award_id ON public.tasting_badge_award USING btree (award_id);


--
-- Name: tasting_badge_award_key; Type: INDEX; Schema: public; Owner: -
--

CREATE UNIQUE INDEX tasting_badge_award_key ON public.tasting_badge_award USING btree (tasting_id, award_id);


--
-- Name: tasting_bottle_idx; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX tasting_bottle_idx ON public.tasting USING btree (bottle_id);


--
-- Name: tasting_created_by_idx; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX tasting_created_by_idx ON public.tasting USING btree (created_by_id);


--
-- Name: tasting_flight_idx; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX tasting_flight_idx ON public.tasting USING btree (flight_id);


--
-- Name: tasting_unq; Type: INDEX; Schema: public; Owner: -
--

CREATE UNIQUE INDEX tasting_unq ON public.tasting USING btree (bottle_id, created_by_id, created_at);


--
-- Name: toast_unq; Type: INDEX; Schema: public; Owner: -
--

CREATE UNIQUE INDEX toast_unq ON public.toasts USING btree (tasting_id, created_by_id);


--
-- Name: user_email_unq; Type: INDEX; Schema: public; Owner: -
--

CREATE UNIQUE INDEX user_email_unq ON public."user" USING btree (lower(email));


--
-- Name: user_username_unq; Type: INDEX; Schema: public; Owner: -
--

CREATE UNIQUE INDEX user_username_unq ON public."user" USING btree (lower(username));


--
-- Name: badge_award badge_award_badge_id_badges_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.badge_award
    ADD CONSTRAINT badge_award_badge_id_badges_id_fk FOREIGN KEY (badge_id) REFERENCES public.badges(id);


--
-- Name: badge_award_tracked_object badge_award_tracked_object_award_id_badge_award_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.badge_award_tracked_object
    ADD CONSTRAINT badge_award_tracked_object_award_id_badge_award_id_fk FOREIGN KEY (award_id) REFERENCES public.badge_award(id);


--
-- Name: badge_award badge_award_user_id_user_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.badge_award
    ADD CONSTRAINT badge_award_user_id_user_id_fk FOREIGN KEY (user_id) REFERENCES public."user"(id);


--
-- Name: bottle_alias bottle_alias_bottle_id_bottle_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.bottle_alias
    ADD CONSTRAINT bottle_alias_bottle_id_bottle_id_fk FOREIGN KEY (bottle_id) REFERENCES public.bottle(id);


--
-- Name: bottle bottle_bottler_id_entity_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.bottle
    ADD CONSTRAINT bottle_bottler_id_entity_id_fk FOREIGN KEY (bottler_id) REFERENCES public.entity(id);


--
-- Name: bottle bottle_brand_id_entity_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.bottle
    ADD CONSTRAINT bottle_brand_id_entity_id_fk FOREIGN KEY (brand_id) REFERENCES public.entity(id);


--
-- Name: bottle bottle_created_by_id_user_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.bottle
    ADD CONSTRAINT bottle_created_by_id_user_id_fk FOREIGN KEY (created_by_id) REFERENCES public."user"(id);


--
-- Name: bottle_distiller bottle_distiller_bottle_id_bottle_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.bottle_distiller
    ADD CONSTRAINT bottle_distiller_bottle_id_bottle_id_fk FOREIGN KEY (bottle_id) REFERENCES public.bottle(id);


--
-- Name: bottle_distiller bottle_distiller_distiller_id_entity_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.bottle_distiller
    ADD CONSTRAINT bottle_distiller_distiller_id_entity_id_fk FOREIGN KEY (distiller_id) REFERENCES public.entity(id);


--
-- Name: bottle_flavor_profile bottle_flavor_profile_bottle_id_bottle_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.bottle_flavor_profile
    ADD CONSTRAINT bottle_flavor_profile_bottle_id_bottle_id_fk FOREIGN KEY (bottle_id) REFERENCES public.bottle(id);


--
-- Name: bottle_tag bottle_tag_bottle_id_bottle_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.bottle_tag
    ADD CONSTRAINT bottle_tag_bottle_id_bottle_id_fk FOREIGN KEY (bottle_id) REFERENCES public.bottle(id);


--
-- Name: change change_created_by_id_user_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.change
    ADD CONSTRAINT change_created_by_id_user_id_fk FOREIGN KEY (created_by_id) REFERENCES public."user"(id);


--
-- Name: collection_bottle collection_bottle_bottle_id_bottle_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.collection_bottle
    ADD CONSTRAINT collection_bottle_bottle_id_bottle_id_fk FOREIGN KEY (bottle_id) REFERENCES public.bottle(id);


--
-- Name: collection_bottle collection_bottle_collection_id_collection_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.collection_bottle
    ADD CONSTRAINT collection_bottle_collection_id_collection_id_fk FOREIGN KEY (collection_id) REFERENCES public.collection(id);


--
-- Name: collection collection_created_by_id_user_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.collection
    ADD CONSTRAINT collection_created_by_id_user_id_fk FOREIGN KEY (created_by_id) REFERENCES public."user"(id);


--
-- Name: comments comments_created_by_id_user_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.comments
    ADD CONSTRAINT comments_created_by_id_user_id_fk FOREIGN KEY (created_by_id) REFERENCES public."user"(id);


--
-- Name: comments comments_tasting_id_tasting_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.comments
    ADD CONSTRAINT comments_tasting_id_tasting_id_fk FOREIGN KEY (tasting_id) REFERENCES public.tasting(id);


--
-- Name: entity_alias entity_alias_entity_id_entity_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.entity_alias
    ADD CONSTRAINT entity_alias_entity_id_entity_id_fk FOREIGN KEY (entity_id) REFERENCES public.entity(id);


--
-- Name: entity entity_country_id_country_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.entity
    ADD CONSTRAINT entity_country_id_country_id_fk FOREIGN KEY (country_id) REFERENCES public.country(id);


--
-- Name: entity entity_created_by_id_user_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.entity
    ADD CONSTRAINT entity_created_by_id_user_id_fk FOREIGN KEY (created_by_id) REFERENCES public."user"(id);


--
-- Name: entity entity_region_id_region_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.entity
    ADD CONSTRAINT entity_region_id_region_id_fk FOREIGN KEY (region_id) REFERENCES public.region(id);


--
-- Name: event event_country_id_country_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.event
    ADD CONSTRAINT event_country_id_country_id_fk FOREIGN KEY (country_id) REFERENCES public.country(id);


--
-- Name: external_site_config external_site_config_external_site_id_external_site_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.external_site_config
    ADD CONSTRAINT external_site_config_external_site_id_external_site_id_fk FOREIGN KEY (external_site_id) REFERENCES public.external_site(id);


--
-- Name: flight_bottle flight_bottle_bottle_id_bottle_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.flight_bottle
    ADD CONSTRAINT flight_bottle_bottle_id_bottle_id_fk FOREIGN KEY (bottle_id) REFERENCES public.bottle(id);


--
-- Name: flight_bottle flight_bottle_flight_id_flight_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.flight_bottle
    ADD CONSTRAINT flight_bottle_flight_id_flight_id_fk FOREIGN KEY (flight_id) REFERENCES public.flight(id);


--
-- Name: flight flight_created_by_id_user_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.flight
    ADD CONSTRAINT flight_created_by_id_user_id_fk FOREIGN KEY (created_by_id) REFERENCES public."user"(id);


--
-- Name: follow follow_from_user_id_user_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.follow
    ADD CONSTRAINT follow_from_user_id_user_id_fk FOREIGN KEY (from_user_id) REFERENCES public."user"(id);


--
-- Name: follow follow_to_user_id_user_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.follow
    ADD CONSTRAINT follow_to_user_id_user_id_fk FOREIGN KEY (to_user_id) REFERENCES public."user"(id);


--
-- Name: identity identity_user_id_user_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.identity
    ADD CONSTRAINT identity_user_id_user_id_fk FOREIGN KEY (user_id) REFERENCES public."user"(id);


--
-- Name: notifications notifications_from_user_id_user_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.notifications
    ADD CONSTRAINT notifications_from_user_id_user_id_fk FOREIGN KEY (from_user_id) REFERENCES public."user"(id);


--
-- Name: notifications notifications_user_id_user_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.notifications
    ADD CONSTRAINT notifications_user_id_user_id_fk FOREIGN KEY (user_id) REFERENCES public."user"(id);


--
-- Name: region region_country_id_country_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.region
    ADD CONSTRAINT region_country_id_country_id_fk FOREIGN KEY (country_id) REFERENCES public.country(id);


--
-- Name: review review_bottle_id_bottle_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.review
    ADD CONSTRAINT review_bottle_id_bottle_id_fk FOREIGN KEY (bottle_id) REFERENCES public.bottle(id);


--
-- Name: review review_external_site_id_external_site_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.review
    ADD CONSTRAINT review_external_site_id_external_site_id_fk FOREIGN KEY (external_site_id) REFERENCES public.external_site(id);


--
-- Name: store_price store_price_bottle_id_bottle_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.store_price
    ADD CONSTRAINT store_price_bottle_id_bottle_id_fk FOREIGN KEY (bottle_id) REFERENCES public.bottle(id);


--
-- Name: store_price store_price_external_site_id_external_site_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.store_price
    ADD CONSTRAINT store_price_external_site_id_external_site_id_fk FOREIGN KEY (external_site_id) REFERENCES public.external_site(id);


--
-- Name: store_price_history store_price_history_price_id_store_price_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.store_price_history
    ADD CONSTRAINT store_price_history_price_id_store_price_id_fk FOREIGN KEY (price_id) REFERENCES public.store_price(id);


--
-- Name: tasting_badge_award tasting_badge_award_award_id_badge_award_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tasting_badge_award
    ADD CONSTRAINT tasting_badge_award_award_id_badge_award_id_fk FOREIGN KEY (award_id) REFERENCES public.badge_award(id);


--
-- Name: tasting_badge_award tasting_badge_award_tasting_id_tasting_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tasting_badge_award
    ADD CONSTRAINT tasting_badge_award_tasting_id_tasting_id_fk FOREIGN KEY (tasting_id) REFERENCES public.tasting(id);


--
-- Name: tasting tasting_bottle_id_bottle_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tasting
    ADD CONSTRAINT tasting_bottle_id_bottle_id_fk FOREIGN KEY (bottle_id) REFERENCES public.bottle(id);


--
-- Name: tasting tasting_created_by_id_user_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tasting
    ADD CONSTRAINT tasting_created_by_id_user_id_fk FOREIGN KEY (created_by_id) REFERENCES public."user"(id);


--
-- Name: tasting tasting_flight_id_flight_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tasting
    ADD CONSTRAINT tasting_flight_id_flight_id_fk FOREIGN KEY (flight_id) REFERENCES public.flight(id);


--
-- Name: toasts toasts_created_by_id_user_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.toasts
    ADD CONSTRAINT toasts_created_by_id_user_id_fk FOREIGN KEY (created_by_id) REFERENCES public."user"(id);


--
-- Name: toasts toasts_tasting_id_tasting_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.toasts
    ADD CONSTRAINT toasts_tasting_id_tasting_id_fk FOREIGN KEY (tasting_id) REFERENCES public.tasting(id);


--
-- PostgreSQL database dump complete
--

