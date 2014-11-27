<h1>Liste des parcours</h1>

<?php
$db = new MyPdo();
$pManager = new ParcoursManager($db);
$parcourss = $pManager->getAllParcours();
$vManager = new VilleManager($db);
?>
<table border=1>
	<tr><th>Num&eacute;ro</th><th>Nom ville</th><th>Nom ville</th><th>Nombre de Km</th></tr>
	<?php
	foreach ($parcourss as $parcours){ ?>
		<tr>
			<td><?php echo $parcours->getPar_num(); ?></td>
			<td><?php echo $vManager->getVilleByID($parcours->getVil_num1())-> getVil_nom(); ?></td>
			<td><?php echo $vManager->getVilleByID($parcours->getVil_num2())-> getVil_nom(); ?></td>
			<td><?php echo $parcours->getPar_km(); ?></td>
		</tr>
		<?php
	} ?>
</table>
