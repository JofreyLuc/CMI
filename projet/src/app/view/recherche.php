<!--

<section>
    <div id="Barre_recherche">
        <form action="" class="formulaire">
            <input class="champ" type="text" value="Rechercher.." />
            <input class="validRecherche" type="button" value="valider"/>
            <input class="avancee" type="button" value="+" onclick="document.location.href='recherche_avance.php';"/>
        </form>

    </div>
</section>

-->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<!--
script pour cacher / afficher recherche avancée
-->
<script>
    $(document).ready(function(){

        $("#moins").click(function(){
            //$("p").hide();
            document.getElementById("coucou").style.visibility = "hidden";
        });
        $("#plus").click(function(){
            // $("p").show();
            document.getElementById("coucou").style.visibility = "visible";
        });
    });
</script>








<!-- script validation formulaire de recherche -->
<script type="text/javascript">
        function valider ( )
    {
        //alert(document.getElementById('titre').value);
        //alert(document.getElementById('genre').value);
       // alert(document.getElementById('auteur').value)
        if ( document.getElementById('titre').value.length == 0){
            if ( document.getElementById('auteur').value.length == 0){
                if ( document.getElementById('genre').value.length == 0){
                    if( document.getElementById('langues').options[document.getElementById('langues').selectedIndex ].value.length == 0){
                        valid = false;
                        document.getElementById("titre").focus();
                        document.getElementById("erreurForm").style.visibility = "visible";
                        return valid;
                    }               
                }
            }
        }
    }
</script>



<!-- script useless
<script>
    // Shorthand for $(document).ready();
    $(function() {
        $("#myform").submit(function(){
            if(document.getElementById('auteur') != ''){
                var auteur = $('#auteur').val();
                if(document.getElementById('titre') != ''){
                    var titre = $('#titre').val();
                    if(document.getElementById('genre') != ''){
                        var genre = $('#genre').val();
                        if(document.getElementById('langue') != '') {
                            var genre = $('#langue').val();
                            if (document.getElementById('date') != '') {
                                var date = $('#date').val();
                                // rien n'est vide
                                // document.location.href = "http://localhost:8888/CMI/projet/src/books?titre=" + title + "&auteur=" + auteur + "&genre=" + genre + "langue=" + langue + "date=" + date;
                            } else {
                                //la date est vide
                                //document.location.href = "http://localhost:8888/CMI/projet/src/books?titre=" + title + "&auteur=" + auteur + "&genre=" + genre + "langue=" + langue;
                            }
                        }else{
                            // la date et la langue sont vide
                            // document.location.href = "http://localhost:8888/CMI/projet/src/books?titre=" + title + "&auteur=" + auteur + "&genre=" + genre;
                        }
                    }else{
                        // le genre la date et la langue sont vide
                        //   document.location.href = "http://localhost:8888/CMI/projet/src/books?titre=" + title + "&auteur=" + auteur;
                    }
                }else{
                    // le genre la date la langue et le titre est vide
                    //  document.location.href = "http://localhost:8888/CMI/projet/src/books?auteur=" + auteur;
                }
            }else{
                // tout est vide
                //  document.location.href = "http://localhost:8888/CMI/projet/src/books/find?auteur=" + keywork + "&titre=" + keyword;
            }




            // $(this).attr('action', "http://localhost:8888/CMI/projet/src/books?titre="+title+"&auteur="+auteur);
            //document.location.href="http://localhost:8888/CMI/projet/src/books?titre="+title+"&auteur="+auteur;
            //$(this).attr('action', "http://google.com");
        });
    });
</script>
-->



<link rel="stylesheet" href="conf/css/recherche_form.css" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<div id="tfheader">
    <form id="tfnewsearch" name ="myform" onsubmit="return valider ();" method="get" action='' >
        <input type="text" placeholder="Titre" id="titre" class="tftextinput" name="titre" size="21" maxlength="120"><input type="submit" value="search" class="tfbutton">
        <input type="button" class="more" name="plus" size="5" maxlength="15" value="+" id="plus"><input type="button" class="more" name="plus" size="5" id ="moins" maxlength="15" value="-">
        <!-- partie cachée de la recherche advance -->
        <p id="coucou" name="avance" style="visibility : hidden;">
            <input type="text" id="auteur" name="auteur" placeholder="Auteur"> </br>
         <!--   Titre : <input type="text" id="titre" name="titre"> </br>-->
            <input type="text" id="genre" name="genre" placeholder="Genre" ><br>
            <select id="langues" name="langue">
                <option disabled selected value>Sélectionner une langue</option>
                <?php
                  /*  foreach($langues as $langue){
                        echo '<option>'.$langue['langue'].'</option>';
                    }*/
                ?>
            </select>
            </br>
            <!--<input type="text" id="datepicker" name="date" placeholder="Date"> </br>-->
        </p>
        <p id="erreurForm" style="visibility : hidden; color: red; text-align: center;">Vous devez renseigner au moins une catégorie</p>
    </form>
    
    <div class="tfclear"></div>
</div>
