<?php
$db = new MyPdo();

if(empty($_POST['nom']) &&				// Premier accès à la page
   empty($_POST['prenom']) &&
   empty($_POST['telephone']) &&
   empty($_POST['mail']) &&
   empty($_POST['login']) &&
   empty($_POST['pwd']) &&
   empty($_POST['categorie']) &&
   empty($_POST['annee']) &&    
   empty($_POST['departement']) &&
   empty($_POST['tel']) &&
   empty($_POST['fonction'])
  ){
?>
    <h1>Ajouter une personne</h1>

	<form name="ajoutPersonne1" id="ajoutPersonne1" action="index.php?page=1" method="post">
		<table>
			<tr>
				<td>Nom<br><input type="text" name="nom" required/></td>
				<td>Prenom<br><input type="text" name="prenom" required/></td>
			</tr>
			<tr>
				<td>Téléphone<br><input type="text" name="telephone" required/></td>
				<td>Mail<br><input type="text" name="mail" required/></td>
			</tr>
			<tr>
				<td>Login<br><input type="text" name="login" required/></td>
				<td>Mot de passe<br><input type="password" name="pwd" required/></td>
			</tr>
		</table>
		Catégorie<br><input type="radio" name="categorie" value="etudiant" required>Etudiant 
					<input type="radio" name="categorie" value="personnel" required>Personnel<br>
		<br>
		<br>
		<input type="submit" value="Valider" />
	</form>
<?php
   }
if(!empty($_POST['nom']) &&
   !empty($_POST['prenom']) &&
   !empty($_POST['telephone']) &&
   !empty($_POST['mail']) &&
   !empty($_POST['login']) &&
   !empty($_POST['pwd']) &&
   !empty($_POST['categorie'])
  ){	               // formulaire renseigné
    $_SESSION['nom'] = $_POST['nom'];
    $_SESSION['prenom'] = $_POST['prenom'];
    $_SESSION['telephone'] = $_POST['telephone'];
    $_SESSION['mail'] = $_POST['mail'];
    $_SESSION['login'] = $_POST['login'];
    $_SESSION['pwd'] = $_POST['pwd'];
    
    
		if ($_POST['categorie'] == "etudiant")
		{		// par un étudiant

    $divManager = new DivisionManager($db);
    $annees = $divManager->getAllDivisions();      
    $depManager = new DepartementManager($db);
    $departements = $depManager->getAllDepartements();
?>
    <h1>Ajouter un étudiant</h1>
	<form name="ajoutEtudiant" id="ajoutEtudiant" action="index.php?page=1" method="POST">
        Année : 
		<select name="annee" required>
			<option></option>
			<?php
				foreach ($annees as $annee){
                    echo "<option value=\"".$annee->getDiv_num()."\">".$annee->getDiv_nom()."</option>\n";
				} ?>
		</select>
        <br>
        Département : 
        <select name="departement" required>
			<option></option>
			<?php
				foreach ($departements as $departement){
                    echo "<option value=\"".$departement->getDep_num()."\">".$departement->getDep_nom()."</option>\n";
				} ?>
		</select>
        <br>
        <input type="submit" value="Valider" />
	</form>
<?php 	}
	
		if ($_POST['categorie'] == "personnel")// par un salarié
		{
    $fonManager = new FonctionManager($db);
    $fonctions = $fonManager->getAllFonctions();
?>
    <h1>Ajouter un salarié</h1>
<form name="ajoutSalarie" id="ajoutSalarie" action="index.php?page=1" method="POST">
    <table>
		<tr>
			<td>Téléphone professionnel<br>
		<input type="text" name="tel" required/></td>
		</tr>
		<tr>
			<td>Fonction<br>
        <select name="fonction" required>
			<option></option>
			<?php
				foreach ($fonctions as $fonction){
                    echo "<option value=\"".$fonction->getFon_num()."\">".$fonction->getFon_libelle()."</option>\n";
				} ?>
		</select></td>
		</tr>
	</table>    
	
        <br>
        <br>
        <input type="submit" value="Valider" />
	</form>	

<?php   }
	}

if((empty($_POST['nom']) ||
   empty($_POST['prenom']) ||
   empty($_POST['telephone']) ||
   empty($_POST['mail']) ||
   empty($_POST['login']) ||
   empty($_POST['pwd']) ||
   empty($_POST['categorie'])) && 
  !empty($_POST['annee']) &&
  !empty($_POST['departement'])){
    $pManager = new PersonneManager($db);
    $personne = new Personne(array(
        "per_nom" => $_SESSION['nom'],
        "per_prenom" => $_SESSION['prenom'],
        "per_tel" => $_SESSION['telephone'],
        "per_mail" => $_SESSION['mail'],
        "per_login" => $_SESSION['login'],
        "per_pwd" => $_SESSION['pwd']
    ));
    $pManager->add($personne);
    $personneParNom = $pManager->getIDByPersonne($_SESSION['nom'],
        $_SESSION['prenom'], $_SESSION['login']);
    $num=$personneParNom->getPer_num();
    $eManager = new EtudiantManager($db);
    $etudiant = new Etudiant(array(
        "per_num" => $num,
        "dep_num" => $_POST['departement'],
        "div_num" => $_POST['annee']
    ));
    $eManager->add($etudiant);

?>
    <h1>Ajouter un étudiant</h1>
    <img src="./image/valid.png" alt="Validé">
 L'étudiant a été ajouté.
<?php   }
	
if((empty($_POST['nom']) ||
   empty($_POST['prenom']) ||
   empty($_POST['telephone']) ||
   empty($_POST['mail']) ||
   empty($_POST['login']) ||
   empty($_POST['pwd']) ||
   empty($_POST['categorie'])) && 
  !empty($_POST['tel']) &&
  !empty($_POST['fonction'])){
    $pManager = new PersonneManager($db);
    $personne = new Personne(array(
        "per_nom" => $_SESSION['nom'],
        "per_prenom" => $_SESSION['prenom'],
        "per_tel" => $_SESSION['telephone'],
        "per_mail" => $_SESSION['mail'],
        "per_login" => $_SESSION['login'],
        "per_pwd" => $_SESSION['pwd']
    ));
    $pManager->add($personne);
    $personneParNom = $pManager->getIDByPersonne($_SESSION['nom'],
        $_SESSION['prenom'], $_SESSION['login']);
    $num=$personneParNom->getPer_num();
    $sManager = new SalarieManager($db);
    $salarie = new Salarie(array(
        "per_num" => $num,
        "sal_telprof" => $_POST['tel'],
        "fon_num" => $_POST['fonction']
    ));
    $sManager->add($salarie);

?>
    <h1>Ajouter un salarié</h1>
    <img src="./image/valid.png" alt="Validé">
 Le salarié a été ajouté.
<?php   } ?>