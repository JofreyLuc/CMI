





		
					
						<?php

							echo '<div id="test">
   	<img src="conf/img/Couverture_test.jpg" height="150px" width="100px"/>
     		<div id="description">
     		<h2>'.$livres->titre.'</h2>
     		<p>'.$livres->auteur.'</p>
     		<p>Résumé : '.$livres->resume.'</p>
     		</br>
     		</div>
     		<div id="note">
     			<p>Note : '.$livres->noteMoyenne.'</p></br></br></br></br></br>
     		</div>
     		<div id="boutons">
     			<input type="button" class="BoutonTxt" value="Consulter détails livre" onclick="document.location.href = \'/CMI/projet/src/books/'.$livres->idLivre.'\';"></br></br></br>
     			</br></br></br>
  <input type="button" class="BoutonTxt" value="Commencer lecture">
     		</div>
</div>' ;

						?>
					