# -*- coding: utf-8 -*-
import xml.etree.ElementTree as ET
import MySQLdb as mdb
import sys
import re


def insert (cur, table, dict) :
	keys = ""
	datas = ""
	for key , data in dict.items() :
		keys += key + ","
		datas += "\"" + str(data) + "\","

	req = "INSERT INTO " + table + "(" + keys[:-1] + ")" + " VALUES (" + datas[:-1] + ")"
	#print(req)
	cur.execute(req)
	return cur.lastrowid
	
	

try : 
	listeTechnique = {}
	listeMatiere= {}
	listeDomaine = {}
	listeDesignation = {}
	listeAuteur = {}
	listeDatation = {}

	con = mdb.connect('127.0.0.1', 'root', 'l3miashs2015', 'moduleweb',charset='utf8')
	cur = con.cursor()
	# Suppresion des données existantes dan la bd
	cur.execute("TRUNCATE table auteurs")
	cur.execute("TRUNCATE table matieres")
	cur.execute("TRUNCATE table techniques")
	cur.execute("TRUNCATE table domaines")
	cur.execute("TRUNCATE table datations")
	cur.execute("TRUNCATE table oeuvres")

	# On parcourt le fichier xml
	tree = ET.parse('inventaire.xml')
	root = tree.getroot()

	# Pour chaque oeuvre
	for o in root.iter('oeuvre'):
		idtechnique = "NULL"
		idmatiere = "NULL"
		iddomaine= "NULL"
		iddesignation = "NULL"
		iddesignation2 = "NULL"
		iddesignation3 = "NULL"	
		idauteur = "NULL"
		idauteur2 = "NULL"
		image = "NULL"
		iddatation = "NULL"

		technique = None
		matiere = None
		domaine = None
		designation = None
		designation2 = None
		designation3 = None
		auteur = None
		auteur2 = None
		datation = None
		datation2 = None

		# On parcourt tout les tags
		for child in o :
			if child.tag == 'auteur1' :
				auteur = child.text.encode('utf-8')

			elif child.tag == 'auteur2' :
				auteur2 = child.text.encode('utf-8')
				
			elif child.tag == 'datation1':
				datation = child.text.encode('utf-8')

			elif child.tag == 'datation2':
				datation2 = child.text.encode('utf-8')
			
			elif child.tag == 'designation':
				designation1 = child.text.encode('utf-8')
				
			elif child.tag == 'designation2':
				designation2 = child.text.encode('utf-8')
				
			elif child.tag == 'designation3':
				designation3 = child.text.encode('utf-8')
			
			elif child.tag == 'domaine':
				domaine = child.text.encode('utf-8')
				
			elif child.tag == 'matiere':
				matiere = child.text.encode('utf-8')
				
			elif child.tag == 'technique':
				technique = child.text.encode('utf-8')

			elif child.tag == 'image' :
				image = child.text.encode('utf-8')

		# On s'interesee qu'aux oeuvres ayant une image
		if image != "NULL" : 
			if str(datation)+str(datation2) in listeDatation :
				iddatation = listeDatation[str(datation)+str(datation2)]
			else :
				if datation is not None and datation2 is not None  :
					if re.compile("vers").search(datation.lower()) or  re.compile("avant").search(datation.lower()):
						try:
							datas = {"dateDebut" : datation2.split("-")[0] + "-01-01", "dateFin" :  datation2.split("-")[1] + "-12-31"}
							iddatation = insert(cur,"datations",datas)
						except Exception, e:
							if re.compile("^[0-9]{4}[ ]").match(datation.lower()) :
								datas = {"dateDebut" : datation.split(" ")[0] + "-01-01", "dateFin" :  datation.split(" ")[0] + "-12-31"}
								iddatation = insert(cur,"datations",datas)

					elif re.compile("^[0-9]{4}-[0-9]{4}$").search(datation.lower()) and re.compile("^[0-9]{4}-[0-9]{4}$").search(datation2.lower()) :
						datas = {"dateDebut" : datation.split("-")[0] + "-01-01", "dateFin" :  datation2.split("-")[1] + "-12-31"}
						iddatation = insert(cur,"datations",datas)

					elif re.compile("^[0-9]{4}[ ]").match(datation.lower()) and re.compile("^[0-9]{4}[ ]").match(datation2.lower()) :
						datas = {"dateDebut" : datation.split(" ")[0] + "-01-01", "dateFin" :  datation2.split(" ")[0] + "-12-31"}
						iddatation = insert(cur,"datations",datas)

					elif re.compile("^[0-9]{4}-[0-9]{4}[ ]").match(datation.lower()) and re.compile("^[0-9]{4}-[0-9]{4}[ ]").match(datation2.lower()) :
						datas = {"dateDebut" : datation.split("-")[0] + "-01-01", "dateFin" :  datation2.split("-")[1].split(" ")[0] + "-12-31"}
						iddatation = insert(cur,"datations",datas)

					elif re.compile("^[0-9]{4}-[0-9]{4}[ ]").match(datation.lower()) and re.compile("^[0-9]{4}-[0-9]{4}").match(datation2.lower()) :
						datas = {"dateDebut" : datation.split("-")[0] + "-01-01", "dateFin" :  datation2.split("-")[1].split(" ")[0] + "-12-31"}
						iddatation = insert(cur,"datations",datas)

				if datation is not None and datation2 is None :
					if re.compile("^[0-9]{4}[ ]").match(datation.lower()) :
						datas = {"dateDebut" : datation.split(" ")[0] + "-01-01", "dateFin" :  datation.split(" ")[0] + "-12-31"}
						iddatation = insert(cur,"datations",datas)
					elif re.compile("^[0-9]{4}$").match(datation.lower()) :
						datas = {"dateDebut" : datation + "-01-01", "dateFin" :  datation + "-12-31"}
						iddatation = insert(cur,"datations",datas)
					elif re.compile("^[0-9]{4}-[0-9]{4}$").match(datation.lower()) :
						datas = {"dateDebut" : datation.split("-")[0] + "-01-01", "dateFin" : datation.split("-")[1] + "-12-31"}
						iddatation = insert(cur,"datations",datas)

				if iddatation != "NULL" :
					listeDatation[str(datation)+str(datation2) 		] = iddatation


					
				

			if technique is not None :		
				if not technique in listeTechnique :
					datas = { "nom" : technique}
					idtechnique = insert(cur,"techniques",datas)
					listeTechnique[technique] = idtechnique
				else :
					idtechnique = listeTechnique[technique]

			if matiere is not None :
				if not matiere in listeMatiere :
					datas = { "nom" : matiere}
					idmatiere = insert(cur,"matieres",datas)
					listeMatiere[matiere] = idmatiere
				else :
					idmatiere = listeMatiere[matiere]

			if domaine is not None :
				if not domaine in listeDomaine :
					datas = { "nom" : domaine}
					iddomaine = insert(cur,"domaines",datas)
					listeDomaine[domaine] = iddomaine
				else :
					iddomaine = listeDomaine[domaine]

			if auteur is not None :
				if not auteur in listeAuteur :
					datas = { "nom" : auteur}
					idauteur = insert(cur,"auteurs", datas)
					listeAuteur[auteur] = idauteur
				else :
					idauteur = listeAuteur[auteur]

		
			datas = {"technique_id" : idtechnique, "domaine_id" : iddomaine, "matiere_id" : idmatiere,
			"image" : image, "designation" : con.escape_string(designation1), "auteur_id" : idauteur}
			for key , data in datas.items() :
				if data == "NULL" :
					del datas[key]

			idoeuvre = insert(cur,"oeuvres",datas)
	con.commit()

except mdb.Error, e:
    if con:
        con.rollback()
        
    print("Error %d: %s" % (e.args[0],e.args[1]))
    sys.exit(1)
    
finally:       
    if con:    
        con.close()
