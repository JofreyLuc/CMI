





		
					
						<?php

							echo '<div id="test">
   	<img src="conf/img/Couverture_test.jpg" height="150px" width="100px"/>
     		<div id="description">
     		<h2>'.$livres->titre.'</h2>
     		<p>'.$livres->auteur.'</p>
            <img src="/CMI/projet/src/conf/img/drapeaux/'.$livres->langue.'.png" width="50px" height="50px">            
     		<p>Résumé : '.$livres->resume.'</p>
     		</div>
     		<div id="note">
     			<p>Note : '.$livres->noteMoyenne.'</p>';
                if($livres->noteMoyenne!=null) 
                    echo '<img src="/CMI/projet/src/conf/img/rating/'.$livres->noteMoyenne.'.png">';
                echo '</br></br></br></br></br>
     		</div>
     		<div id="boutons">
     			<input type="button" class="BoutonTxt" value="Consulter détails livre" onclick="document.location.href = \'/CMI/projet/src/books/'.$livres->idLivre.'\';"></br></br></br>
                <input type="button" value="Commencer lecture"  class="BoutonTxt" onclick="document.location.href = \'/CMI/projet/src/lecture/'.$livres->idLivre.'\';" ></br></br></br></br></br>
     		</div>
</div>' ;

						?>
					