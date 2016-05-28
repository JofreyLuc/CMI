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

            // ajout un livre à la biblio
            $('.formulaireConnexion').submitclick(function() {
                var login = document.getElementById('login').innerHTML;
                var mdp = document.getElementById('password').innerHTML;
                alert (login + mdp);
                // l'id de l'user est entré en dur tant qu'on a pas de connexion
                fac.modules.app.post('/CMI/projet/src/api/users/1/library/web', biblio, function(data) {
                    //console.log(data);
                });


                // modification du style du bouton une fois la requête effectuée
                $(this).attr('value', 'Ajout effectué');
                $(this).attr("disabled", true);

            });









            // affiche les eval pour le livre dans la div associé quand la page est chargé
            $(document).ready(function(){
                var id = document.getElementById('idDuLivre').innerHTML;
               // var a = fac.modules.app.get('/CMI/projet/src/api/books/'+id+'/ratings', function(data) {
                    //console.log(data);
                   // $("#zone_de_chargement_de_base").append(JSON.stringify(data));


                //});
            });


        }
    }
})();

$(document).ready(function() {
    fac.modules.users.init();
});