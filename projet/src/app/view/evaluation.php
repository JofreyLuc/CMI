

<!-- Top 10 des livres, faire les cadres plus grands et les remplir -->
<section>
    <div id="titreT"> <h3> Evaluations </h3> </div>
    <div id="top10">
        <div style="border:black solid medium">
            <table border ="2">
                <tr>
                    <th>idEvaluation</th>
                    <th>idUtilisateur</th>
                    <th>idLivre</th>
                    <th>note</th>
                    <th>commentaire</th>
                    <th>dateModification</th>
                </tr>
                <?php
                // CSS ne fonctionne pas
                foreach($evaluations as $e) {
                    echo "<tr>
						<td>$e->idEvaluation</td>
						<td>$e->idUtilisateur</td>
						<td>$e->idLivre</td>
						<td>$e->note</td>
						<td>$e->commentaire</td>
						<td>$e->dateModification</td>
				</tr>

				";
                }?>
            </table>
        </div>
    </div>
</section>


