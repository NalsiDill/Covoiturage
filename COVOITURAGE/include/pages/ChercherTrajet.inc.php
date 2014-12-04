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
 <form name="rechercheParcours1" id="rechercheParcours1" action="index.php?page=10" method="POST">
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

     <form name="rechercheParcours2" id="rechercheParcours2" action="index.php?page=10" method="POST">
           
        Ville de départ : <b><?php echo $ville->getVil_nom(); ?></b><br/>              
		Ville d'arrivée : <select name="vil_arrivee" required>
			<option></option>
			<?php
				foreach ($villesArrivee as $ville){ 
					echo "<option value=\"".$ville->getVil_num()."\">".$ville->getVil_nom()."</option>\n";
				} ?>
		</select> <br/>
           
        Date de départ : <input type="date" name="date" value="<?php echo date("d/m/Y"); ?>" pattern="[0-3][0-9]/[0-1][0-9]/20[1-9][0-9]" size="8" required/>
        Précision : 
        <select name="precision" required>
            <option value="0">Ce jour</option>
            <option value="1">+/- 1 jour</option>
            <option value="2">+/- 2 jours</option>
            <option value="3">+/- 3 jours</option>
        </select>
        <br/>
         A partir de :
         <select name="apartirde" required>
            <?php
            for($i = 0; $i < 24; $i++){
                if ($i < 10){
                    echo "<option value=\"".$i."\">0".$i."h</option>\n";  
                } else {
                    echo "<option value=\"".$i."\">".$i."h</option>\n";  
                }
            }
            ?>
        </select>
        <br/>
		<input type="submit" value="Valider" />
	</form>
<?php
} if (!empty($_POST['vil_depart']) && !empty($_POST['vil_arrivee'])) {
?>
    
<?php } ?>