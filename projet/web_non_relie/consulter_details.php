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
<form method="post" action="accueil_connexion.php">
<p> <div id="login"> login : <input type="text" name="login"/> </div><br/>
 <div id="mdp"> mot de passe : <input type="password"
 mdp="mdp"/> </div> <br/>
<div id="co"> <input type="submit" value="Connexion"/> </div> </p>
<div id="ins"> <input type="button" value="Inscription"/> </div>
</form>
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
<div id="titreT"> <h3> Détails du livre </h3> </div>
<div id="detail">
<div style="border:black solid medium">
	<img src="Couverture_test.jpg"/>
     	<div id="desc_detail">
     		<h2>Théorie de l\'information et du codage</h2>
     		<p>Auteur : Olivier Rioul</p>
     		<p>Genre : Technologie</p>
<p> résumé : </p>
     		</br>
     		</div>
     		<div id="note">
     			<p>Note :</p></br></br></br></br></br>
     		</div>
     		<div id="boutons">
     			<input type="button"value="Consulter détails livre"></br></br></br>
     			<input type="button"value="Ajouter a sa bibliothèque"></br></br></br></br>
     		</div>
		</div>';
  } 


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

