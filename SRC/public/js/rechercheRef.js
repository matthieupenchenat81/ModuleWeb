// fonction qui recherche le referent donnee en parametre
function rechercherReferent()
{
	// on recupere le mot cle rentrer dans le champs de recherche
	var  motCle = document.getElementById("searchfield").value; 
	
	//boucle sur chaque item
	var list = document.getElementsByClassName("item");
	
	for (var i = 0; i < list.length; i++)
	{
		referent = list[i].getElementsByClassName('nomRef')[0].innerHTML; //recupere le nom du referent referent
		if (referent.indexOf(motCle) > -1) //on compare si la recherche correspond au nom
		{
			//on remplace la classe
			list[i].className = "item active";
		}
	}
}