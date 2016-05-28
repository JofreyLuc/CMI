

<link rel="stylesheet" href="../conf/css/file4.css" />
<link rel="stylesheet" href="../conf/css/evaluation.css" />



<script>
    $(document).ready(function(){

        $("#afficher_form_eval").click(function(){
            //$("p").hide();
            document.getElementById("comment_form").style.visibility = "visible";
        });
    });
</script>








<script src="../fac.js"></script>
<section>
    <div id="titreT"> <h3> Détails du livre </h3> </div>
    <div id="detail">
        <?php
        foreach($livre as $l){
            echo'
        
        <div style="border:#FFDA00 solid medium">
            <!-- <img src="conf/img/Couverture_test.jpg" class="Couv"/>   --->
           <img src="../conf/img/Couverture_test.jpg" height="150px" width="100px"/>
            <div id="description">
                <div id="titreBouquin" > <h2>'.$l->titre.'</h2> </div>
                <div id="auteur"> <p>'.$l->auteur.'</p> </div>
                <div id="genre"> <p>'.$l->genre.'</p> </div>
                </br>
            </div>
            <div id="note">
                <p>Note :'.$l->note.'</p>
                <p id="idDuLivre" style="visibility : hidden;">'.$l->idLivre.'</p>
                </br></br></br></br></br>
            </div>
            <div id="boutons">
            <input type ="button" id="afficher_form_eval"  value="Evaluer ce livre" class="BoutonTxt" /><br><br><br>
            <input type ="button" id="afficheCommentaires" value="Afficher les évaluations" class="BoutonTxt"/><br><br><br>
                <input type="button"value="Ajouter a sa bibliothèque" name="importerbiblioButton" class ="importBiblioButton" id="'.$l->idLivre.'" ></br></br></br>
                <input type="button" class="BoutonTxt"  value="Commencer lecture"  onclick="document.location.href = \'/CMI/projet/src/lecture/'.$l->idLivre.'\';"> </br>
            </div>
        </div>

</section>
';}
        ?>

        <div id="afficherEvals">
            <?php
            foreach($eval as $e){
                echo '
                    <div>
                    <div> note = '.$e->note.'</div>
                    <div>commentaire = '.$e->commentaire.'</div>
                    </div>
                ';
            }
            ?>
        </div>
        <p id="test1" style="visibility : hidden;"> blabla</p>




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
