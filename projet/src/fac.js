"use strict";

var fac = (function() {
	return {
		modules:{}
	}
})();



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
		console.log(data);
		tokenOK = data;
	});



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
		console.log(data);
		userOK = data;
	});





fac.modules.app = (function () {
	return {
		post: function(url, data, callback) {
			$.ajax({
				url: url,
				data: data,
				type: "POST",
				success: callback,
				async: false,
				beforeSend: function (request)
				{
					request.setRequestHeader("Authorizatio",tokenOK);
				},
				statusCode: {
					403: function() {
						alert('Vous avez déjà entré un commenraire pour ce livre');
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
		},
		get: function (url, callback) {
			$.ajax({
				url: url,
				type: "GET",
				success: callback,
				async: false,
				beforeSend: function (request)
				{
					request.setRequestHeader("Authorizatio",tokenOK);
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
	}
})();

fac.modules.users = (function(){
	return {
		init: function() {
			$('#btn-users').click(function(){
				fac.modules.app.get('http://localhost:8888/CMI/projet/src/users1', function(data) {
					console.log(data);
				});
			});

			$('#btn-create').click(function() {
				var user = {
					email: "Romain",
					password: "dsfdgd",
					nom: "dago",
					prenom: "rom",
					pseudo: "fdvdf"
				};
				// Si on veut savoir le type du json, à voir ???
				// var json = JSON.stringify({User: user});
				var json = JSON.stringify(user);
				console.log(json);
				fac.modules.app.post('http://localhost:8888/CMI/projet/src/user/new', user, function(data) {
					console.log(data);
				});
			});



			/*
			 // script pour ajout d'un livre dans sa biblio perso
			 $('.importBiblioButton').click(function() {
			 // recupération du livre
			 var livre = fac.modules.app.get('/CMI/projet/src/api/books/1', function(data) {
			 console.log(data);
			 });
			 alert(livre);


			 //var idLivre = livre['idLivre'];
			 //console.log(idLivre);
			 //var data = {idLivre:"666", numeroPage:"2"};

			 //	var boutonid = document.getElementById('boutonAdd1').getAttribute('id');console.log(boutonid)

			 // Si on veut savoir le type du json, à voir ???
			 // var json = JSON.stringify({User: user});
			 //var json = JSON.stringify(user);
			 //console.log(json);

			 //fac.modules.app.post('/CMI/projet/src/api/users/1/library/web', data, function(data) {
			 //		console.log(data);
			 //});


			 });



			 */
			$('.importBiblioButton').click(function() {
				// recuperation de l'id
				var idLivre = $(this).attr('id');
				// concatenation
				var urlLivreEntier = '/CMI/projet/src/api/books/'+idLivre;

				/*var livre = $.ajax({
					type: 'GET',
					url: urlLivreEntier,
					async: false,
					//dataType: 'json',
					//data: {action: 'getHotelsList'},
					done: function (results) {
						JSON.parse(results);
						return results;
					},
					fail: function (jqXHR, textStatus, errorThrown) {
						console.log('Could not get posts, server response: ' + textStatus + ': ' + errorThrown);
					}
				}).responseJSON;*/



				//var id = livre[0].idLivre;
				// creation des data à envoyer
				var biblio = {
					idLivre: idLivre,
					positionLecture: 0
				};



				// envoie du resultat


				// ajout d'un livre dans la biblio d'un user 
				fac.modules.app.post('/CMI/projet/src/api/users/'+userOK+'/library/web', biblio, function(data) {
					//console.log(data);
				});


				// modification du style du bouton une fois la requête effectuée
				$(this).attr('value', 'Ajout effectué');
				$(this).attr("disabled", true);

			});




/*
			 // script ajax pour   ajouter une eval
			$('#buttonSubmitEval').click( function() {
				//var idLivre = $(this).attr('id');
				var id = document.getElementById('idDuLivre').innerHTML;
				//alert(id);
				var commentaire = document.getElementById('comment').value;
				var note = document.getElementById('noteEval').value;

				var evaluation = {
					commentaire: commentaire,
					note: note
				};


				fac.modules.app.post('/CMI/projet/src/api/users/1666666/books/'+id+'/ratings/web', evaluation, function(data,xhr) {
					//console.log(data);
					//  /api/users/:idUser/books/:idBook/ratings
					
				});
				// une fois l'envoie du commentaire fait, on peut cacher la partie formulaire
				$(this).attr('value', 'Ajout effectué');
				$(this).attr("disabled", true);
				$("#comment_form").empty().hide();

				// affiche les eval quand on en ajoute une autre
				var a = fac.modules.app.get('/CMI/projet/src/api/books/'+id+'/ratings', function(data) {
					console.log(data);
					$("#zone_de_chargement_de_base").hide();
					$("#zone_de_chargement_de_base").innerHTML = "";
					//on affecte les resultats au div
					$("#zone_de_rechargement").append(JSON.stringify(data));
					//on affiche les resultats avec la transition
					$('#zone_de_rechargement').fadeIn(2000);
				});

			});



			// affiche les eval pour le livre dans la div associé quand la page est chargé
			$(document).ready(function(){
				var id = document.getElementById('idDuLivre').innerHTML;
				var a = fac.modules.app.get('/CMI/projet/src/api/books/'+id+'/ratings', function(data) {
					//console.log(data);
					$("#zone_de_chargement_de_base").append(JSON.stringify(data));


				});
			});

*/
		}
	}
})();

$(document).ready(function() {
	fac.modules.users.init();
});