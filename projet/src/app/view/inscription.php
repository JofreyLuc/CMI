
<link rel="stylesheet" href="conf/css/form_register.css">




    <form id="myForm" method="post" action="http://localhost:8888/CMI/projet/src/inscription/verification">

        <label class="form_col" for="lastName">Nom :</label>
        <input name="nom" id="lastName" type="text" />
        <br /><br />

        <label class="form_col" for="firstName">Prénom :</label>
        <input name="prenom" id="firstName" type="text" />
        <br /><br />

        <label class="form_col" for="email">E-mail :</label>
        <input name="email" id="email" type="text" />
        <span class="tooltip">L'adresse e-mail est incorrect</span>
        <br /><br />

        <label class="form_col" for="pseudo">Login :</label>
        <input name="pseudo" id="pseudo" type="text" />
        <span class="tooltip">Le login ne peut pas faire moins de 4 caractères</span>
        <br /><br />

        <label class="form_col" for="pwd1">Mot de passe :</label>
        <input name="pwd1" id="pwd1" type="password" />
        <span class="tooltip">Le mot de passe ne doit pas faire moins de 6 caractères</span>

        <br /><br />

        <label class="form_col" for="pwd2">Mot de passe (confirmation) :</label>
        <input name="pwd2" id="pwd2" type="password" />
        <span class="tooltip">Le mot de passe de confirmation doit être identique à celui d'origine</span>
        <br /><br />

        <span class="form_col" for="conditions"></span>
        <label><input name="conditions" id="conditions" type="checkbox" /> J'accepte les <a href="http://localhost:8888/CMI/projet/src/condition_utilisation">conditions générales d'utilisation</a></label>
        <span class="tooltip">Vous devez accepter les conditions générales</span>
        <br /><br />

        <span class="form_col"></span>
        <input type="submit" value="M'inscrire" /> <input type="reset" value="Réinitialiser le formulaire" />

    </form>


<script type="text/javascript">

// Fonction de désactivation de l'affichage des "tooltips"
function deactivateTooltips() {

    var tooltips = document.querySelectorAll('.tooltip'),
        tooltipsLength = tooltips.length;

    for (var i = 0; i < tooltipsLength; i++) {
        tooltips[i].style.display = 'none';
    }

}


// La fonction ci-dessous permet de récupérer la "tooltip" qui correspond à notre input

function getTooltip(elements) {

    while (elements = elements.nextSibling) {
        if (elements.className === 'tooltip') {
            return elements;
        }
    }

    return false;

}

function isEmail(myVar){
    // La 1ère étape consiste à définir l'expression régulière d'une adresse email
    var regEmail = new RegExp('^[0-9a-z._-]+@{1}[0-9a-z.-]{2,}[.]{1}[a-z]{2,5}$','i');

    return regEmail.test(myVar);
}


// Fonctions de vérification du formulaire, elles renvoient "true" si tout est ok

var check = {}; // On met toutes nos fonctions dans un objet littéral

/*check['lastName'] = function(id) {

    var name = document.getElementById(id),
        tooltipStyle = getTooltip(name).style;

    if (name.value.length >= 2) {
        name.className = 'correct';
        tooltipStyle.display = 'none';
        return true;
    } else {
        name.className = 'incorrect';
        tooltipStyle.display = 'inline-block';
        return false;
    }

};

check['firstName'] = check['lastName'];*/ // La fonction pour le prénom est la même que celle du nom

check['email'] = function() {

    var email = document.getElementById('email'),
        tooltipStyle = getTooltip(email).style;
    
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

    if (re.test(email.value)) {
        email.className = 'correct';
        tooltipStyle.display = 'none';
        return true;
    } else {
        email.className = 'incorrect';
        tooltipStyle.display = 'inline-block';
        return false;
    }

};

check['pseudo'] = function() {

    var login = document.getElementById('pseudo'),
        tooltipStyle = getTooltip(login).style;

    if (login.value.length >= 4) {
        login.className = 'correct';
        tooltipStyle.display = 'none';
        return true;
    } else {
        login.className = 'incorrect';
        tooltipStyle.display = 'inline-block';
        return false;
    }

};

check['pwd1'] = function() {

    var pwd1 = document.getElementById('pwd1'),
        tooltipStyle = getTooltip(pwd1).style;

    if (pwd1.value.length >= 6) {
        pwd1.className = 'correct';
        tooltipStyle.display = 'none';
        return true;
    } else {
        pwd1.className = 'incorrect';
        tooltipStyle.display = 'inline-block';
        return false;
    }

};

check['pwd2'] = function() {

    var pwd1 = document.getElementById('pwd1'),
        pwd2 = document.getElementById('pwd2'),
        tooltipStyle = getTooltip(pwd2).style;

    if (pwd1.value == pwd2.value && pwd2.value != '') {
        pwd2.className = 'correct';
        tooltipStyle.display = 'none';
        return true;
    } else {
        pwd2.className = 'incorrect';
        tooltipStyle.display = 'inline-block';
        return false;
    }

};


// Mise en place des événements

(function() { // Utilisation d'une IIFE pour éviter les variables globales.

    var myForm = document.getElementById('myForm'),
        inputs = document.querySelectorAll('input[type=text], input[type=password]'),
        inputsLength = inputs.length;

    for (var i = 0; i < inputsLength; i++) {
        inputs[i].addEventListener('keyup', function(e) {
            check[e.target.id](e.target.id); // "e.target" représente l'input actuellement modifié
        });
    }

    myForm.addEventListener('submit', function(e) {

        var result = true;
        for (var i in check) {
            result = check[i](i) && result;
        }

        if (result) {
            alert('Le formulaire est bien rempli.');
            myForm.submit();
        }

        e.preventDefault();

    });

    myForm.addEventListener('reset', function() {

        for (var i = 0; i < inputsLength; i++) {
            inputs[i].className = '';
        }

        deactivateTooltips();

    });

})();


// Maintenant que tout est initialisé, on peut désactiver les "tooltips"

deactivateTooltips();


</script>


