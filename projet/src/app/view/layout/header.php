<!DOCTYPE html>
<html>
 <head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="conf/css/file.css" />
  <title>Callme Ishmael </title>
 </head>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

 <body>

<header>
<div id="titre"> <h1> CallMe Ishmael</h1> </div>
<div id="banniere">
<input type="textarea" value="login"/><br/>
<input type="textarea" value="mdp"/><br/>
<div id="co"> <input type="button" value="Connexion"/> </div>
<div id="ins"> <input type="button" value="Inscription"/> </div>
</div>

</header>




<div id="menu">
 <div id="bibli"> <input type="button" value="Consulter sa bibliothèque"
                         onclick="document.location.href='consulter_bibli';"/></div>
 <div id="rechercher"> <input type="button"  value="Rechercher"
                              onclick="document.location.href='rechercher.php';"/> </div>
 <div id="liste"> <input type="button" value="Liste de suivi"
                         onclick="document.location.href='liste_suivi.php';"/> </div>
 <div id="suggestion"> <input type="button" value="Suggestion"
                              onclick="document.location.href='suggestion.php';"/> </div>
 <div id="top"> <input type="button" value="Top 10"
                       onclick="document.location.href='accueil.php';"/> </div>


