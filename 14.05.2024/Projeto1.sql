PGDMP      2                |            postgres    16.2    16.2     �           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            �           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            �           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            �           1262    5    postgres    DATABASE        CREATE DATABASE postgres WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'Portuguese_Brazil.1252';
    DROP DATABASE postgres;
                postgres    false            �           0    0    DATABASE postgres    COMMENT     N   COMMENT ON DATABASE postgres IS 'default administrative connection database';
                   postgres    false    4792                        2615    2200    public    SCHEMA        CREATE SCHEMA public;
    DROP SCHEMA public;
                pg_database_owner    false            �           0    0    SCHEMA public    COMMENT     6   COMMENT ON SCHEMA public IS 'standard public schema';
                   pg_database_owner    false    5            �            1259    18927    clientes    TABLE       CREATE TABLE public.clientes (
    codcli character(3) NOT NULL,
    nome character varying(40) NOT NULL,
    endereco character varying(50) NOT NULL,
    cidade character varying(20) NOT NULL,
    estado character(2) NOT NULL,
    cep character(9) NOT NULL
);
    DROP TABLE public.clientes;
       public         heap    postgres    false    5            �            1259    18932    venda    TABLE     �   CREATE TABLE public.venda (
    duplic character(6) NOT NULL,
    valor numeric(10,2) NOT NULL,
    vencto date NOT NULL,
    codcli character(3) NOT NULL
);
    DROP TABLE public.venda;
       public         heap    postgres    false    5                       2606    18931    clientes clientes_pkey 
   CONSTRAINT     X   ALTER TABLE ONLY public.clientes
    ADD CONSTRAINT clientes_pkey PRIMARY KEY (codcli);
 @   ALTER TABLE ONLY public.clientes DROP CONSTRAINT clientes_pkey;
       public            postgres    false    216            "           2606    18936    venda venda_pkey 
   CONSTRAINT     R   ALTER TABLE ONLY public.venda
    ADD CONSTRAINT venda_pkey PRIMARY KEY (duplic);
 :   ALTER TABLE ONLY public.venda DROP CONSTRAINT venda_pkey;
       public            postgres    false    217                        1259    18942    idx_codcli_venda    INDEX     D   CREATE INDEX idx_codcli_venda ON public.venda USING btree (codcli);
 $   DROP INDEX public.idx_codcli_venda;
       public            postgres    false    217            #           2606    18937    venda venda_codcli_fkey    FK CONSTRAINT     |   ALTER TABLE ONLY public.venda
    ADD CONSTRAINT venda_codcli_fkey FOREIGN KEY (codcli) REFERENCES public.clientes(codcli);
 A   ALTER TABLE ONLY public.venda DROP CONSTRAINT venda_codcli_fkey;
       public          postgres    false    4639    217    216           