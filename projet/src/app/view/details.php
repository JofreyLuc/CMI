

<link rel="stylesheet" href="../conf/css/file4.css" />
<link rel="stylesheet" href="../conf/css/evaluation.css" />


<script src="../evaluation.js"></script>
<script>
    $(document).ready(function(){

        $("#afficher_form_eval").click(function(){
            //$("p").hide();
            document.getElementById("comment_form").style.visibility = "visible";
        });
    });
</script>









<section>
    <div id="titreT"> <h3> Détails du livre </h3> </div>
    <div id="detail">
        <?php
        foreach($livre as $l){
            echo '<div id="test">
           <img src="../conf/img/Couverture_test.jpg" height="150px" width="100px"/>
            <div id="description">
                <div id="titreBouquin" > <h2>'.$l->titre.'</h2> </div>
                <div id="auteur"> <p>'.$l->auteur.'</p> </div>
                <div id="genre"> <p>'.$l->genre.'</p> </div>
                <img src="/CMI/projet/src/conf/img/drapeaux/'.$l->langue.'.png" width="50px" height="50px">
            </div>
            <div id="note">
                </br></br>
                <p>Note : '.$l->noteMoyenne.'</p>';
                if($l->noteMoyenne!=null) 
                    echo '<img src="/CMI/projet/src/conf/img/rating/'.$l->noteMoyenne.'.png">';
                echo '
                <p id="idDuLivre" style="visibility : hidden;">'.$l->idLivre.'</p>
                </br></br>
            </div>
            <div id="boutons">
            <input type ="button" id="afficher_form_eval"  value="Evaluer ce livre" class="BoutonTxt" /><br><br><br>
                <input type="button"value="Ajouter a sa bibliothèque" name="importerbiblioButton" class ="importBiblioButton" id="'.$l->idLivre.'" ></br></br></br>
                <input type="button" class="BoutonTxt"  value="Commencer lecture"  onclick="document.location.href = \'/CMI/projet/src/lecture/'.$l->idLivre.'\';"> </br></br></br>
            </div>
        </div>

</section>
';}
        ?>

        <br/>

        <!-- zone prevu pour les evaluation -->
        <div id="zone_de_chargement_de_base"></div>

        <div id="zone_de_rechargement"></div>

        <br/>

        <div id="comment_form" style="visibility : hidden;">
            <div>
                <input type="url" name="noteEval" id="noteEval" value="" placeholder="Note"><p id="erreurNote"</p>
            </div>
            <div>
                <textarea rows="10" name="comment" id="comment" placeholder="Commentaire"></textarea>
            </div>
            <div>
                <input type="submit" name="submit" value="Add Comment" id="buttonSubmitEval">
            </div>
        </div>
