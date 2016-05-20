





		
					
						<?php
						foreach($livres as $l){						
							echo '<div id="test">
   	<img src="conf/img/Couverture_test.jpg" height="150px" width="100px"/>
     		<div id="description">
     		<h2>'.$l->titre.'</h2>
     		<p>'.$l->auteur.'</p>
     		<p>Résumé : '.$l->resume.'</p>
     		</br>
     		</div>
     		<div id="note">
     			<p>Note : '.$l->noteMoyenne.'</p></br></br></br></br></br>
     		</div>
     		<div id="boutons">
     			<input type="button"value="Consulter détails livre"></br></br></br>
     			<input type="button"value="Ajouter a sa bibliothèque"></br></br></br>
  <input type="button" value="Commencer lecture">
     		</div>
</div>' ;
						}
						?>
					