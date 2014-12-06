<h1>Proposer un trajet</h1>

<?php
	$db = new MyPdo();
	$pManager = new ParcoursManager($db);
	$vManager = new VilleManager($db);
	$villesDepart = $pManager->getAllVillesDepart();
?>

<?php 
	if(empty($_POST['vil_depart']) && empty($_POST['vil_arrivee'])){
?>
<h2>Ville de départ</h2>
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
<h2>Ville d'arrivée</h2>

	   <form name="ajoutParcours" id="ajoutParcours" action="index.php?page=9" method="POST">
<table>
    <tr>  
        <td>Ville de départ<br><b><?php echo $ville->getVil_nom(); ?></b></td>              
		<td>Ville d'arrivée<br><select name="vil_arrivee" required>
			<option></option>
			<?php
				foreach ($villesArrivee as $ville){ 
					echo "<option value=\"".$ville->getVil_num()."\">".$ville->getVil_nom()."</option>\n";
				} ?>
		</select></td>
    </tr>  
    <tr>
        <td>Date de départ<br><input type="date" name="date" value="<?php echo date("d/m/Y"); ?>" pattern="[0-3][0-9]/[0-1][0-9]/20[1-9][0-9]" placeholder="jj/mm/aaaa" size="10" required/></td>
        <td>Heure de départ<br><input type="time" name="time" value="<?php echo date("H:i:s"); ?>" pattern="[0-2][0-9]:[0-5][0-9]:[0-5][0-9]" placeholder="hh:mm:ss" size="10" required/></td>
    </tr>
</table>       
        Nombre de places
        <br>
           <input type="text" name="places" value="0" size="1" required/> 
        <br><br>
           
		<input type="submit" value="Valider" />
	</form>

<?php
	} if (empty($_POST['vil_depart']) && !empty($_POST['vil_arrivee'])) {
        
        $proManager = new ProposeManager($db);
        
        $parcours = $pManager->getParcoursByVilles($_SESSION['vil_depart'], $_POST['vil_arrivee']);
        
        if($_SESSION['vil_depart'] == $parcours->getVil_num1()){
            $sens = 0;
        } else {
            $sens = 1;   
        }
        
        $propose = new Propose(array(
            "par_num" => $parcours->getPar_num(),
            "per_num" => $_SESSION['num_pers'],
            "pro_date" => getEnglishDate($_POST['date']),
            "pro_time" => $_POST['time'],
            "pro_place" => $_POST['places'],
            "pro_sens" => $sens
        ));
        $proManager->add($propose);
?>
    <img src="./image/valid.png" alt="Validé">
 Le trajet a été ajouté.
<?php   } ?>