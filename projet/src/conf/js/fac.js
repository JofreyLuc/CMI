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
                type: 'POST',
                dataType: 'json',
                success: callback,
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log('URI : ' + url);
                    console.log(jqXHR);
                    console.log(textStatus);
                    console.log(errorThrown);
                }
            });
        },
        get: function (url, callback) {
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
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
			fac.modules.app.get('http://localhost/frameworks/slim/users', function(data) {
				console.log(data);
			})
		});
		
		$('#btn-create').click(function() {
			var name = {
				id: 12,
				name: 'Romain' 
			}
			var json = JSON.stringify(name);
			console.log(json);
				fac.modules.app.post('http://localhost/frameworks/slim/user/new', json, function(data) {
					console.log(data);
				});
		});
	}
	}
})();

$(document).ready(function() {
	fac.modules.users.init();
});
