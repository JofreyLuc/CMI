






<section>
	<div id=\"titreT\"> <h3> Bibliotheque perso </h3> </div>
	<div id=\"top10\">

			<table>
			<?php
			foreach($bibliotheque as $livre)
			{
				echo '<tr>
			<div id=\"test\">
     		<td><img src="conf/img/Couverture_test.jpg" height="150px" width="100px"/></div></td>
     		<div id=\"description\">
     		<td><h2>'.$livre->idUtilisateur.'</h2>
     		<p>'.$livre->idLivre.'</p>
     		</td><td width=\"20%\"><p>Résumé : '.$livre->numeroPage.'</p></td>
     		</br>
     		</div>
     		<div id=\"note\">
     			<td><p>Note : '.$livre->dateModification.'</p></br></br></br></br></br></td>
     		</div>
     		<div id=\"boutons\">
     			<td width=\"10%\"><input type=\"button\"value=\"Consulter détails livre\"></br></br></br>
     			<input type=\"button\"value=\"Ajouter a sa bibliothèque\"></br></br></br></br></td></tr>
     		</div>
		</div>';
			}
			?>

	</div>
</section>

