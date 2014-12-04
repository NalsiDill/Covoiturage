    <h1>Modifier une personne</h1>

<?php
	$db = new MyPdo();
	$pManager = new PersonneManager($db);
if(empty($_POST['nom']) &&				// Premier accès à la page
   empty($_POST['prenom']) &&
   empty($_POST['telephone']) &&
   empty($_POST['mail']))
  {
	if (empty($_POST["noPers"]))
	{
		
	$personnes = $pManager->getAllPersonnes();
		
?>
<form name="supprPers" id="supprPers" action="index.php?page=3" method="POST">

	Modifier :
		<select name="noPers">
			<option value="0">...</option>
			<?php
				foreach ($personnes as $personne){ 
					echo "<option value=\"".$personne->getPer_num()."\">".$personne->getPer_nom()."</option>\n";
				} ?>
		</select>
	<br/>
	<input type="submit" value="Valider" />
</form>
<?php
	}else{
		$personne = $pManager->getPersonneByID($_POST["noPers"]);
?>
</p>
  Modifier les détails du compte "<?php echo $personne->getPer_login(); ?>"
</p>
	<form name="modifierPersonne" id="modifierPersonne" action="index.php?page=3" method="post">
		<?php $_SESSION['per_num'] = $_POST['noPers'] ?>
		Nom : <input type="text" name="nom" value="<?php echo $personne->getPer_nom() ?>" required/><br/>
		Prenom : <input type="text" name="prenom" value="<?php echo $personne->getPer_prenom() ?>" required/><br/>
		Téléphone : <input type="text" name="telephone" value="<?php echo $personne->getPer_tel() ?>" required/><br/>
		Mail : <input type="text" name="mail" value="<?php echo $personne->getPer_mail() ?>" required/><br/>
			<input type="submit" value="Valider" />
	</form>
<?php
	}
}
else
{
	// formulaire de modification bien rempli

	$personne = new Personne(array(
		"per_num" => $_SESSION['per_num'],
		"per_nom" => $_POST['nom'],
		"per_prenom" => $_POST['prenom'],
		"per_tel" => $_POST['telephone'],
		"per_mail" => $_POST['mail']
	));
	$pManager->update($personne);
?>


<?php
}
?>