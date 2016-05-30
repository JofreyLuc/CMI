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
       // console.log(data);
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
        //console.log(data);
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
                    request.setRequestHeader("Auth",tokenOK);
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
                    request.setRequestHeader("Auth", tokenOK);
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
                fac.modules.app.post('/CMI/projet/src/api/users/'+userOK+'/library/web', biblio, function(data) {
                   // console.log(data);
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

                // ajout du commentaire
                fac.modules.app.post('/CMI/projet/src/api/users/'+userOK+'/books/'+id+'/ratings/web', evaluation, function(data,xhr) {
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



                $('.supprimerEval').click( function() {
                    // /api/users/:idUser/books/:idBook/ratings/:idRating
                    // id du livre
                    var idLivre = document.getElementById('idDuLivre').innerHTML;
                    // id de leval à delete
                    var idEval = $(this).attr('id');

                    var deleteOK;
                    var deleteLivre = $.ajax({
                            type        : 'DELETE', // define the type of HTTP verb we want to use (POST for our form)
                            url         : '/CMI/projet/src/api/users/'+userOK+'/books/'+idLivre+'/ratings/'+idEval+'',
                            dataType    : 'json', // what type of data do we expect back from the server
                            encode          : true,
                            beforeSend: function (request)
                            {
                                request.setRequestHeader("Auth",tokenOK);
                            },
                            statusCode: {
                                403: function() {
                                    alert('Ce n est pas votre éval');
                                },
                                203: function() {
                                    alert('Evaluation supprimée');
                                },
                                500: function(){

                                }

                            }

                        })
                        // using the done promise callback
                        .done(function(data) {
                            //console.log(data);
                            deleteOK = data;

                        });

                });


            });
        },







        afficher_evaluation: function(data) {
            var modif=$("#zone_de_chargement_de_base").empty();
            for(var evaluation in data){
                modif.append(
                    '<div id="test">'+
                        '<a href="/CMI/projet/src/users/'+JSON.stringify(data[evaluation].idUtilisateur)+'"><img src="/CMI/projet/src/conf/img/user.jpg" height="150px" width="150px"/></a>'+
                        '<div id="description">'+
                            '<h2>'+data[evaluation].utilisateur.pseudo+'</h2>'+
                            '<img src="/CMI/projet/src/conf/img/rating/'+data[evaluation].note+'.png">'+
                            '<p>'+data[evaluation].commentaire+'</p>'+
                            '<input type="button" class="supprimerEval" id="'+data[evaluation].idEvaluation+'" value="Supprimer l\'évaluation"/>'+
                        '</div>'+
                    '</div>');
            }
        }







    }
})();

$(document).ready(function() {
    fac.modules.users.init();
});