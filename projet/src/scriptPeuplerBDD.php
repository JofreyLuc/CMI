<?php
/**
 * Created by PhpStorm.
 * User: mulhauser
 * Date: 12/05/2016
 * Time: 13:59
 */

//require 'app/model/Livre.php';


$dir = 'epub';
// On scan le dossier epub pour récupérer chaque dossier d'epub
$epub = scandir($dir);

// Nombre de livre dans la base Gutemberg
$nbLivre = count($epub) - 3;

// On instancie un dom xml
$dom = new DOMDocument();
for($i = 1; $i < $nbLivre;$i++){
	echo "nb : $i</br>";
	// Chemin de l'epub
    $chemin = 'epub/'.$i.'/pg'.$i.'.rdf';
    $dom->load($chemin);
		    
    $livre = new app\Model\Livre;

    $id = $dom->documentElement->getElementsByTagName('ebook');
    // On récupère l'id nécessaire dans le noeud concernant l'id
    if($id->length != 0){
		$idTab = explode("/",$id->item(0)->getAttribute('rdf:about'));
	}
	$id = $idTab[1];
	// On récupère les différents éléments du livre
    $titre = $dom->documentElement->getElementsByTagName('title');
    $auteur = $dom->documentElement->getElementsByTagName('name');
    $langue = $dom->documentElement->getElementsByTagName('language');
    $lienEpub = $dom->documentElement->getElementsByTagName('file');
    // On recherche le lien concernant l'epub avec images, on pourra proposer avec ou sans images
    // ou même utiliser des fichiers txt, html, ... pour le livre
    if($lienEpub->length != 0){
	    foreach ($lienEpub as $lien) {
	    	if(stripos($lien->getAttribute('rdf:about'),'.epub.images') !== false){
	    		$lienEpub = $lien->getAttribute('rdf:about');
	    		$livre->idLivre = $id;
			    if($titre->length != 0) $livre->titre = $titre->item(0)->nodeValue;
			    if($auteur->length != 0) $livre->auteur = $auteur->item(0)->nodeValue;
			    if($langue->length != 0) $livre->langue = $langue->item(0)->nodeValue;
			    $livre->lienEpub = $lienEpub;			   	
			    $livre->save();
	    	}else{
	    	}
	    }
	}   	// AUTRE INFORMATIONS QUE L'ON PEUT RECUPERER    //$livre->aliasAuteur = $dom->documentElement->getElementsByTagName('alias')->item(0)->nodeValue;
    //$livre->tags = $dom->documentElement->getElementsByTagName('subject')->item(1)->nodeValue;
    /*$livre->genre = $dom->documentElement->getElementsByTagName('subject')->item(2)->nodeValue;
    $livre->dateNaissanceAuteur = $dom->documentElement->getElementsByTagName('birthdate')->item(0)->nodeValue;
	$livre->dateMortAuteur = $dom->documentElement->getElementsByTagName('deathdate')->item(0)->nodeValue;*/
}