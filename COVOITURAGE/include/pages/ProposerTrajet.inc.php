<h1>Proposer un trajet</h1>

<?php
	$db = new MyPdo();
	$pManager = new ParcoursManager($db);
	$vManager = new VilleManager($db);
	$villesDepart = $pManager->getAllVilles1();
?>

<?php 
	if(empty($_POST['vil_depart'])){
?>
<h2>Ville de départ</h2>
	   <form name="ajoutParcours" id="ajoutParcours" action="index.php?page=9" method="POST">
		<select name="vil_depart">
			<option value="0">...</option>
			<?php
				foreach ($villesDepart as $ville){ 
					echo "<option value=\"".$ville->getVil_num()."\">".$ville->getVil_nom()."</option>\n";
				} ?>
		</select>
		<input type="submit" value="Valider" />
	</form>



<?php
	}else{
		
	$villesArrive = $pManager->getAllVilles2($_POST['vil_depart']);
?>
<h2>Ville d'arrivée</h2>
	   <form name="ajoutParcours" id="ajoutParcours" action="index.php?page=9" method="POST">
		<select name="vil_arrivee" required>
			<option value="0">...</option>
			<?php
				foreach ($villesDepart as $ville){ 
					echo "<option value=\"".$ville->getVil_num()."\">".$ville->getVil_nom()."</option>\n";
				} ?>
		</select>
		<input type="submit" value="Valider" />
	</form>

<?php
	}
?>