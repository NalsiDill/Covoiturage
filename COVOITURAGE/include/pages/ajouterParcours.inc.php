<h1>Ajouter un parcours</h1>

<?php
$db = new MyPdo();


if(empty($_POST['vil_num1']) || empty($_POST['vil_num2']) || empty($_POST['nb_km']) || $_POST['vil_num1'] === $_POST['vil_num2']){
	
	$vManager = new VilleManager($db);
	$villes = $vManager->getAllVilles();
?>
	<form name="ajoutParcours" id="ajoutParcours" action="index.php?page=5" method="POST">
	Ville 1 :
		<select name="vil_num1">
			<option value="0">...</option>
			<?php
				foreach ($villes as $ville){ 
					echo "<option value=\"".$ville->getVil_num()."\">".$ville->getVil_nom()."</option>\n";
				} ?>
		</select>
	Ville 2 :
		<select name="vil_num2">
			<option value="0">...</option>
			<?php
				foreach ($villes as $ville){ 
					echo "<option value=\"".$ville->getVil_num()."\">".$ville->getVil_nom()."</option>\n";
				} ?>
		</select>
	Nombre de kilomètre(s) :
		<input type="text" size='20' name="nb_km" />
		
		<input type="submit" value="Valider" />
	</form>
	
<?php
}
else{
	$pManager = new ParcoursManager($db);
	$parcours = new Parcours(array(
		"par_km" => $_POST['nb_km'],
		"vil_num1" => $_POST['vil_num1'],
		"vil_num2" => $_POST['vil_num2']
	));
	$pManager->add($parcours);
	?>
	<img src="./image/valid.png" alt="Validé">
	 Le parcours a été ajouté.
<?php
}
?>