<?php

require 'app/model/Livre.php';


$dir    = 'epub';
// On scan le dossier epub pour récupérer chaque dossier d'epub
$epub = scandir($dir);
// Nombre de livre dans la base Gutemberg
$nbLivre = count($epub) - 3;
$livre;
// On instancie un dom xml
$dom = new DomDocument();

for($i = 1; $i < 2;$i++){
    $chemin = 'epub/'.$i.'/pg'.$i.'.rdf';
    $dom->load($chemin);
    $livre = Livre::create();
    $livre->title = $dom->documentElement->getElementsByTagName('title')->item(0)->nodeValue."\n";
    $livre->auteur = $dom->documentElement->getElementsByTagName('name')->item(0)->nodeValue."\n";
    $livre->langue = $dom->documentElement->getElementsByTagName('language')->item(0)->nodeValue."\n";
    $livre->save();


}