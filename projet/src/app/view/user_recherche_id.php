
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="fac.js"></script>



<section>
    <div id="titreT"> <h3> requete sur users </h3> </div>
    <div id="top10">
        <div style="border:black solid medium">
            <table border ="2">
                <tr>
                    <th>idUtilisateur</th>
                    <th>email</th>
                    <th>password</th>
                    <th>fb</th>
                    <th>g+</th>
                    <th>pseudo</th>
                    <th>nom</th>
                    <th>prenom</th>
                    <th>date</th>
                    <th>sexe</th>
                    <th>possibiliteSuivi</th>
                </tr>
                <?php
                // on recupère du json , faut donc le décoder
                $users = json_decode($users);
                /*echo $count;
                echo $page;
                echo $parPage;
                echo $total;*/

                

                foreach($users as $user) {
                    echo "<tr>
						<th>$user->idUtilisateur</th>
						<th>$user->email</th>
						<th>$user->password</th>
						<th>$user->facebookId</th>
						<th>$user->googleId</th>
						<th>$user->pseudo</th>
						<th>$user->nom</th>
						<th>$user->prenom</th>
						<th>$user->dateNaissance</th>
						<th>$user->sexe</th>
						<th>$user->possibiliteSuivi</th>
				</tr>

				";
                }
                ?>
            </table>
        </div>
    </div>
</section>
