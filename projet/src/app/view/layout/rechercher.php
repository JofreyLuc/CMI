<!DOCTYPE html>
<html>
 <head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="file.css" />
  <title>Callme Ishmael </title>
 </head>

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

<!-- Menu des différents boutons qui doivent être alignés et entourés -->
<section>
<div id="menu">
<div id="bibli"> <input type="button" value="Consulter sa bibliothèque"
 onclick="document.location.href='consulter_bibli.php';"/></div>
<div id="rechercher"> <input type="button"  value="Rechercher" 
onclick="document.location.href='rechercher.php';"/> </div>
<div id="liste"> <input type="button" value="Liste de suivi"
onclick="document.location.href='liste_suivi.php';"/> </div>
<div id="suggestion"> <input type="button" value="Suggestion"
onclick="document.location.href='suggestion.php';"/> </div>
<div id="top"> <input type="button" value="Top 10"
onclick="document.location.href='accueil.php';"/> </div>
 </div>
</section>

<section>
<div id="recherche">
<div id="barre"> <input type="textArea" value="rechercher" /> </div>
<div id="validerRecherche"> <input type="button" value="valider" /> </div>
<div id="avancée"> <input type="button" value="+"/> </div>
</div>

<!-- Top 10 des livres, faire les cadres plus grands et les remplir -->
<section>
<div id="titreT"> <h3> Top 10 </h3> </div>
<div id="top10">
<div style="border:black solid medium">
<?php 
for( $i = 1 ; $i <= 10 ; $i++ ) 
  {
    echo '<div id="test">
     <td rowspan="20" bgcolor="#FFFFFF">
     <img src="Couverture_test.jpg" width="200" height="300" style="float:left;margin-left:5%;"/>
      </td> 
</div>' ;
  } 
?>
</div>
</div>
</section>

<!-- Footer = bas du site internet donc juste les conditions et la FAQ -->
<div id="footer"> <footer>
<input type="button" value="Condition général"/>
<input type="button" value="FAQ"/>
</footer>
</div>
 </body>
</html>

