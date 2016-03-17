CREATE TABLE identifiants
(ident varchar(20) primary key,
mdp varchar(100),
nom varchar(20),
prenom varchar(20),
mel varchar(50),
numtel varchar(20),
type varchar(20),
info varchar(20));
/*le type d'identifiant doit etre administrateur ou user ou userInterne*/

CREATE TABLE messageContact
(sujet varchar(50) primary key,
nom varchar(20),
prenom varchar(20),
mel varchar(50),
numtel varchar(20),
contenu varchar(20),
heureRep varchar(20));

CREATE TABLE maillist
(mel varchar(50) primary key,
sujet varchar(30),
alias varchar(30));

CREATE TABLE menuItems
(nomItem varchar(50) primary key,
type varchar(20));

CREATE TABLE journal
(nomItem varchar(40) primary key,
contenu text);

CREATE TABLE depot
(nom varchar(50),
file varchar(60),
domaine varchar(50) references menuItems(nomItem),
create_time timestamp not null,
PRIMARY KEY (nom, domaine));

CREATE TABLE articles
(create_time timestamp not null,
titre varchar(30) primary key,
description text,
contenu text,
file varchar(40),
menu_item varchar(50) references menuItems(nomItem),
file_tag varchar(20),
end_date date not null);


CREATE TABLE serviceAlerte
(nomService varchar(50) primary key,
type varchar(20),
info varchar(50));

CREATE TABLE abonnementAlerte
(ident varchar(50) references identifiants(ident), 
serviceAlerte varchar(50) references serviceAlerte(nomService),
create_time timestamp,
info varchar(50));

INSERT INTO identifiants(ident,mdp,nom,prenom,type) VALUES ('test', '$2y$10$eF2f155BlnF2i53fBAOVp.gHDzE/93jb.SB0yGeaC6BpgANrPO9qG','Admin','test','administrateur');

INSERT INTO menuItems(nomItem,type) VALUES ('Petit_journal','article');
INSERT INTO menuItems(nomItem,type) VALUES ('ALAE_Vignemont','article');
INSERT INTO menuItems(nomItem,type) VALUES ('Tir_à_l''arc','article');
INSERT INTO menuItems(nomItem,type) VALUES ('Festi_Vignemont','article');
INSERT INTO menuItems(nomItem,type) VALUES ('Les_Vignes_Club','article');

INSERT INTO menuItems(nomItem,type) VALUES ('Histoire','journal');
INSERT INTO menuItems(nomItem,type) VALUES ('Aujourd''hui','journal');
INSERT INTO menuItems(nomItem,type) VALUES ('La_mairie','journal');
INSERT INTO menuItems(nomItem,type) VALUES ('L''école','journal');
INSERT INTO menuItems(nomItem,type) VALUES ('Salle_communale_Marcel_Bertins','journal');
INSERT INTO menuItems(nomItem,type) VALUES ('L''église','journal');
INSERT INTO menuItems(nomItem,type) VALUES ('Le_cimetière','journal');
INSERT INTO menuItems(nomItem,type) VALUES ('Livret_d''accueil','journal');
INSERT INTO menuItems(nomItem,type) VALUES ('Accueil','journal');

INSERT INTO menuItems(nomItem,type) VALUES ('Les_conseillers_municipaux','depot');
INSERT INTO menuItems(nomItem,type) VALUES ('Comptes_rendus_de_conseil_municipal','depot');
INSERT INTO menuItems(nomItem,type) VALUES ('Arrêtés_municipaux','depot');
INSERT INTO menuItems(nomItem,type) VALUES ('Délibérations','depot');
INSERT INTO menuItems(nomItem,type) VALUES ('Document_interne','depot_interne');