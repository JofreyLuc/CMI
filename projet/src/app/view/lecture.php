<?php
foreach ($livre as $l) {
  $idlivre=$l->idLivre;
}
?>
<link rel="stylesheet" href="../conf/css/file4.css" />

<script src="/CMI/projet/src/epub.js-master/build/epub.js"></script>
<script src="/CMI/projet/src/epub.js-master/build/libs/zip.min.js"></script>

<section>

<div id="titreT"> <h3> Lecture </h3> </div>

    <!-- je te met ici l'id du livre en caché , tu peux la récup facilement comme ça -->
    <?php foreach ($livre as $l) {
echo '<p id="idDuLivre"  style="visibility: hidden;">$l->idLivre</p> '; } ?>

    <div id="lecture">
    <div id="main">
        <div id="prev" onclick="book.prevPage();" class="arrow">‹</div>
    	<div id="area"></div>
    	<div id="next" onclick="book.nextPage();" class="arrow">›</div>
	</div>

<script>
	"use strict";

// recuperation de l'id de l'user
var userOK;
var userRecup = $.ajax({
  type        : 'GET', // define the type of HTTP verb we want to use (POST for our form)
  url         : '/CMI/projet/src/session/user', // the url where we want to POST
  dataType    : 'json', // what type of data do we expect back from the server
  encode          : true

 })
 // using the done promise callback
 .done(function(data) {
  //console.log(data);
  userOK = data;
 });



    // recuperation du token
    var tokenOK;
    var tokenRecup = $.ajax({
            type        : 'GET', // define the type of HTTP verb we want to use (POST for our form)
            url         : '/CMI/projet/src/session/token', // the url where we want to POST
            dataType    : 'json', // what type of data do we expect back from the server
            encode          : true

        })
        // using the done promise callback
        .done(function(data) {
            //console.log(data);
            tokenOK = data;
        });




    function  post(url, data, callback) {
  $.ajax({
          url: url,
          data: data,
          type: "POST",
          success: callback,
          async: false,
          statusCode: {
              403: function() {

              },
              200: function() {

              }

          },
      beforeSend: function (request)
      {
          request.setRequestHeader("Auth",tokenOK);
      },
          error: function (jqXHR, textStatus, errorThrown) {
          console.log('URL : ' + url);
          console.log(jqXHR);
          console.log(textStatus);
          console.log(errorThrown);
        }
    });
};


function get(url, callback) {
    $.ajax({
        url: url,
        type: "GET",
        success: callback,
        async: false,
        beforeSend: function (request)
        {
            request.setRequestHeader("Auth",tokenOK);
        },
        done: function(response){return response;},
        error: function (jqXHR, textStatus, errorThrown) {
            console.log('url : ' + url);
            console.log(jqXHR);
            console.log(textStatus);
            console.log(errorThrown);
        },
        xhrFields: {
            withCredentials: true
        },
        crossDomain: true
    });
}


    var idLivre = document.getElementById('idDuLivre').innerHTML;
	//var book = ePub("/CMI/projet/src/pg"+<?php echo $idlivre?>+".epub");
    var book = ePub("/CMI/projet/src/pg"+idLivre+".epub");

  var rendered=book.renderTo("area");

  var dernier_progres=null;

	book.ready.all.then(function(){
        // Load in stored locations from json or local storage
        var key = book.settings.bookKey+'-locations'+'-locations';
        var stored = localStorage.getItem(key);
        if (stored) {
           return book.locations.load(stored);
        } else {
          // Or generate the locations on the fly
          // Can pass an option number of chars to break sections by
          // default is 150 chars
          return book.locations.generate();
        }  
    })



  /** PARTIE LIEN SERVEUR **/




  function init_lecture(){
    //le get
    get('/CMI/projet/src/api/users/'+userOK+'/library/',function(data) {
      dernier_progres=data[0].positionLecture;
    });
    //pourcentage a iserer a la place du 0.3
    book.goto(book.locations.cfiFromPercentage(dernier_progres));
    //toutes les 5 secs, on envoi la progression au serveur
    setInterval(recup_progres, 1000);
    //quand on quite la page aussi
    window.onbeforeunload=recup_progres;
  }

	function recup_progres(){
    	// Get the current CFI
    	var currentLocation = book.getCurrentLocationCfi();
      //console.log(currentLocation);
    	// Get the Percentage (or location) from that CFI
    	var currentPage = book.locations.percentageFromCfi(currentLocation);
    	if(currentPage>1){
    		currentPage=1;
    	}
      if(dernier_progres!=currentPage){
        var id = 1;
        var progres = {
          idBibliotheque : id,
          positionLecture : currentPage,
        };
        //le put qui envoi les info au server (put ok mais pas bon format)
          var idLivre = document.getElementById('idDuLivre').innerHTML;
       // post('/CMI/projet/src/api/users/'+userOK+'/library/'+<?php echo $idlivre?>+'/web', progres,function(data,xhr) {});
          post('/CMI/projet/src/api/users/'+userOK+'/library/'+idLivre+'/web', progres,function(data,xhr) {});

      }
      dernier_progres=currentPage;
	}

  setTimeout(init_lecture, 1000);
</script>

<button onclick="test()" >try </button>
</section>