<h1>Liste des villes</h1>

<?php
$db = new MyPdo();
$vManager = new VilleManager($db);
$villes = $vManager->getAllVilles();
?>
<table border=1>
	<tr><th>Num&eacute;ro</th><th>Nom</th></tr>
	<?php
	foreach ($villes as $ville){ ?>
		<tr>
			<td><?php echo $ville->getVil_num(); ?></td>
			<td><?php echo $ville->getVil_nom(); ?></td>
		</tr>
		<?php
	} ?>
</table>