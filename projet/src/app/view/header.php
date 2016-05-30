<!DOCTYPE html>
<html>
<head>
 <meta charset="utf-8" />
 <link rel="stylesheet" href="/CMI/projet/src/conf/css/file4.css" />

 <title>Callme Ishmael </title>
</head>

<body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>



<!-- script pour  la validation de la connexion -->
<script type="text/javascript"  >
  function submit_formulaire_co(){

   // get the form data
   // there are many ways to get this data using jQuery (you can use the class or id also)
   var formData = {
    'email'             : $('input[name=login]').val(),
    'password'          : $('input[name=password]').val()
   };
   //console.log(formData);

   // process the form
   $.ajax({
        type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
        url         : '/CMI/projet/src/users/login', // the url where we want to POST
        data        : formData, // our data object
        dataType    : 'json', // what type of data do we expect back from the server
        encode          : true,
        statusCode: {
         401: function() {
          alert('Login ou password incorrect');
         },
         200: function() {
         //alert('Welcome ' +  $('input[name=login]').val());
         }

        }
       })
       // using the done promise callback
       .done(function(data) {

           // log data to the console so we can see
           console.log(data);


           // j'envoie les infos retournés à un controller pour demarer la session et stocker les var dans $_SESSION
           $.ajax({
                   type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
                   url: '/CMI/projet/src/users/login/validation', // the url where we want to POST
                   data: data, // our data object
                   dataType: 'json', // what type of data do we expect back from the server
                   encode: true

               })
               // using the done promise callback
               .done(function (data) {
                   //alert(data[0].idUtilisateur);
                   // $("#zone_de_log_de_base").empty();
                   //on affecte les resultats au div
                   //  $("#zone_de_log_de_base").append(JSON.stringify(data));
                   //on affiche les resultats avec la transition
                   //  $('#zone_de_log_rechargement').fadeIn(2000);
                   //$("#reloadBiblio").load(location.href + " #reloadBiblio");


                   // $('#zone_de_log_de_base').empty();
                   // $('#zone_de_log_de_base').append('coucou');
                   // $('#zone_de_log_rechargement').load(test1.php);


               });
           window.location = "/CMI/projet/src/";

       });
      
      
      
      
      
      
   // stop the form from submitting the normal way and refreshing the page
   event.preventDefault();

  }
 </script>


<!-- script pour la déconnexion -->
<script>
    function logout(){
        $.ajax({
            type: 'get',
            url: '/CMI/projet/src/users/logout',
            cache: false,
            success: function(data){
                location.href ="/CMI/projet/src/";
               // alert(data);
            }
        });

        event.preventDefault();
    }
</script>


<!-- script pour affichage de la biblio selon l'état de connexion : log ou pas  -->
<script>

    $(document).ready(function() {
        $('#vous_devez_vous_co').click(function() {
           alert("Vous devez être co pour ça");

        });
    });

</script>



<!--
<div id="profil_header">
   <img src="/CMI/projet/src/conf/img/user.jpg" height="150px" width="150px"/>
   <div id="description">
        <h2>pseudo</h2>
        <p>coucou</p>
    </div>
</div>
-->




<div id="zone_de_log_rechargement"></div>







<header>
 <img src="/CMI/projet/src/conf/img/logo2.jpg" class="logoImg"/>
 <div id="titre1"> <h1> Call Me Ishmael</h1>
 </div>

 <div id="banniere">


     <div id="zone_de_log_de_base"><?php
         session_start();
         if(isset($_SESSION["token"])){
            // session_start();
             echo '
             <div id="profil_header">
             <a href="/CMI/projet/src/users/my"><img src="/CMI/projet/src/conf/img/user.jpg" height="100px" width="100px"/></a><input id="logout" type="button" value="logout" onclick="logout();return false;"><br>
             <h3>'.$_SESSION["email"].'</h3>
             </div>
        ';
         }else{
             echo '
               <form  method="post" id="formulaireConnexion">
   <p> <div id="login"><input type="text" name="login" placeholder="Email" id="login"/> <br/>
   <input type="password" name="password" id="password" placeholder="Password"/> </div> </br>
   <div id="co"> <input type="submit" class="BoutonTxt"  value="Connexion" id ="boutonConnexion" onclick="submit_formulaire_co();return false;"/>
  <input type="button" class="BoutonTxt"  value="Inscription" onclick="document.location.href = \'/CMI/projet/src/inscription\';"/> </div></p>
  </form>
             ';

         }
         ?></div>


     <div id="zone_de_log_apres" "></div>


 </div>
<br><br>

 <!-- Menu des différents boutons qui doivent être alignés et entourés -->
    <!--
 <section>
  <div id="menu">
     <?php /*echo ' <div id="test1"> <input type="button" value="Consulter sa bibliothèque"
                              href="/CMI/projet/src/users/".$_SESSION[\'idUtilisateur\'] ."/library"/></div>';
     echo '  <div id="test1"> <input type="button" value="Consulter sa bibliothèque"
           href="/CMI/projet/src/users/".$_SESSION[\'idUtilisateur\']."/library"/></div> ';*/
?>

      <div id="test1"> <input type="button"  value="Rechercher"
                           onclick="document.location.href='/CMI/projet/src/books'"/> </div>
   <div id="test1"> <input type="button" value="Liste de suivi"
                           onclick="document.location.href='/CMI/projet/src/users'"/> </div>
   <div id="test1"> <input type="button" value="Suggestion"
                           onclick="document.location.href='/CMI/projet/src'"/> </div>
   <div id="test1"> <input type="button" value="Top 10"
                           onclick="document.location.href='/CMI/projet/src/top10'"/> </div>
  </div>
 </section>
-->

    <!-- Menu des différents boutons qui doivent être alignés et entourés -->
    <section>
        <div id="menu">
            <?php
                if(isset($_SESSION["token"])) {
                    $idUserSession = $_SESSION["idUtilisateur"];
                   /* echo '
                      <div id="test1"> <a href="/CMI/projet/src/users/1/library"/>Consulter sa bibliothèque</a></div>
                    ';*/
                    echo "<div id='test1'><a href='/CMI/projet/src/users/".$idUserSession."/library' >Consulter sa bibliothèque <a/></div>";
                }else{
                   echo ' <div id="test1"> <a id="vous_devez_vous_co"/>Consulter sa bibliothèque</a></div>';
                }
            ?>


            <div id="test1"> <a href='/CMI/projet/src/books'> Rechercher</a> </div>
            <div id="test1"> <a href='/CMI/projet/src/users'>Liste de suivi</a> </div>
            <div id="test1"> <a href='/CMI/projet/src'>Suggestion</a></div>
            <div id="test1"> <a href='/CMI/projet/src/top10'>Top 10</a> </div>
        </div>
    </section>
</header>






<!--
<div class="header-shadow">
<table>
 <tr>
  <td>
   <img src="conf/img/logo2.jpg" class="logoImg"/>
  </td>
  <td>

   <div class="container">


    <div class="header-top">


     <nav class="navbar navbar-default menu" role="navigation"><h3 class="nav_right"><a href="index.html"><img src="images/logo.png" class="img-responsive" alt=""/></a></h3>
      <div class="container-fluid">


       <div class="navbar-header">

        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
         <span class="sr-only">Toggle navigation</span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
        </button>
       </div>


       <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav menu1">
         <li class="active"><a href="#home" class="scroll"> <span> </span><i class="menu-border"></i></a></li>
         <li><a href="#about" class="scroll">Bibliothèque</a></li>
         <li><a href="#services" class='scroll'>Recherche</a></li>
         <li><a href="#projects" class="scroll">Liste de suivi</a></li>
         <li><a href="#team" class="scroll">Suggestion</a></li>
         <li><a href="#news" class="scroll">Top 10</a></li>
        </ul>

         <form method="post" action="accueil_connexion.php">
          <p> <div id="login"><input type="text" name="login" placeholder="Login"/> <br/>
           <input type="password" mdp="mdp" placeholder="Password"/> </div>
          <div id="co"> <input type="submit" class="BoutonTxt"  value="Connexion"/>
           <input type="button" class="BoutonTxt"  value="Inscription" onclick="document.location.href = '/CMI/projet/src/inscription';"/> </div></p>
         </form>

       </div><
      </div>
     </nav>
     <div class="clear"></div>

    </div>

   </div>
   </div>
  </td>
 </tr>
</table>
<br><br><br><br><br>

-->
