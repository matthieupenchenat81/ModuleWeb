DROP TABLE IF EXISTS referent;
DROP TABLE IF EXISTS listeoeuvre;
DROP TABLE IF EXISTS oeuvre;
DROP TABLE IF EXISTS asscocie;
DROP TABLE IF EXISTS description;
DROP TABLE IF EXISTS auteur;
DROP TABLE IF EXISTS designation;
DROP TABLE IF EXISTS technique;
DROP TABLE IF EXISTS domaine;
DROP TABLE IF EXISTS matiere;
DROP TABLE IF EXISTS datation;
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

CREATE TABLE referent (
	idreferent INT NOT NULL AUTO_INCREMENT,
	nom VARCHAR(50),
	mdp VARCHAR(32),
	email VARCHAR(50),
	image VARCHAR(255),
	PRIMARY KEY (idreferent)
);


CREATE TABLE designation (
	iddesignation INT NOT NULL AUTO_INCREMENT,
	nom VARCHAR(50),
	urldesignation VARCHAR(255),
	PRIMARY KEY (iddesignation)
);

CREATE TABLE auteur (
	idauteur INT NOT NULL AUTO_INCREMENT,
	nom VARCHAR(50),
	anecdote VARCHAR(255),
	PRIMARY KEY (idauteur)
);

CREATE TABLE technique (
	idtechnique INT NOT NULL AUTO_INCREMENT,
	nom VARCHAR(50),
	urltechnique VARCHAR(255),
	PRIMARY KEY (idtechnique)
);

CREATE TABLE domaine (
	iddomaine INT NOT NULL AUTO_INCREMENT,
	nom VARCHAR(50),
	PRIMARY KEY (iddomaine)
);

CREATE TABLE matiere (
	idmatiere INT NOT NULL AUTO_INCREMENT,
	nom VARCHAR(50),
	PRIMARY KEY (idmatiere)
);	

CREATE TABLE datation (
	iddatation INT NOT NULL AUTO_INCREMENT,
	date VARCHAR(50),
	PRIMARY KEY (iddatation)
);	


CREATE TABLE oeuvre (
	idoeuvre INT NOT NULL AUTO_INCREMENT,
	iddesignation INT NOT NULL,
	idauteur INT NOT NULL,
	idtechnique INT NOT NULL,
	iddomaine INT NOT NULL,
	idmatiere INT NOT NULL,
	iddatation INT NOT NULL,
    titre VARCHAR(50),
    urlPhoto VARCHAR(255),
    PRIMARY KEY (idoeuvre),
    FOREIGN KEY (iddesignation) REFERENCES designation(iddesignation),
    FOREIGN KEY (idauteur) REFERENCES auteur(idauteur),
    FOREIGN KEY (idtechnique) REFERENCES technique(idtechnique),
    FOREIGN KEY (iddomaine) REFERENCES domaine(iddomaine),
    FOREIGN KEY (idmatiere) REFERENCES matiere(idmatiere),	
    FOREIGN KEY (iddatation) REFERENCES datation(iddatation)	
);

CREATE TABLE listeoeuvre (
	idlisteoeuvre INT NOT NULL AUTO_INCREMENT,
	idreferent INT NOT NULL,
	nom VARCHAR(50),
	etat INT(1) DEFAULT 0,
	dateCreation TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (idlisteoeuvre),
	FOREIGN KEY (idreferent) REFERENCES referent(idreferent),

);

CREATE TABLE asscocielisteaoeuvre (
	idlisteoeuvre INT NOT NULL,
	idoeuvre INT NOT NULL,
	PRIMARY KEY (idlisteoeuvre,idoeuvre),
	FOREIGN KEY (idlisteoeuvre) REFERENCES listeoeuvre(idlisteoeuvre),
	FOREIGN KEY (idoeuvre) REFERENCES oeuvre(idoeuvre)
);

CREATE TABLE asscocielisteajeu (
	idlisteoeuvre INT NOT NULL,
	idjeu INT NOT NULL,
	PRIMARY KEY (idlisteoeuvre,idoeuvre),
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
