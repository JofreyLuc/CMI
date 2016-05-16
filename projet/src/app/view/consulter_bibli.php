



<!-- Top 10 des livres, faire les cadres plus grands et les remplir -->
<section>
    <div id="titreT"> <h3>Bibliothèque personnelle </h3> </div>
    <div id="top10">
        <div style="border:black solid medium">
            <table border ="2">
                <tr>
                    <th>idBiblio</th>
                    <th>idUtilisateur</th>
                    <th>idLivre</th>
                    <th>numeroPage</th>
                    <th>dateModification</th>
                    <th>couv</th>

                </tr>
                <?php
                // CSS ne fonctionne pas
                foreach($biblio as $b) {
                    echo "<tr>
						<td>$b->idBiblio</td>
						<td>$b->idUtilisateur</td>
						<td>$b->idLivre</td>
						<td>$b->numeroPage</td>
						<td>$b->dateModification</td>
						<td rowspan=\"20\" bgcolor=\"#FFFFFF\">
     <img src=\"layout/Couverture_test.jpg\" width=\"200\" height=\"300\" style=\"float:left;margin-left:5%;\"/>
      </td> 

				</tr>

				";
                }?>
            </table>
        </div>
    </div>
</section>

idBiblio
idUtilisateur
idLivre
numeroPage
dateModification