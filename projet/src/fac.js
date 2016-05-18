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
				dataType: "json",
				success: callback,
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
			})
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
	}
	}
})();

$(document).ready(function() {
	fac.modules.users.init();
});
