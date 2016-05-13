

<!-- Top 10 des livres, faire les cadres plus grands et les remplir -->
<section>
	<div id="titreT"> <h3> Top 10 </h3> </div>
	<div id="top10">
		<div style="border:black solid medium">
			<table border ="2">
				<tr>
					<th>titre</th>
					<th>auteur</th>
					<th>langue</th>
					<th>genre</th>
					<th>date parution</th>
					<th>resume</th>
					<th>id</th>
					<th>nbpages</th>
					<th>note</th>
					<th>lienEpub</th>
					<th>lienCouv</th>
				</tr>
			<?php
			// CSS ne fonctionne pas
			foreach($livres as $livre) {
				echo "<tr>
						<td>$livre->titre</td>
						<td>$livre->auteur</td>
						<td>$livre->langue</td>
						<td>$livre->dateParution</td>
						<td>$livre->resume</td>
						<td>$livre->idLivre</td>
						<td>$livre->nombrePages</td>
						<td>$livre->noteMoyenne</td>
						<td>$livre->lienEpub</td>
						<td>$livre->lienCouv</td>
				</tr>

				";
			}?>
				</table>
		</div>
	</div>
</section>


