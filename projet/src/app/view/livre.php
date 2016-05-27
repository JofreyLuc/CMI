


<script src="fac.js"></script>


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
            <img src="/CMI/projet/src/conf/img/drapeaux/'.$livre->langue.'.png" width="50px" height="50px">
            </br>
            </br>
     		</div>
            <div id="note">
                </br>
                <p>Note : '.$livre->noteMoyenne.'</p>
                <img src="/CMI/projet/src/conf/img/rating/'.$livre->noteMoyenne.'.png">
                </br></br></br>
            </div>
     		<div id="boutons">
     			<input type="button"value="Consulter détails livre" class="BoutonTxt" onclick="document.location.href = \'/CMI/projet/src/books/'.$livre->idLivre.'\';"></br></br></br>
     			<input type="button"value="Ajouter a sa bibliothèque" class ="importBiblioButton" id="'.$livre->idLivre.'" ></br></br></br>
  <input type="button" value="Commencer lecture"  class="BoutonTxt" onclick="document.location.href = \'/CMI/projet/src/lecture/'.$livre->idLivre.'\';" >
     		</div>
</div>' ;
			}
			?>
		</div>
        <?php
        if($total != null){
            for($i = 1; $i <= $total; $i++){
                echo "<input  onclick=document.location.href='/CMI/projet/src/books?page=".$i."' type='button' value='".$i."'> </>";
            }
        }
        ?>
	</div>
</section>