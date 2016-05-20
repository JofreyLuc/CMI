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

<link rel="stylesheet" href="conf/css/recherche_form.css" />

<div id="tfheader">
    <form id="tfnewsearch" method="get" action="http://www.google.com">
        <input type="text" class="tftextinput" name="q" size="21" maxlength="120"><input type="submit" value="search" class="tfbutton">
        <input type="button" class="more" name="plus" size="5" maxlength="15" value="+">
    </form>
    <div class="tfclear"></div>
</div>