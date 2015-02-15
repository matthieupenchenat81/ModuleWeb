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
	idusers INT NOT NULL AUTO_INCREMENT,
	name VARCHAR(50),
	password VARCHAR(255),
	email VARCHAR(50),
	image VARCHAR(255),
	admin INT(1) DEFAULT 0,
	PRIMARY KEY (idusers)
);


CREATE TABLE designation (
	nom VARCHAR(255) NOT NULL,
	urldesignation VARCHAR(255),
	PRIMARY KEY (nom)
);

CREATE TABLE auteur (
	nom VARCHAR(50) NOT NULL,
	anecdote VARCHAR(255),
	PRIMARY KEY (nom)
);

CREATE TABLE technique (
	nom VARCHAR(50) NOT NULL,
	urltechnique VARCHAR(255),
	PRIMARY KEY (nom)
);

CREATE TABLE domaine (
	nom VARCHAR(50) NOT NULL,
	PRIMARY KEY (nom)
);

CREATE TABLE matiere (
	nom VARCHAR(50) NOT NULL,
	PRIMARY KEY (nom)
);	

CREATE TABLE datation (
	iddate INT NOT NULL AUTO_INCREMENT,
	debut DATE,
	fin DATE,
	PRIMARY KEY (iddate)
);	


CREATE TABLE oeuvre (
	idoeuvre INT NOT NULL AUTO_INCREMENT,
	iddate INT NOT NULL,
	idtechnique VARCHAR(50),
	iddomaine VARCHAR(50),
	idmatiere VARCHAR(50),
    titre VARCHAR(50),
    urlPhoto VARCHAR(255),
    PRIMARY KEY (idoeuvre),
    FOREIGN KEY (idtechnique) REFERENCES technique(nom),
    FOREIGN KEY (iddomaine) REFERENCES domaine(nom),
    FOREIGN KEY (idmatiere) REFERENCES matiere(nom),
    FOREIGN KEY (iddate) REFERENCES datation(iddate)
);

CREATE TABLE assodesignationaoeuvre (
	idoeuvre INT NOT NULL,
	idesignation VARCHAR(255),
	PRIMARY KEY (idesignation,idoeuvre),
	FOREIGN KEY (idesignation) REFERENCES designation(nom),
	FOREIGN KEY (idoeuvre) REFERENCES oeuvre(idoeuvre)
);

CREATE TABLE assoauteuraoeuvre (
	idoeuvre INT NOT NULL,
	idauteur VARCHAR(50),
	PRIMARY KEY (idauteur,idoeuvre),
	FOREIGN KEY (idauteur) REFERENCES auteur(nom),
	FOREIGN KEY (idoeuvre) REFERENCES oeuvre(idoeuvre)
);



CREATE TABLE listeoeuvre (
	idlisteoeuvre INT NOT NULL AUTO_INCREMENT,
	idusers INT NOT NULL,
	nom VARCHAR(50),
	etat INT(1) DEFAULT 0,
	dateCreation TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (idlisteoeuvre),
	FOREIGN KEY (idusers) REFERENCES users(idusers)

);

CREATE TABLE assolisteaoeuvre (
	idlisteoeuvre INT NOT NULL,
	idoeuvre INT NOT NULL,
	PRIMARY KEY (idlisteoeuvre,idoeuvre),
	FOREIGN KEY (idlisteoeuvre) REFERENCES listeoeuvre(idlisteoeuvre),
	FOREIGN KEY (idoeuvre) REFERENCES oeuvre(idoeuvre)
);

CREATE TABLE assolisteajeu (
	idlisteoeuvre INT NOT NULL,
	idjeu INT NOT NULL,
	PRIMARY KEY (idlisteoeuvre,idjeu),
	FOREIGN KEY (idlisteoeuvre) REFERENCES listeoeuvre(idlisteoeuvre),
	FOREIGN KEY (idjeu) REFERENCES jeu(idjeu)
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
	email VARCHAR(255) INDEX,
	token VARCHAR(255) INDEX,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)
