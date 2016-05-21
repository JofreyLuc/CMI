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



<!-- script de redirrection -->
<script>
    // Shorthand for $(document).ready();
    $(function() {
        $("#myform").submit(function(){
            var nom = $('#nom').val();
          //  $(this).attr('action', "http://localhost:8888/CMI/projet/src/books?titre="+nom);
            $(this).attr('action', "http://google.com");
        });
    });
</script>



<link rel="stylesheet" href="conf/css/recherche_form.css" />

<div id="tfheader">
    <form id="tfnewsearch" name ="myform" method="get" action=''>
        <input type="text" class="tftextinput" name="q" size="21" maxlength="120"><input type="submit" value="search" class="tfbutton">
        <input type="button" class="more" name="plus" size="5" maxlength="15" value="+" id="plus"><input type="button" class="more" name="plus" size="5" id ="moins" maxlength="15" value="-">
        <!-- partie cachée de la recherche advance -->
        <p id="coucou" name="avance" style="visibility : hidden;">
            Auteur : <input type="text" id="nom" name="nom"> </br>
            Titre : <input type="text" > </br>
            Genre : <input type="text"><br>
            Langue : <input type="text" > </br>
            date : <input type="text" > </br>
        </p>
    </form>
    <div class="tfclear"></div>
</div>



