<h1>Rechercher un trajet</h1>
<?php
$db = new MyPdo();
$proManager = new ProposeManager($db);
$trajetsProposes = $proManager->getAllProposes();
$pManager = new ParcoursManager($db);
$vManager = new VilleManager($db);
?>
<table border=1>
	<tr><th>Num&eacute;ro</th><th>Parcours correspondant</th><th>Date</th><th>Heure</th><th>Places</th></tr>
	<?php
	foreach ($trajetsProposes as $trajetPropose){
		$parcourss = $pManager->getParcoursById($trajetPropose->getPer_num());
	?>
		<tr>
			<td><?php echo $trajetPropose->getPar_num(); ?></td>
			<td><?php 
		if($trajetPropose->getPro_sens() == 0){
			echo 
		$vManager->getVilleByID($parcourss->getVil_num1())->getVil_nom(); ?> vers <?php echo 
		$vManager->getVilleByID($parcourss->getVil_num2())->getVil_nom();
		}else{
        
			echo $vManager->getVilleByID($parcourss->getVil_num2())->getVil_nom(); ?> vers <?php echo $vManager->getVilleByID($parcourss->getVil_num1())->getVil_nom();
		}
			
				?></td>
			<td><?php echo $trajetPropose->getPro_date(); ?></td>
			<td><?php echo $trajetPropose->getPro_time(); ?></td>
			<td><?php echo $trajetPropose->getPro_place(); ?></td>
		</tr>
		<?php
	}
	?>
</table>