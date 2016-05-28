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
                    //console.log(data);
                });


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


                fac.modules.app.post('/CMI/projet/src/api/users/1/books/'+id+'/ratings/web', evaluation, function(data,xhr) {
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


        }
    }
})();

$(document).ready(function() {
    fac.modules.users.init();
});