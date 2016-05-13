

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