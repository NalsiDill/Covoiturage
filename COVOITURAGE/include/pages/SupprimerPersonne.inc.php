<?php
if (!empty($_GET["noPers"]))
{
	$noPers=$_GET["noPers"];
}else{
	$noPers=0;
}

if ($noPers == 0)
{
	?>
<h1>Supprimer des personnes enregistrées</h1>
<p>Pour effectuer une suppression, rendez-vous à la page listant les personnes.</p>
<?php 
} else {
	$db = new MyPdo();
	$pManager = new PersonneManager($db);
	$personnes = $pManager->getAllPersonnes();
	
	$personne = $pManager->getPersonneByID($noPers);

?>
<h1>Supprimer des personnes enregistrées</h1>
<p>Souhaitez-vous :
	<br><br>
</p>
	<form name="supprPersonne" id="supprPersonne" action="index.php?page=1" method="post">
		<input type="radio" name="validation" value="supprimer" required>Supprimer <?php echo $personne->getPer_prenom(); ?>  <?php echo $personne->getPer_nom(); ?> des registres ? <br/>
		<input type="radio" name="validation" value="annuler" checked required>Revenir à la page précédente<br/><br>
			<input type="submit" value="Valider" />
	</form>
<?php
}
?>