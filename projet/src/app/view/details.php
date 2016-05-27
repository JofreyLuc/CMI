

<link rel="stylesheet" href="../conf/css/file4.css" />
<script src="fac.js"></script>
<section>
    <div id="titreT"> <h3> Détails du livre </h3> </div>
    <div id="detail">
        <?php
        foreach($livre as $l){
        echo'
        
        <div style="border:#FFDA00 solid medium">
            <!-- <img src="conf/img/Couverture_test.jpg" class="Couv"/>   --->
           <img src="conf/img/Couverture_test.jpg" height="150px" width="100px"/>
            <div id="description">
                <div id="titreBouquin" > <h2>'.$l->titre.'</h2> </div>
                <div id="auteur"> <p>'.$l->auteur.'</p> </div>
                <div id="genre"> <p>'.$l->genre.'</p> </div>
                </br>
            </div>
            <div id="note">
                <p>Note :'.$l->note.'</p></br></br></br></br></br>
            </div>
            <div id="boutons">
                <input type="button" class="BoutonTxt" value="Consulter détails livre"></br></br></br>
                <input type="button"value="Ajouter a sa bibliothèque" class ="importBiblioButton" id="'.$l->idLivre.'" ></br></br></br>
                <input type="button" class="BoutonTxt"  value="Commencer lecture"  onclick="document.location.href = \'/CMI/projet/src/lecture/'.$l->idLivre.'\';"> </br>
            </div>
        </div>

</section>
';}
?>
