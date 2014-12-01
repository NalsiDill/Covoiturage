<h1>Rechercher un trajet</h1>
<?php
$db = new MyPdo();
$proManager = new ProposeManager($db);
/*$trajetsProposes = $proManager->getAllProposes();*/
$pManager = new ParcoursManager($db);
$vManager = new VilleManager($db);
$villesDepart = $proManager->getVillesBySens();
?>
<!--<table border=1>
	<tr><th>Num&eacute;ro</th><th>Parcours correspondant</th><th>Date</th><th>Heure</th><th>Places</th></tr>
	<?php /*
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
*/	?>
</table>-->

<?php 
	if(empty($_POST['vil_depart']) && empty($_POST['vil_arrivee'])){
?>
Ville de départ : 
 <form name="ajoutParcours" id="ajoutParcours" action="index.php?page=9" method="POST">
		<select name="vil_depart" required>
			<option></option>
			<?php
				foreach ($villesDepart as $ville){ 
					echo "<option value=\"".$ville->getVil_num()."\">".$ville->getVil_nom()."</option>\n";
				} ?>
		</select>
		<input type="submit" value="Valider" />
	</form>

<?php
	} if (!empty($_POST['vil_depart']) && empty($_POST['vil_arrivee'])) {
        $_SESSION['vil_depart'] = $_POST['vil_depart'];
        
        $ville = $vManager->getVilleByID($_POST['vil_depart']);
        
	$villesArrivee = $pManager->getAllVillesArrivée($_POST['vil_depart']);
?>

     <form name="ajoutParcours" id="ajoutParcours" action="index.php?page=9" method="POST">
           
        Ville de départ : <b><?php echo $ville->getVil_nom(); ?></b><br/>              
		Ville d'arrivée : <select name="vil_arrivee" required>
			<option></option>
			<?php
				foreach ($villesArrivee as $ville){ 
					echo "<option value=\"".$ville->getVil_num()."\">".$ville->getVil_nom()."</option>\n";
				} ?>
		</select> <br/>
           
        Date de départ : <input type="date" name="date" value="<?php echo date("d/m/Y"); ?>" pattern="[0-3][0-9]/[0-1][0-9]/20[1-9][0-9]" size="8" required/>
           
		<input type="submit" value="Valider" />
	</form>


<?php } ?>