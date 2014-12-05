<?php
	$db = new MyPdo();
	$pManager = new PersonneManager($db);

		$personne = $pManager->getPersonneByID($_GET["noPers"]);
?>
</p>
  <?php echo $personne->getPer_prenom(); ?>  <?php echo $personne->getPer_nom(); ?> a été supprimé des registres
</p>
<?php
		$pManager->delPersonneByID($_GET["noPers"]);
?>