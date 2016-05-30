



<img src="/CMI/projet/src/conf/img/user.jpg" height="150px" width="150px"/>
<?php
foreach($users as $u){
    echo '<p>Pseudo : '.$u->pseudo.'</p>';
    echo '<p>Mail : '. $u->email. '</p>';
    echo '<p>Nom : '. $u->nom. '</p>';
    echo '<p>Prenom : '. $u->prenom. '</p>';
    echo '<p>Date de naissance : '.$u->dateNaissance . '</p>';
    echo '<p>Sexe : '.$u->sexe . '</p>';

}
?>


