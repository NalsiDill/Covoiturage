<h1>Supprimer une personne</h1>
<?php
$db = new MyPdo();
$pManager = new PersonneManager($db);
if (empty($_GET["noPers"]) && empty($_POST["noPers"])){

$personnes = $pManager->getAllPersonnes();
		
?>
<form name="supprPers" id="supprPers" action="index.php?page=4" method="POST">

	Supprimer :
		<select name="noPers">
			<option value="0">...</option>
			<?php
				foreach ($personnes as $personne){ 
					echo "<option value=\"".$personne->getPer_num()."\">".$personne->getPer_nom()."</option>\n";
				} ?>
		</select>
	<br>
	<input type="submit" value="Valider" />
</form>
<?php
} else if (empty($_GET["noPers"]) && !empty($_POST["noPers"])){
		$personne = $pManager->getPersonneByID($_POST["noPers"]);
?>
</p>
 <img src="./image/valid.png" alt="Validé">
  <?php echo $personne->getPer_prenom(); ?>  <?php echo $personne->getPer_nom(); ?> a été supprimé des registres
</p>
<?php
		$pManager->delPersonneByID($_POST["noPers"]);
}
if(!empty($_GET["noPers"])) {
    
    $personne = $pManager->getPersonneByID($_GET["noPers"]);
?>
</p>
 <img src="./image/valid.png" alt="Validé">
  <?php echo $personne->getPer_prenom(); ?>  <?php echo $personne->getPer_nom(); ?> a été supprimé des registres
</p>
<?php
		$pManager->delPersonneByID($_GET["noPers"]);
}
?>