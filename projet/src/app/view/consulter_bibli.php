






				
			<?php
			//for($i = 0; $i < count($tab); $i++){

			foreach($livres as $l){

			
			echo '<tr>
				<div id="test">
					<td><img src="conf/img/Couverture_test.jpg" height="150px" width="100px"/></div></td>
				<div id="description">
					<td><h2>'.$l->titre.'</h2>
						<p>'.$l->auteur.'</p>
					</td><td width="20%"><p>Résumé : '.$l->resume.'</p></td>
					</br>
				</div>
				<div id="note">
					<td><p>Note : '.$l->noteMoyenne.'</p></br></br></br></br></br></td>
				</div>
				<div id="boutons">
					<td width="10%"><input type="button"value="Consulter détails livre"></br></br></br>
						</br></br></br></br></td></tr>
			</div>
			</div>';
			}
			?>

	</div>
</section>

