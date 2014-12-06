<h1>Rechercher un trajet</h1>
<?php
$db = new MyPdo();
$proManager = new ProposeManager($db);
$pManager = new ParcoursManager($db);
$vManager = new VilleManager($db);
?>

<?php 
	if(empty($_POST['vil_depart']) && empty($_POST['vil_arrivee'])){
        $villesDepart = $proManager->getVillesBySens();
?>
Ville de départ : 
 <form name="rechercheParcours1" id="rechercheParcours1" action="index.php?page=10" method="POST">
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

     <form name="rechercheParcours2" id="rechercheParcours2" action="index.php?page=10" method="POST">
           
        Ville de départ : <b><?php echo $ville->getVil_nom(); ?></b><br>              
		Ville d'arrivée : <select name="vil_arrivee" required>
			<option></option>
			<?php
				foreach ($villesArrivee as $ville){ 
					echo "<option value=\"".$ville->getVil_num()."\">".$ville->getVil_nom()."</option>\n";
				} ?>
		</select> <br>
           
        Date de départ : <input type="date" name="date" value="<?php echo date("d/m/Y"); ?>" pattern="[0-3][0-9]/[0-1][0-9]/20[1-9][0-9]" size="8" required/>
        Précision : 
        <select name="precision" required>
            <option value="0">Ce jour</option>
            <option value="1">+/- 1 jour</option>
            <option value="2">+/- 2 jours</option>
            <option value="3">+/- 3 jours</option>
        </select>
        <br>
         A partir de :
         <select name="apartirde" required>
            <?php
            for($i = 0; $i < 24; $i++){
                if ($i < 10){
                    echo "<option value=\"".$i."\">0".$i."h</option>\n";  
                } else {
                    echo "<option value=\"".$i."\">".$i."h</option>\n";  
                }
            }
            ?>
        </select>
        <br>
		<input type="submit" value="Valider" />
	</form>
<?php
        
        
        
        
} if (empty($_POST['vil_depart']) && !empty($_POST['vil_arrivee'])) {
        $parcoursAssocie = $pManager->getParcoursByVilles($_SESSION['vil_depart'], $_POST['vil_arrivee']);
        $par_num = $parcoursAssocie->getPar_num();
        
        $dateAvant = removeJours($_POST['date'], $_POST['precision']);
        $dateApres = addJours($_POST['date'], $_POST['precision']);
        
        $heure = $_POST['apartirde'];
        $heure = $heure.':00:00';
        
        if($_SESSION['vil_depart'] == $parcoursAssocie->getVil_num1()){
            $sens = 0;
        } else {
            $sens = 1;   
        }
        
        $listeTrajets = $proManager->getTrajetsByRecherche($par_num, $dateAvant, $dateApres, $heure, $sens);
        
    if(count($listeTrajets) == 0){
              ?>
        <img src="./image/erreur.png" alt="Pas Validé">
         Désolé, pas de trajet disponible !
    <?php
    } else {
    $perManager = new PersonneManager($db);
?>
    <table border=1>
	<tr><th>Ville de départ</th><th>Ville arrivée</th><th>Date départ</th><th>Heure départ</th><th>Nombres de place(s)</th><th>Nom du covoitureur</th></tr>
	<?php 
	foreach ($listeTrajets as $trajet){
		$pers = $perManager->getPersonneByID($trajet->getPer_num());
        $vil1 = $vManager->getVilleByID($_SESSION['vil_depart']);
        $vil2 = $vManager->getVilleByID($_POST['vil_arrivee']); 
	?>
		<tr>
			<td><?php echo $vil1->getVil_nom(); ?></td>
            <td><?php echo $vil2->getVil_nom(); ?></td>
            <td><?php echo $trajet->getPro_date(); ?></td>
            <td><?php echo $trajet->getPro_time(); ?></td>
            <td><?php echo $trajet->getPro_place(); ?></td>
            <td><?php echo $pers->getPer_nom(); ?></td>
        </tr>
        <?php } ?>
    </table>
<?php
    }
}
?>