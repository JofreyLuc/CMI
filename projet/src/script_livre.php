<?php

//require 'app/model/Livre.php';


//$dir    = 'epub';
// On scan le dossier epub pour récupérer chaque dossier d'epub
//$epub = scandir($dir);
// Nombre de livre dans la base Gutemberg
//$nbLivre = count($epub) - 3;
//$livre;
// On instancie un dom xml
//$dom = new DomDocument();
/*
for($i = 1; $i < 2;$i++){
    $chemin = 'epub/'.$i.'/pg'.$i.'.rdf';
    $dom->load($chemin);
    $livre = Livre::create();
    $livre->title = $dom->documentElement->getElementsByTagName('title')->item(0)->nodeValue."\n";
    $livre->auteur = $dom->documentElement->getElementsByTagName('name')->item(0)->nodeValue."\n";
    $livre->langue = $dom->documentElement->getElementsByTagName('language')->item(0)->nodeValue."\n";
    $livre->save();


}*/


/*
$livre = DOMDocument::load ( "pg318.rdf" );
echo $livre;
*/
$livre;
$dom = new DOMDocument();
$dom->load('pg318.rdf');

$livre->title = $dom->documentElement->getElementsByTagName('title')->item(0)->nodeValue."<br>";
echo 'titre : '.$livre->title;

$livre->auteur = $dom->documentElement->getElementsByTagName('name')->item(0)->nodeValue."<br>";
echo 'auteur : '.$livre->auteur;

$livre->aliasAuteur = $dom->documentElement->getElementsByTagName('alias')->item(0)->nodeValue."<br>";
echo 'alias : '.$livre->aliasAuteur;


$livre->langue = $dom->documentElement->getElementsByTagName('language')->item(0)->nodeValue."<br>";
echo 'langue : '.$livre->langue;

$livre->tags = $dom->documentElement->getElementsByTagName('subject')->item(1)->nodeValue."<br>";
echo 'tags : '.$livre->tags;

$livre->genre = $dom->documentElement->getElementsByTagName('subject')->item(2)->nodeValue."<br>";
echo 'genre : '.$livre->genre;

$livre->dateNaissanceAuteur = $dom->documentElement->getElementsByTagName('birthdate')->item(0)->nodeValue."<br>";
echo 'dateNaissance : '.$livre->dateNaissanceAuteur;


$livre->dateMortAuteur = $dom->documentElement->getElementsByTagName('deathdate')->item(0)->nodeValue."<br>";
echo 'dateMort : '.$livre->dateMortAuteur;

// POUR LE LIEN J'ARRIVE PAS A LE CHOPER C'EST LE TRUC WIKI
$livre->infoAuteur = $dom->documentElement->getElementsByTagName('webpage')->item(0)->nodeType."<br>";
echo 'info wiki : '.$livre->infoAuteur;







//echo $doc->saveXML();







?>