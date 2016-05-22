
    <link rel="stylesheet" href="conf/css/form_register.css">



<div class="main-content">

<script type="text/javascript">


    function valider ( )
    {

      /*  if ( document.getElementById('nom').value == "" )
        {
            valid = false;
            document.getElementById("erreurNom").style.visibility = "visible";
            document.getElementById("nom").focus();
            return valid;
        }*/

      /*  if ( document.getElementById('prenom').value == "" )
        {
            valid = false;
            document.getElementById("erreurPrenom").style.visibility = "visible";
            return valid;
        }

        if ( typeof document.getElementById('age').value == 'number' )
        {
            valid = false;
            document.getElementById("erreurAge").style.visibility = "visible";
            return valid;
        }else{

        }*/

        if ( document.getElementById('pseudo').value == "" )
        {
            valid = false;
            document.getElementById("erreurPseudo").style.visibility = "visible";
            document.getElementById("erreurEmail").style.visibility = "hidden";
            document.getElementById("erreurPsw").style.visibility = "hidden";
            document.getElementById("erreurPswTaille").style.visibility = "hidden";
            document.getElementById("pseudo").focus();
            return valid;
        }


       if ( document.getElementById('email').value == "" )
        {
            valid = false;
            document.getElementById("erreurEmail").style.visibility = "visible";
            document.getElementById("erreurPseudo").style.visibility = "hidden";
            document.getElementById("erreurPsw").style.visibility = "hidden";
            document.getElementById("erreurPswTaille").style.visibility = "hidden";
            document.getElementById("email").focus();
            return valid;
        }


        if ( document.getElementById('psw').value == "" )
        {
            valid = false;
            document.getElementById("erreurPsw").style.visibility = "visible";
            document.getElementById("erreurPseudo").style.visibility = "hidden";
            document.getElementById("erreurEmail").style.visibility = "hidden";
            document.getElementById("erreurPswTaille").style.visibility = "hidden";
            document.getElementById("psw").focus();
            return valid;
        }else{
            if(document.getElementById('psw').value.length < 5){
                valid = false;
                document.getElementById("erreurPsw").style.visibility = "hidden";
                document.getElementById("erreurPseudo").style.visibility = "hidden";
                document.getElementById("erreurEmail").style.visibility = "hidden";
                document.getElementById("erreurPswTaille").style.visibility = "visible";
                document.getElementById("psw").focus();
                return valid;
            }
        }

    }


</script>


    <br>
    <form class="form-register" method="post" onsubmit="return valider ();" action="http://localhost:8888/CMI/projet/src/inscription/verification">

        <div class="form-register-with-email">

            <div class="form-white-background">

                <div class="form-title-row">
                    <h1>Création de compte</h1>
                </div>

                <div class="form-row">
                    <label>
                        <span>Nom</span>
                        <input type="text" name="nom" id="nom">
                        <p id="erreurNom" style="visibility : hidden; color: red; text-align: center;">Vous devez renseigner votre nom</p>
                    </label>
                </div>

                <div class="form-row">
                    <label>
                        <span>Prenom</span>
                        <input type="text" name="prenom" id="prenom">
                        <p id="erreurPrenom" style="visibility : hidden;color: red;">Vous devez renseigner votre prenom</p>
                    </label>
                </div>

                <div class="form-row">
                    <label>
                        <span>Age</span>
                        <input type="text" name="age" id="age">
                        <p id="erreurAge" style="visibility : hidden;color: red;">Vous devez renseigner votre age</p>
                    </label>
                </div>

                <div class="form-row">
                    <label>
                        <span>Email <span style="color : red;">*</span></span>
                        <input type="email" name="email" id="email">
                        <p id="erreurEmail" style="visibility : hidden;color: red;text-align: center;">Vous devez renseigner votre email</p>
                    </label>
                </div>

                <div class="form-row">
                    <label>
                        <span>Pseudo <span style="color : red;">*</span></span>
                        <input type="text" name="pseudo" id="pseudo">
                        <p id="erreurPseudo" style="visibility : hidden;color: red;text-align: center;">Vous devez renseigner votre Pseudo</p>
                    </label>
                </div>

                <div class="form-row">
                    <label>
                        <span>Mot de passe <span style="color : red;">*</span> </span>
                        <input type="password" name="psw" id="psw">
                        <p id="erreurPsw" style="visibility : hidden;color: red;text-align: center;">Vous devez renseigner votre mot de passe</p>
                        <p id="erreurPswTaille" style="visibility : hidden;color: red;text-align: center;">la taille du mot de passe doit être de 5 au moins</p>
                    </label>
                </div>

                <div class="form-row">
                    <label class="form-checkbox">
                        <input type="checkbox" name="checkbox" checked>
                        <span>I agree to the <a href="http://localhost:8888/CMI/projet/src/condition_utilisation">terms and conditions</a></span>
                    </label>
                </div>

                <div class="form-row">
                    <button type="submit">Inscription</button>
                </div>

            </div>

            <a href="#" class="form-log-in-with-existing">Déjà membre ? Connectez vous ici &rarr;</a>

        </div>

        <div class="form-sign-in-with-social">

            <div class="form-row form-title-row">
                <span class="form-title">Sign in with</span>
            </div>

            <a href="#" class="form-google-button">Google</a>
            <a href="#" class="form-facebook-button">Facebook</a>

        </div>

    </form>

</div>

</body>

</html>
