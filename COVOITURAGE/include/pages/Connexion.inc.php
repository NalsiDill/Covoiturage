
<h1>Pour vous connecter</h1>
<?php
if(empty($_POST['login']) && empty($_POST['pwd']) && empty($_POST['somme'])){
?>
    <form name="connexion" id="connexion" action="index.php?page=11" method="post">
        Nom d'utilisateur :<br/>
        <input type="text" name="login" required/><br/>
        Mot de passe :<br/>
        <input type="password" name="pwd" required/><br/>
        <?php
        $n1 = rand(1,9);
        $n2 = rand(1,9);
        $n3 = rand(1,9);
        $somme = $n1 + $n2 + $n3;
        echo "<img src=\"image/nb/".$n1.".jpg\" />"
			. "+"
			."<img src=\"image/nb/".$n2.".jpg\" />"
			."+"
			."<img src=\"image/nb/".$n3.".jpg\" />";
        ?>
        <br/>
        <input type="hidden" name="somme" value="<?php echo $somme ?>">
        <input type="text" name="verifSomme"/><br/>
        <input type="submit" value="Valider" />
    </form>
<?php } 
if(!empty($_POST['login']) && !empty($_POST['pwd']) && !empty($_POST['somme'])){
    
    $db = new MyPdo();
    $pManager = new PersonneManager($db);
    $personnes = $pManager->getAllPersonnes();
    $existe = false;
        
    foreach($personnes as $personne){
        if($personne->getPer_login() == $_POST['login'] &&
           $personne->getPer_pwd() == $_POST['pwd']){
            $existe = true;
            break;
        }
    }
    if($_POST['somme'] == $_POST['verifSomme'] && $existe == true){
        $_SESSION['login_session'] = $_POST['login'];
		$_SESSION['num_pers'] = $personne->getPer_num();
	    header('location:index.php'); 
        echo "Vous êtes maintenant connecté sous le nom de ".$_POST['login']; 
?>
    
<?php
    } else {
?>
        <form name="connexion" id="connexion" action="index.php?page=11" method="post">
        Nom d'utilisateur :<br/>
        <input type="text" name="login" value="<?php echo $_POST['login'] ?>" required/><br/>
        Mot de passe :<br/>
        <input type="password" name="pwd" value="<?php echo $_POST['pwd'] ?>" required/><br/>
        <?php
        $n1 = rand(1,9);
        $n2 = rand(1,9);
        $n3 = rand(1,9);
        $somme = $n1 + $n2 + $n3;
        echo "<img src=\"image/nb/".$n1.".jpg\" />"
			. "+"
			."<img src=\"image/nb/".$n2.".jpg\" />"
			."+"
			."<img src=\"image/nb/".$n3.".jpg\" />";
        ?>
        <br/>
        <input type="hidden" name="somme" value="<?php echo $somme ?>">
        <input type="text" name="verifSomme"/><br/>
        <input type="submit" value="Valider" />
    </form>
    <p style="color:red">Utilisateur/mot de passe/somme incorrect</p>
<?php   
    } 
}?>
