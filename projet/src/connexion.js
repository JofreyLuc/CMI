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
          /*  $('.formulaireConnexion').submit(function() {
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

            });*/











            // affiche les eval pour le livre dans la div associé quand la page est chargé
            $(document).ready(function(){

              /*  $('formulaireConnexion').submit(function(event) {

                    // get the form data
                    // there are many ways to get this data using jQuery (you can use the class or id also)
                    var formData = {
                        'email'             : $('input[name=login]').val(),
                        'password'          : $('input[name=password]').val()
                    };
                    console.log(formData);

                    // process the form
                  / $.ajax({
                            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
                            url         : 'process.php', // the url where we want to POST
                            data        : formData, // our data object
                            dataType    : 'json', // what type of data do we expect back from the server
                            encode          : true
                        })
                        // using the done promise callback
                        .done(function(data) {

                            // log data to the console so we can see
                            console.log(data);

                            // here we will handle errors and validation messages
                        });

                    // stop the form from submitting the normal way and refreshing the page
                    event.preventDefault();
                });*/



            });


        }
    }
})();

$(document).ready(function() {
    fac.modules.users.init();
});