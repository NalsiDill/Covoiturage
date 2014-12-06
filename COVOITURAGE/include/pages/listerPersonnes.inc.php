<?php
	$db = new MyPdo();
	$pManager = new PersonneManager($db);
	$personnes = $pManager->getAllPersonnes();
	if (empty($_GET['noPers'])){
?>
<h1>Liste des personnes</h1>
<table border=1>
	<tr><th>Nom</th><th>Prénom</th></tr>
	<?php
	foreach ($personnes as $personne){ ?>
		<tr>
			<td>
				<?php echo $personne->getPer_nom(); ?>
			</td>
			<td>
				<?php echo $personne->getPer_prenom(); ?>
			</td>
			<td>
				<a href="index.php?page=2&noPers=<?php echo $personne->getPer_num();?>" ><img src="./image/loupe.png"/> </a>
			</td> 
			<td>
				<a href="index.php?page=3&noPers=<?php echo $personne->getPer_num(); ?>"><img src="./image/modifier.png"/> </a>
			</td>
			<td>
				<a href="index.php?page=4&noPers=<?php echo $personne->getPer_num(); ?>"><img src="./image/erreur.png"/> </a>
			</td>
		</tr>
		<?php
	} ?>
</table>
<?php
	} else {
		$noPers = $_GET['noPers'];
		$estEtudiant = false;
		
		$eManager = new EtudiantManager($db);
		$listEtudiants = $eManager->getAllEtudiants();
		
		foreach($listEtudiants as $etudiant){
			if ($etudiant->getPer_num() == $noPers){
				$estEtudiant = true;
				break;
			}
		}
		
		
		
		if ($estEtudiant == true){	// La personne est un étudiant
			
			$etudiant = $eManager->getEtudiantByID($noPers);
			$personne = $pManager->getPersonneByID($noPers);
			$depManager = new DepartementManager($db);
			$departement = $depManager->getDepartementByID($etudiant->getDep_num());
			$vManager = new VilleManager($db);
			$ville = $vManager->getVilleByID($departement->getVil_num());
?>
<h1>Détail sur l'étudiant <?php echo $personne->getPer_nom()?></h1>

<table border=1>
	<tr><th>Prénom</th><th>Mail</th><th>Tel</th><th>Département</th><th>Ville</th></tr>
	<tr>
		<td><?php echo $personne->getPer_prenom()?></td>
		<td><?php echo $personne->getPer_mail()?></td>
		<td><?php echo $personne->getPer_tel()?></td>
		<td><?php echo $departement->getDep_nom()?></td>
		<td><?php echo $ville->getVil_nom()?></td>
	</tr>
</table>
<?php
		}
		if ($estEtudiant==false){  // La personne est un salarié
			
			$sManager = new SalarieManager($db);
			$salarie = $sManager->getSalarieByID($noPers);
			$personne = $pManager->getPersonneByID($noPers);
			$fManager = new FonctionManager($db);
			$fonction = $fManager->getFonctionByID($salarie->getFon_num());
?>
<h1>Détail sur le salarié <?php echo $personne->getPer_nom()?></h1>

<table border=1>
	<tr><th>Prénom</th><th>Mail</th><th>Tel</th><th>Tel pro</th><th>Fonction</th></tr>
	<tr>
		<td><?php echo $personne->getPer_prenom()?></td>
		<td><?php echo $personne->getPer_mail()?></td>
		<td><?php echo $personne->getPer_tel()?></td>
		<td><?php echo $salarie->getSal_telprof()?></td>
		<td><?php echo $fonction->getFon_libelle()?></td>
	</tr>
</table>
<?php
		}
	}
?>
