
<section>
	<div id="titreT"> <h3> Top 10 </h3> </div>
	<div id="top10">

			<table>
			<?php
			foreach($livres as $livre)
			{
				echo '<tr>
			<div id="test">
     		<td><img src="conf/img/Couverture_test.jpg" height="150px" width="100px"/></div></td>
     		<div id="description">
     		<td><h2>'.$livre->titre.'</h2>
     		<p>'.$livre->auteur.'</p>
     		</td><td width="20%"><p>Résumé : '.$livre->resume.'</p></td>
     		</br>
     		</div>
     		<div id="note">
     			<td><p>Note : '.$livre->noteMoyenne.'</p></br></br></br></br></br></td>
     		</div>
     		<div id="boutons">
     			<td width="10%"><input type="button"value="Consulter détails livre"></br></br></br>
     			<input type="button"value="Ajouter a sa bibliothèque"></br></br></br></br></td></tr>
     		</div>
		</div>';
			}
			?>

	</div>
</section>