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
	// Chemin de l'epub
    $chemin = 'epub/'.$i.'/pg'.$i.'.rdf';
    $dom->load($chemin);
		  
    echo "livre : $i</br>";

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
    $listeGenre = $dom->documentElement->getElementsByTagName('subject');
    // On recherche le lien concernant l'epub avec images, on pourra proposer avec ou sans images
    // ou même utiliser des fichiers txt, html, ... pour le livre
    $genres = '';
    if($listeGenre->length != 0){
    	foreach ($listeGenre as $genre){

    		$genres = $genres.trim($genre->nodeValue)." // ";
    	}
    }


    // On regarde si le livre n'est pas déjà present dans la BDD
    $livre = app\Model\Livre::where('idLivre', '=', $id)->get();
    if(count($livre) == 0){
    	// aucun livre avec cet id
    	$livre = new app\Model\Livre;
	    if($lienEpub->length != 0){
		    foreach ($lienEpub as $lien) {
		    	if(stripos($lien->getAttribute('rdf:about'),'.epub.images') !== false){
		    		$lienEpub = $lien->getAttribute('rdf:about');
		    		$livre->idLivre = $id;
				    if($titre->length != 0) $livre->titre = trim($titre->item(0)->nodeValue);
				    if($auteur->length != 0) $livre->auteur = trim($auteur->item(0)->nodeValue);
				    if($langue->length != 0) $livre->langue = trim($langue->item(0)->nodeValue);
				    $livre->lienEpub = trim($lienEpub);		
				    // recupération des genres
				    $livre->genre = $genres;
				    $livre->save();
		    	}
		    }
		}
    }else{
    	// livre deja ds la bdd
    	if($lienEpub->length != 0){
		    foreach ($lienEpub as $lien) {
		    	$bool = stripos($lien->getAttribute('rdf:about'),'.epub.images');
		    	if($bool !== false){
		    		$lienEpub = $lien->getAttribute('rdf:about');
				    if($titre->length != 0){
				    	$titre = trim($titre->item(0)->nodeValue);
				    	app\Model\Livre::where('idLivre', '=', $id)->update(['titre' => $titre]);
				    }
				    if($auteur->length != 0){
				    	$auteur = trim($auteur->item(0)->nodeValue);
				    	app\Model\Livre::where('idLivre', '=', $id)->update(['auteur' => $auteur]);	
				    }
				    if($langue->length != 0){
				    	$langue = trim($langue->item(0)->nodeValue);
				    	app\Model\Livre::where('idLivre', '=', $id)->update(['langue' => $langue]);
				    }else{

				    }
				    //echo "auteur : $auteur</br>";
				    app\Model\Livre::where('idLivre', '=', $id)->update(['lienEpub' => trim($lienEpub),'genre' => $genres]);
				    //echo "deja dedans"; 	
				    //$livre->save();
				    break;
		    	}
		    }
		}else{
			// Si le livre n'a plus de lien pour le telecharger, on le supprime
			$livre->delete();
		}
    }
	
	// AUTRE INFORMATIONS QUE L'ON PEUT RECUPERER    
	//$livre->aliasAuteur = $dom->documentElement->getElementsByTagName('alias')->item(0)->nodeValue;
    //$livre->tags = $dom->documentElement->getElementsByTagName('subject')->item(1)->nodeValue;
    /*$livre->genre = $dom->documentElement->getElementsByTagName('subject')->item(2)->nodeValue;
    $livre->dateNaissanceAuteur = $dom->documentElement->getElementsByTagName('birthdate')->item(0)->nodeValue;
	$livre->dateMortAuteur = $dom->documentElement->getElementsByTagName('deathdate')->item(0)->nodeValue;*/
}