
<link rel="stylesheet" href="../conf/css/file4.css" />

<script src="/CMI/projet/src/epub.js-master/build/epub.js"></script>
<script src="/CMI/projet/src/epub.js-master/build/libs/zip.min.js"></script>

<script>

</script>

<section>

<div id="titreT"> <h3> Lecture </h3> </div>

	
<div id="lecture">
    <div id="main">
        <div id="prev" onclick="Book.prevPage();" class="arrow">‹</div>
    	<div id="area"></div>
    	<div id="next" onclick="Book.nextPage();" class="arrow">›</div>
	</div>

<script>
	"use strict";
	var Book = ePub(<?php foreach($livre as $l){echo "\"".$l->lienEpub."\"";} ?>);

	Book.renderTo("area");

</script>

</section>