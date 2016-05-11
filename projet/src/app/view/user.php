<h1> BONJOUR LA FAC !!!! </h1>
<?php
foreach($users as $user) {
	echo "<h3> $user->nom </h3>";
}?>

<button id="btn-users"> GET USERS !!</button>
<p>name</p>	
<input type="text" id="inputName">
<button id="btn-create"> Post ...</button>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="../conf/js/fac.js"></script>

