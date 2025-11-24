/*
Quadro de Missões
*/

/* TABELA locais (Tabela Fixa 1) */
CREATE TABLE locais (
  id int AUTO_INCREMENT NOT NULL,
  nome varchar(50) NOT NULL,
  CONSTRAINT pk_locais PRIMARY KEY (id)
);

/* INSERTs locais */
INSERT INTO locais (nome) VALUES ('Vila do Início');
INSERT INTO locais (nome) VALUES ('Castelo Real');
INSERT INTO locais (nome) VALUES ('Mina Abandonada');
INSERT INTO locais (nome) VALUES ('Floresta Sombria');


/* TABELA tipos_missao (Tabela Fixa 2) */
CREATE TABLE tipos_missao (
  id int AUTO_INCREMENT NOT NULL,
  nome varchar(50) NOT NULL,
  CONSTRAINT pk_tipos_missao PRIMARY KEY (id)
);

/* INSERTs tipos_missao */
INSERT INTO tipos_missao (nome) VALUES ('Caça');
INSERT INTO tipos_missao (nome) VALUES ('Coleta');
INSERT INTO tipos_missao (nome) VALUES ('Escolta');
INSERT INTO tipos_missao (nome) VALUES ('Investigação');


/* TABELA missoes (Tabela do CRUD) */
CREATE TABLE missoes (
  id int AUTO_INCREMENT NOT NULL,
  titulo_missao varchar(100) NOT NULL,
  recompensa_ouro decimal(10,2) NOT NULL,
  dificuldade varchar(1) NOT NULL, /* E=Easy, N=Normal, H=Hard, S=Super */
  id_local int NOT NULL,
  id_tipo_missao int NOT NULL,
  CONSTRAINT pk_missoes PRIMARY KEY (id)
);

/* CRIAÇÃO DAS RELAÇÕES (Chaves Estrangeiras) */
ALTER TABLE missoes ADD CONSTRAINT fk_local FOREIGN KEY (id_local) REFERENCES locais (id);
ALTER TABLE missoes ADD CONSTRAINT fk_tipo FOREIGN KEY (id_tipo_missao) REFERENCES tipos_missao (id);