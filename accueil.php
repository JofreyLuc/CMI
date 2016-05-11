<!-- Menu des différents boutons qui doivent être alignés et entourés -->
<section>
<div id="titreM"> <h3> Menu </h3> </div>
<div id="bibli"> <input type="button" value="Consulter sa bibliothèque"/></div>
<div id="rechercher"> <input type="button"  value="Rechercher"/> </div>
<div id="liste"> <input type="button" value="Liste de suivi"/> </div>
<div id="suggestion"> <input type="button" value="Suggestion"/> </div>
<div id="top"> <input type="button" value="Top 10"/> </div>
</section>

<!-- Top 10 des livres, faire les cadres plus grands et les remplir -->
<section>
<div id="titreT"> <h3> Top 10 </h3> </div>
<div id="top10">
<div style="border:black solid medium">
<?php 
for( $i = 1 ; $i <= 10 ; $i++ ) 
  {

    echo '<div id="test"> <input type="text" value="bouquin'. $i .'"
    /> </div>' ;
  } 
?>
</div>
</div>
</section>