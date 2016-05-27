"use strict";

var fac = (function() {
	return {
		modules:{}
	}
})();

fac.modules.app = (function () {
	return {
		post: function(url, data, callback) {
			$.ajax({
				url: url,
				data: data,
				type: "POST",
				success: callback,
				async: false,
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


				// l'id de l'user est entré en dur
				fac.modules.app.post('/CMI/projet/src/api/users/1/library/web', biblio, function(data) {
					//console.log(data);
				});
				//$(this).value = "lalalala";
				$(this).attr('value',returndata);

			});











		}
	}
})();

$(document).ready(function() {
	fac.modules.users.init();
});