<!DOCTYPE html>
<html>
<head>
 <meta charset="utf-8" />
 <link rel="stylesheet" href="conf/css/file4.css" />

 <title>Callme Ishmael </title>
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<body>



<!-- version precedente
<header>
 <div id="titre1"> <h1> CallMe Ishmael</h1> </div>
 <div id="banniere">
  <form method="post" action="accueil_connexion.php">
   <p> <div id="login"><input type="text" name="login" placeholder="Login"/> </div><br/>
   <div id="mdp"><input type="password" placeholder="Password" mdp="mdp"/> </div> </br>
   <div id="co"> <input type="submit" value="Connexion"/> </div>
   <div id="ins"> <input type="button" value="Inscription"
                         onclick="document.location.href = 'http://localhost:8888/CMI/projet/src/inscription';"/> </div></p>
  </form>
 </div>
</header>

-->

<header>
 <img src="conf/img/logo2.jpg" class="logoImg"/>
 <div id="titre1"> <h1> Call Me Ishmael</h1>
 </div>
 <div id="banniere">
  <form method="post" action="accueil_connexion.php">
   <p> <div id="login"><input type="text" name="login" placeholder="Login"/> <br/>
   <input type="password" mdp="mdp" placeholder="Password"/> </div> </br>
   <div id="co"> <input type="submit" class="BoutonTxt"  value="Connexion"/>
  <input type="button" class="BoutonTxt"  value="Inscription" onclick="document.location.href = '/CMI/projet/src/inscription';"/> </div></p>
  </form>

 </div>


 <!-- Menu des différents boutons qui doivent être alignés et entourés -->
 <section>
  <div id="menu">
   <div id="test1"> <input type="button" value="Consulter sa bibliothèque"
                           onclick="document.location.href='/CMI/projet/src/library'"/></div>
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
