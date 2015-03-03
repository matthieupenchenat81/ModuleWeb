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

	con = mdb.connect('localhost', 'root', '', 'moduleweb')
	cur = con.cursor()
	
	# Suppresion des données existantes dan la bd
	cur.execute("SET FOREIGN_KEY_CHECKS = 0")
	cur.execute("TRUNCATE table assodesignationaoeuvre")
	cur.execute("TRUNCATE table assoauteuraoeuvre")
	cur.execute("TRUNCATE table designation")
	cur.execute("TRUNCATE table auteur")
	cur.execute("TRUNCATE table matiere")
	cur.execute("TRUNCATE table technique")
	cur.execute("TRUNCATE table domaine")
	cur.execute("TRUNCATE table datation")
	cur.execute("TRUNCATE table oeuvre")
	cur.execute("SET FOREIGN_KEY_CHECKS = 1")


	# On parcourt le fichier xml
	tree = ET.parse('inventaire_augustins_2014_vdt.xml')
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
							datas = {"debut" : datation2.split("-")[0] + "-01-01", "fin" :  datation2.split("-")[1] + "-12-31"}
							iddatation = insert(cur,"datation",datas)
						except Exception, e:
							if re.compile("^[0-9]{4}[ ]").match(datation.lower()) :
								datas = {"debut" : datation.split(" ")[0] + "-01-01", "fin" :  datation.split(" ")[0] + "-12-31"}
								iddatation = insert(cur,"datation",datas)

					elif re.compile("^[0-9]{4}-[0-9]{4}$").search(datation.lower()) and re.compile("^[0-9]{4}-[0-9]{4}$").search(datation2.lower()) :
						datas = {"debut" : datation.split("-")[0] + "-01-01", "fin" :  datation2.split("-")[1] + "-12-31"}
						iddatation = insert(cur,"datation",datas)

					elif re.compile("^[0-9]{4}[ ]").match(datation.lower()) and re.compile("^[0-9]{4}[ ]").match(datation2.lower()) :
						datas = {"debut" : datation.split(" ")[0] + "-01-01", "fin" :  datation2.split(" ")[0] + "-12-31"}
						iddatation = insert(cur,"datation",datas)

					elif re.compile("^[0-9]{4}-[0-9]{4}[ ]").match(datation.lower()) and re.compile("^[0-9]{4}-[0-9]{4}[ ]").match(datation2.lower()) :
						datas = {"debut" : datation.split("-")[0] + "-01-01", "fin" :  datation2.split("-")[1].split(" ")[0] + "-12-31"}
						iddatation = insert(cur,"datation",datas)

					elif re.compile("^[0-9]{4}-[0-9]{4}[ ]").match(datation.lower()) and re.compile("^[0-9]{4}-[0-9]{4}").match(datation2.lower()) :
						datas = {"debut" : datation.split("-")[0] + "-01-01", "fin" :  datation2.split("-")[1].split(" ")[0] + "-12-31"}
						iddatation = insert(cur,"datation",datas)

				if datation is not None and datation2 is None :
					if re.compile("^[0-9]{4}[ ]").match(datation.lower()) :
						datas = {"debut" : datation.split(" ")[0] + "-01-01", "fin" :  datation.split(" ")[0] + "-12-31"}
						iddatation = insert(cur,"datation",datas)
					elif re.compile("^[0-9]{4}$").match(datation.lower()) :
						datas = {"debut" : datation + "-01-01", "fin" :  datation + "-12-31"}
						iddatation = insert(cur,"datation",datas)
					elif re.compile("^[0-9]{4}-[0-9]{4}$").match(datation.lower()) :
						datas = {"debut" : datation.split("-")[0] + "-01-01", "fin" : datation.split("-")[1] + "-12-31"}
						iddatation = insert(cur,"datation",datas)

				if iddatation != "NULL" :
					listeDatation[str(datation)+str(datation2) 		] = iddatation


					
				

			if technique is not None :		
				if not technique in listeTechnique :
					datas = { "nom" : technique}
					idtechnique = insert(cur,"technique",datas)
					listeTechnique[technique] = idtechnique
				else :
					idtechnique = listeTechnique[technique]

			if matiere is not None :
				if not matiere in listeMatiere :
					datas = { "nom" : matiere}
					idmatiere = insert(cur,"matiere",datas)
					listeMatiere[matiere] = idmatiere
				else :
					idmatiere = listeMatiere[matiere]

			if domaine is not None :
				if not domaine in listeDomaine :
					datas = { "nom" : domaine}
					iddomaine = insert(cur,"domaine",datas)
					listeDomaine[domaine] = iddomaine
				else :
					iddomaine = listeDomaine[domaine]

			if designation is not None :
				if not designation in listeDesignation :
					datas = { "nom" : designation}
					iddesignation = insert(cur,"designation",datas)
					listeDesignation[designation] = iddesignation
				else :
					iddesignation = listeDesignation[designation]

			if designation2 is not None :
				if not designation2 in listeDesignation :
					datas = { "nom" : designation2}
					iddesignation2 = insert(cur,"designation", datas)
					listeDesignation[designation2] = iddesignation3
				else :
					iddesignation2 = listeDesignation[designation2]

			if designation3 is not None :
				if not designation3 in listeDesignation :
					datas = { "nom" : designation3}
					iddesignation3 = insert(cur,"designation", datas)
					listeDesignation[designation3] = iddesignation3
				else :
					iddesignation3 = listeDesignation[designation3]

			if auteur is not None :
				if not auteur in listeAuteur :
					datas = { "nom" : auteur}
					idauteur = insert(cur,"auteur", datas)
					listeAuteur[auteur] = idauteur
				else :
					idauteur = listeAuteur[auteur]

			if auteur2 is not None :
				if not auteur2 in listeAuteur :
					datas = { "nom" : auteur2}
					idauteur2 = insert(cur,"auteur", datas)
					listeAuteur[auteur2] = idauteur2
				else :
					idauteur2 = listeAuteur[auteur2]

		
			datas = {"idtechnique" : idtechnique, "iddomaine" : iddomaine, "idmatiere" : idmatiere, 
			"urlPhoto" : image, "iddate" : iddatation}
			for key , data in datas.items() :
				if data == "NULL" :
					del datas[key]

			idoeuvre = insert(cur,"oeuvre",datas)

			if iddesignation != "NULL" :
				insert(cur, "assodesignationaoeuvre", {"designation_id" : iddesignation, "oeuvre_id" : idoeuvre})
			if iddesignation2 != "NULL" :
				insert(cur, "assodesignationaoeuvre", {"designation_id" : iddesignation2, "oeuvre_id" : idoeuvre})
			if iddesignation3 != "NULL" :
				insert(cur, "assodesignationaoeuvre", {"designation_id" : iddesignation3, "oeuvre_id" : idoeuvre})

			if idauteur != "NULL" :
				insert(cur, "assoauteuraoeuvre", {"auteur_id" : idauteur, "oeuvre_id" : idoeuvre})
			if idauteur2 != "NULL" and idauteur != idauteur2 :
				insert(cur, "assoauteuraoeuvre", {"auteur_id" : idauteur2, "oeuvre_id" : idoeuvre})

			
	con.commit()

except mdb.Error, e:
    if con:
        con.rollback()
        
    print "Error %d: %s" % (e.args[0],e.args[1])
    sys.exit(1)
    
finally:       
    if con:    
        con.close()
