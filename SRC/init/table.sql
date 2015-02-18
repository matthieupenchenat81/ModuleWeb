DROP TABLE IF EXISTS password_resets;
DROP TABLE IF EXISTS description;
DROP TABLE IF EXISTS assolisteaoeuvre;
DROP TABLE IF EXISTS assolisteajeu;
DROP TABLE IF EXISTS listeoeuvre;
DROP TABLE IF EXISTS assodesignationaoeuvre;
DROP TABLE IF EXISTS assoauteuraoeuvre;
DROP TABLE IF EXISTS assodatationaoeuvre;
DROP TABLE IF EXISTS oeuvre;
DROP TABLE IF EXISTS auteur;
DROP TABLE IF EXISTS designation;
DROP TABLE IF EXISTS technique;
DROP TABLE IF EXISTS domaine;
DROP TABLE IF EXISTS matiere;
DROP TABLE IF EXISTS datation;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS niveau;
DROP TABLE IF EXISTS jeu;



CREATE TABLE jeu (
	idjeu INT NOT NULL AUTO_INCREMENT,
	nom VARCHAR(50),
	description VARCHAR(255),
	PRIMARY KEY (idjeu)
);


CREATE TABLE niveau (
	idniveau INT NOT NULL AUTO_INCREMENT,
	idjeu INT NOT NULL,
	difficulte INT,
	caractéristique VARCHAR(255),
	PRIMARY KEY (idniveau),
	FOREIGN KEY (idjeu) REFERENCES jeu(idjeu)
);

CREATE TABLE users (
	id INT NOT NULL AUTO_INCREMENT,
	firstname VARCHAR(50),
	lastname VARCHAR(50),
	city VARCHAR(50),		
	password VARCHAR(255),
	email VARCHAR(50),
	image VARCHAR(255),
	remember_token VARCHAR(100),
	droits INT DEFAULT 0,
	PRIMARY KEY (id)
);


CREATE TABLE designation (
	iddesignation INT NOT NULL AUTO_INCREMENT,
	nom VARCHAR(255) NOT NULL,
	urldesignation VARCHAR(255),
	PRIMARY KEY (iddesignation)
);

CREATE TABLE auteur (
	idauteur INT NOT NULL AUTO_INCREMENT,
	nom VARCHAR(50) NOT NULL,
	anecdote VARCHAR(255),
	PRIMARY KEY (idauteur)
);

CREATE TABLE technique (
	idtechnique INT NOT NULL AUTO_INCREMENT,
	nom VARCHAR(50) NOT NULL,
	urltechnique VARCHAR(255),
	PRIMARY KEY (idtechnique)
);

CREATE TABLE domaine (
	iddomaine INT NOT NULL AUTO_INCREMENT,
	nom VARCHAR(50) NOT NULL,
	PRIMARY KEY (iddomaine)
);

CREATE TABLE matiere (
	idmatiere INT NOT NULL AUTO_INCREMENT,
	nom VARCHAR(50) NOT NULL,
	PRIMARY KEY (idmatiere)
);	

CREATE TABLE datation (
	iddate INT NOT NULL AUTO_INCREMENT,
	debut DATE,
	fin DATE,
	PRIMARY KEY (iddate)
);	


CREATE TABLE oeuvre (
	idoeuvre INT NOT NULL AUTO_INCREMENT,
	iddate INT,
	idtechnique INT,
	iddomaine INT,
	idmatiere INT,
    urlPhoto VARCHAR(50),
    PRIMARY KEY (idoeuvre),
    FOREIGN KEY (idtechnique) REFERENCES technique(idtechnique),
    FOREIGN KEY (iddomaine) REFERENCES domaine(iddomaine),
    FOREIGN KEY (idmatiere) REFERENCES matiere(idmatiere),
    FOREIGN KEY (iddate) REFERENCES datation(iddate)
);

CREATE TABLE assodesignationaoeuvre (
	oeuvre_id INT NOT NULL,
	designation_id INT NOT NULL,
	PRIMARY KEY (designation_id,oeuvre_id),
	FOREIGN KEY (designation_id) REFERENCES designation(iddesignation),
	FOREIGN KEY (oeuvre_id) REFERENCES oeuvre(idoeuvre)
);

CREATE TABLE assoauteuraoeuvre (
	oeuvre_id INT NOT NULL,
	auteur_id INT NOT NULL,
	PRIMARY KEY (auteur_id,oeuvre_id),
	FOREIGN KEY (auteur_id) REFERENCES auteur(idauteur),
	FOREIGN KEY (oeuvre_id) REFERENCES oeuvre(idoeuvre)
);


CREATE TABLE listeoeuvre (
	idlisteoeuvre INT NOT NULL AUTO_INCREMENT,
	idusers INT NOT NULL,
	nom VARCHAR(50),
	etat INT(1) DEFAULT 0,
	dateCreation TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (idlisteoeuvre),
	FOREIGN KEY (idusers) REFERENCES users(id)

);

CREATE TABLE assolisteaoeuvre (
	liste_oeuvre_id INT NOT NULL,
	oeuvre_id INT NOT NULL,
	PRIMARY KEY (liste_oeuvre_id,oeuvre_id),
	FOREIGN KEY (liste_oeuvre_id) REFERENCES listeoeuvre(idlisteoeuvre),
	FOREIGN KEY (oeuvre_id) REFERENCES oeuvre(idoeuvre)
);

CREATE TABLE assolisteajeu (
	liste_oeuvre_id INT NOT NULL,
	jeu_id INT NOT NULL,
	PRIMARY KEY (liste_oeuvre_id,jeu_id),
	FOREIGN KEY (liste_oeuvre_id) REFERENCES listeoeuvre(idlisteoeuvre),
	FOREIGN KEY (jeu_id) REFERENCES jeu(idjeu)
);

CREATE TABLE description (
	iddescription INT NOT NULL AUTO_INCREMENT,
	idoeuvre INT NOT NULL,
	idlisteoeuvre INT NOT NULL,
	libelle VARCHAR(255),
	PRIMARY KEY (iddescription),
	FOREIGN KEY (idoeuvre) REFERENCES oeuvre(idoeuvre),
	FOREIGN KEY (idlisteoeuvre) REFERENCES listeoeuvre(idlisteoeuvre)
);

CREATE TABLE password_resets (
	token VARCHAR(255),
	email VARCHAR(255),
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (token)
);