"use strict";

var fac = (function() {
    return {
        modules:{}
    }
})();



var tokenOK;
var recupToken= $.ajax({
        type        : 'GET', // define the type of HTTP verb we want to use (POST for our form)
        url         : '/CMI/projet/src/session', // the url where we want to POST
        encode          : true,
        dataType : 'JSON'

    })
    // using the done promise callback
    .done(function(data) {
        console.log("var recup dedans : " +data);
        tokenOK = data;
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
                beforeSend: function (request)
                {
                    request.setRequestHeader("Authorizatio", tokenOK);
                },
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
            $('.importBiblioButton').click(function() {
                // recuperation de l'id
                var idLivre = $(this).attr('id');
                // concatenation
                var urlLivreEntier = '/CMI/projet/src/api/books/'+idLivre;


                //var id = livre[0].idLivre;
                // creation des data à envoyer
                var biblio = {
                    idLivre: idLivre,
                    positionLecture: 0
                };

                // l'id de l'user est entré en dur tant qu'on a pas de connexion
                fac.modules.app.post('/CMI/projet/src/api/users/1/library/web', biblio, function(data) {
                    console.log(data);
                })


                // modification du style du bouton une fois la requête effectuée
                $(this).attr('value', 'Ajout effectué');
                $(this).attr("disabled", true);

            });



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


                fac.modules.app.post('/CMI/projet/src/api/users/2/books/'+id+'/ratings/web', evaluation, function(data,xhr) {
                    //console.log(data);
                    //  /api/users/:idUser/books/:idBook/ratings

                });
                // une fois l'envoie du commentaire fait, on peut cacher la partie formulaire
                $(this).attr('value', 'Ajout effectué');
                $(this).attr("disabled", true);
                $("#comment_form").empty().hide();

                // affiche les eval quand on en ajoute une autre
                var a = fac.modules.app.get('/CMI/projet/src/api/books/'+id+'/ratings', function(data) {
                    fac.modules.users.afficher_evaluation(data);
                });

            });



            // affiche les eval pour le livre dans la div associé quand la page est chargé
            $(document).ready(function(){
                var id = document.getElementById('idDuLivre').innerHTML;
                var a = fac.modules.app.get('/CMI/projet/src/api/books/'+id+'/ratings', function(data) {
                    fac.modules.users.afficher_evaluation(data);
                    //$("#zone_de_chargement_de_base").append(JSON.stringify(data));


                });
            });
        },

        afficher_evaluation: function(data) {
            var modif=$("#zone_de_chargement_de_base").empty();
            for(var evaluation in data){
                modif.append(
                    '<div id="test">'+
                        '<img src="/CMI/projet/src/conf/img/Couverture_test.jpg" height="150px" width="100px"/>'+
                        '<div id="description">'+
                            '<h2>'+data[evaluation].utilisateur.pseudo+'</h2>'+
                            '<h3>Note : '+data[evaluation].note+'</p>'+
                            '<img src="/CMI/projet/src/conf/img/rating/'+data[evaluation].note+'.png">'+
                            '<p>'+data[evaluation].commentaire+'</p>'+
                        '</div>'+
                    '</div>');
            }
        }
    }
})();

$(document).ready(function() {
    fac.modules.users.init();
});