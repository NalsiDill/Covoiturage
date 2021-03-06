<h1>Ajouter un parcours</h1>

<?php
$db = new MyPdo();


if(empty($_POST['vil_num1']) || empty($_POST['vil_num2']) || empty($_POST['nb_km'])){
	
	$vManager = new VilleManager($db);
	$villes = $vManager->getAllVilles();
?>
	<form name="ajoutParcours" id="ajoutParcours" action="index.php?page=5" method="POST">
        <table>
            <tr>
	           <td>Ville 1
                   <br>
                   <select name="vil_num1" required>
			<option></option>
			<?php
				foreach ($villes as $ville){ 
					echo "<option value=\"".$ville->getVil_num()."\">".$ville->getVil_nom()."</option>\n";
				} ?>
		</select>
               </td>
                
                <td>Ville 2
                    <br>
                    <select name="vil_num2" required>
                <option></option>
                <?php
                    foreach ($villes as $ville){ 
                        echo "<option value=\"".$ville->getVil_num()."\">".$ville->getVil_nom()."</option>\n";
                    } ?>
            </select>
                    </td>
            </tr>
        </table>
	Nombre de kilomètre(s)
        <br>
		<input type="text" size='3' name="nb_km" required/>
        <br>
        <br>
		<input type="submit" value="Valider" />
	</form>
	
<?php
}
else{
	$pManager = new ParcoursManager($db);
    
    $parcoursVerif = $pManager->getParcoursByVilles($_POST['vil_num2'], $_POST['vil_num1']);
    if ($_POST['vil_num1'] === $_POST['vil_num2']){
         ?>
        <img src="./image/erreur.png" alt="Pas Validé">
         Impossible de faire un parcours avec les mêmes villes !
    <?php
    } else if ($parcoursVerif->getPar_num() != null){
        ?>
        <img src="./image/erreur.png" alt="Pas Validé">
         Ce parcours existe déjà !
    <?php
    } else {
    
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
}
?>