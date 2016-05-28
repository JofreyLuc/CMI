
<link rel="stylesheet" href="../conf/css/file4.css" />

<script src="/CMI/projet/src/epub.js-master/build/epub.js"></script>
<script src="/CMI/projet/src/epub.js-master/build/libs/zip.min.js"></script>

<section>

<div id="titreT"> <h3> Lecture </h3> </div>

	
<div id="lecture">
    <div id="main">
        <div id="prev" onclick="book.prevPage();" class="arrow">‹</div>
    	<div id="area"></div>
    	<div id="next" onclick="book.nextPage();" class="arrow">›</div>
	</div>

<script>
	"use strict";


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



	var book = ePub("/CMI/projet/src/pg76.epub");

  var rendered=book.renderTo("area");


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
    get('/CMI/projet/src/api/library',function(data,xhr) {});
    //pourcentage a iserer a la place du 0.3
    book.goto(book.locations.cfiFromPercentage(0.3));
    //toutes les 5 secs, on envoi la progression au serveur
    setInterval(recup_progres, 5000);
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
      var id = 1;
      var progres = {
        idBibliotheque : id,
        positionLecture : currentPage,
      };
      //le put qui envoi les info au server (put ok mais pas bon format)
      post('/CMI/projet/src/api/users/1/library/1/web', progres,function(data,xhr) {
        console.log(data);
      });
	}

  setTimeout(init_lecture, 1000);
</script>

<button onclick="test()" >try </button>
</section>