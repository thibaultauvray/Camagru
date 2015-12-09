<?php
	require_once('templates/header.php');
	function testpassword($mdp)	{ // $mdp le mot de passe passé en paramètre
 
// On récupère la longueur du mot de passe	
$longueur = strlen($mdp);
 $point = 0;
 $point_maj = 0;
 $point_chiffre = 0;
 $point_caracteres = 0;
// On fait une boucle pour lire chaque lettre
for($i = 0; $i < $longueur; $i++) 	{
 
	// On sélectionne une à une chaque lettre
	// $i étant à 0 lors du premier passage de la boucle
	$lettre = $mdp[$i];
 
	if ($lettre>='a' && $lettre<='z'){
		// On ajoute 1 point pour une minuscule
		$point = $point + 1;
 
		// On rajoute le bonus pour une minuscule
		$point_min = 1;
	}
	else if ($lettre>='A' && $lettre <='Z'){
		// On ajoute 2 points pour une majuscule
		$point = $point + 2;
 
		// On rajoute le bonus pour une majuscule
		$point_maj = 2;
	}
	else if ($lettre>='0' && $lettre<='9'){
		// On ajoute 3 points pour un chiffre
		$point = $point + 3;
 
		// On rajoute le bonus pour un chiffre
		$point_chiffre = 3;
	}
	else {
		// On ajoute 5 points pour un caractère autre
		$point = $point + 5;
 
		// On rajoute le bonus pour un caractère autre
		$point_caracteres = 5;
	}
}
 
// Calcul du coefficient points/longueur
$etape1 = $point / $longueur;
 
// Calcul du coefficient de la diversité des types de caractères...
$etape2 = $point_min + $point_maj + $point_chiffre + $point_caracteres;
 
// Multiplication du coefficient de diversité avec celui de la longueur
$resultat = $etape1 * $etape2;
 
// Multiplication du résultat par la longueur de la chaîne
$final = $resultat * $longueur;
 
return $final;
 
}
	function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
	$errors ='';
	$errors2 ='';
	$errors3 ='';
       if( filter_has_var( INPUT_POST, 'send' ) )
       {
            $errors ='';
            $pass_hache = hash('whirlpool', $_POST['mdp']);
            $req = $bdd->prepare('SELECT * FROM users WHERE login = ? AND password = ?');          
			$req->execute(array($_POST['user'], $pass_hache));
            $resultat=($req->fetch());
			if (!$resultat)
			{
			    $errors = 'Mauvais identifiant ou mot de passe !';
			}
			else
			{
				if ($resultat['actif'] == 1)
				{
				$_SESSION['login'] = $_POST['user']; 
				header('location: index.php');
				}
				else
				{
					$errors = 'Votre compte est inactif';
				}
			}
		}
		if( filter_has_var( INPUT_POST, 'lost' ) )
       {
       		$mail = $_POST['mail'];

       		$req = $bdd->prepare('SELECT * FROM users WHERE mail = ?');
       		$req->execute(array($mail));
       		$res = $req->fetch();
       		if ($res)
       		{
       			$newpasswd2 = generateRandomString();
       			$newpasswd = hash('whirlpool', $newpasswd2);
       			$req = $bdd->prepare('UPDATE users SET password = ? WHERE mail = ?');
       			$req->execute(array($newpasswd, $mail));
          	 	$destinataire = $_POST['mail'];
				$sujet = "Oublie de mot de passe" ;
				$entete = "From: camagru@camagru.com" ;
				 
				// Le lien d'activation est composé du login(log) et de la clé(cle)
				$message = 'Bienvenue sur VotreSite,
				 
				 Ton nouveaux mot de passe est '.$newpasswd2.'.
				Pour le changer, veuillez cliquer sur le lien ci dessous
				ou copier/coller dans votre navigateur internet.
				 
				https://camagru.local.42.fr:8443/new.php?log='.urlencode($res['login']).'
				 
				 
				---------------
				Ceci est un mail automatique, Merci de ne pas y répondre.';
				 
				 
				mail($destinataire, $sujet, $message, $entete) ; // Envoi du mail
				$errors3 = '';
			}
			else
			{
				$errors3 = 'Email non trouvé';
			}
		}
	if( filter_has_var( INPUT_POST, 'register' ) )
       {
            $errors2 ='';
            if (empty($_POST['passwd']) || strlen($_POST['passwd']) < 6 || empty($_POST['users']) || testpassword($_POST['passwd']) < 50)
            {
            	$errors2 = 'Login vide ou password vide ou trop court (6 minimum) ou trop faible (Une majuscule, un chiffre minimum)';
            	echo testpassword($_POST['passwd']);
            }
            else if (empty($_POST['mail']))
            {
            	$errors2 = 'Adresse mail vide';
            }
            else
            {
            $pass_hache = hash('whirlpool', $_POST['passwd']);
            $req = $bdd->prepare('SELECT id FROM users WHERE login = ?');          
			$req->execute(array($_POST['users']));
            $resultat=($req->fetch());
			if ($resultat)
			{
			    $errors2 = 'Login déjà pris';
			}
			else
			{
				$login = $_POST['users'];
				$cle = md5(microtime(TRUE)*100000);
			  	$req = $bdd->prepare('INSERT INTO users(login, mail, password, cle, actif) VALUES (:login, :mail, :password, :cle, :actif)');
				$req->execute(array(
					'login' => $_POST['users'],
					'password' => $pass_hache,
					'mail' => $_POST['mail'],
					'cle' => $cle,
					'actif' => 0
					));
				$destinataire = $_POST['mail'];
				$sujet = "Activer votre compte" ;
				$entete = "From: camagru@camagru.com" ;
				 
				// Le lien d'activation est composé du login(log) et de la clé(cle)
				$message = 'Bienvenue sur VotreSite,
				 
				Pour activer votre compte, veuillez cliquer sur le lien ci dessous
				ou copier/coller dans votre navigateur internet.
				 
				https://camagru.local.42.fr:8443/activation.php?log='.urlencode($login).'&cle='.urlencode($cle).'
				 
				 
				---------------
				Ceci est un mail automatique, Merci de ne pas y répondre.';
				 
				 
				mail($destinataire, $sujet, $message, $entete) ; // Envoi du mail
				 $errors2 = 'Compte crée, un email de confirmation vous a ete envoye';
			}
		}	
		}
?>
<?php
if (isset($_SESSION['msg']))
{
	echo $_SESSION['msg'];
} 
?>
<div class="con">
	<div class="register">
<h2>Connexion</h2>
<hr class="fancy"/>
      <div class="formulaire">
        <form id='connexion' class="connec" method="post" action="<?php echo( $_SERVER['REQUEST_URI'] ); ?>">  
            <p class="left"><label for="user">Nom d'utilisateur</label><br><input class="inputtext" type="text" id="user" name="user"></p>
            <p class="left"><label for="mdp">Mot de passe</label><br><input class="inputtext" type="password" id="mdp" name="mdp"></p>
            <p class="msg error"><?php echo $errors; ?></p>
            <input type="submit" class="inputsend btn btn-default" id="send" name="send">

        </form>
        </div>
        </div>
        <div class="register">
			<h2>S'enregistrer</h2>
			<hr class="fancy"/>
			<div class="formulaire">
        <form id='connexion' class="connec" method="post" action="<?php echo( $_SERVER['REQUEST_URI'] ); ?>">  
            <p class="left"><label for="users">Nom d'utilisateur</label><br><input class="inputtext" type="text" id="users" name="users"></p>
           	<p class="left"><label for="mail">Adresse mail</label><br><input class="inputtext" type="mail" id="mail" name="mail"></p>
            <p class="left"><label for="mdp">Mot de passe</label><br><input class="inputtext" type="password" id="passwd" name="passwd"></p>
            <p class="msg error"><?php echo $errors2; ?> </p>
            <input type="submit" class="inputsend btn btn-default" id="register" name="register">

        </form>
        </div>
		</div>
		<form id='connexion' class="connec" method="post" action="<?php echo( $_SERVER['REQUEST_URI'] ); ?>">
			            <p class="msg error"><?php echo $errors3; ?></p>

					<input type="text" name="mail" value="Votre adresse mail">
		            <input type="submit" class="inputsend btn btn-default" id="register" name="lost" value="Lost your password ?">
 
		</form> 
 </p>
</div>
<?php
	require_once('templates/footer.php');
?>

</body>
</html>
