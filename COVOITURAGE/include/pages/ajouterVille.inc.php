<h1>Ajouter une ville</h1>

<?php
if(empty($_POST['vil_nom'])){
?>
	<form name="ajoutVille" id="ajoutVille" action="index.php?page=7" method="POST">
	Nom :
		<input type="text" size='20' name="vil_nom" />
		<input type="submit" value="Valider" />
	</form>
	
<?php
}
if(!empty($_POST['vil_nom'])){
	$db = new MyPdo();
	$vManager = new VilleManager($db);
	$ville = new Ville(array(
		"vil_nom" => $_POST['vil_nom']
	));
	$vManager->add($ville);
	?>
	<img src="./image/valid.png" alt="Validé">
	 La ville <?php echo$_POST['vil_nom']?> a été ajoutée
<?php
}
?>