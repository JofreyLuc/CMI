




<!-- Top 10 des livres, faire les cadres plus grands et les remplir -->
<section>

	<div id="top10">
		<div >
			<?php
			foreach($livres as $livre)
			{
				echo '<div id="test">
   	<img src="conf/img/Couverture_test.jpg" height="150px" width="100px"/>
     		<div id="description">
     		<h2>'.$livre->titre.'</h2>
     		<p>'.$livre->auteur.'</p>
     		<p>'.$livre->resume.'</p>
     		</br>
     		</div>
     		<div id="note">
     			<p>Note : '.$livre->noteMoyenne.'</p></br></br></br></br></br>
     		</div>
     		<div id="boutons">
     			<input type="button"value="Consulter détails livre" onclick="document.location.href = \'http://localhost:8888/CMI/projet/src/books/'.$livre->idLivre.'\';"></br></br></br>
     			<input type="button"value="Ajouter a sa bibliothèque"id="boutonAdd'.$livre->idLivre.'" ></br></br></br>
  <input type="button" value="Commencer lecture"  onclick="document.location.href = \'http://localhost:8888/CMI/projet/src/lecture/'.$livre->idLivre.'\';" >
     		</div>
</div>' ;
			}
			?>
		</div>
	</div>
</section>