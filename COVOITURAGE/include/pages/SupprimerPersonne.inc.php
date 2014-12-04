<?php
	$db = new MyPdo();
	$pManager = new PersonneManager($db);
	if (empty($_POST["noPers"]))
{
		
	$personnes = $pManager->getAllPersonnes();
		
?>
	<h1>Supprimer des personnes enregistrées</h1>
<form name="supprPers" id="supprPers" action="index.php?page=4" method="POST">

	Supprimer :
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
  <?php echo $personne->getPer_prenom(); ?>  <?php echo $personne->getPer_nom(); ?> a été supprimé des registres
</p>
<?php
		$pManager->delPersonneByID($_POST["noPers"]);
}
?>