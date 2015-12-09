<?php
	require_once('templates/header.php');
  $errors = '';
	if( filter_has_var( INPUT_POST, 'send' ) )
       {
       	$old = $_POST['user'];
       	$mdp = $_POST['mdp'];
       	$mdp2 = $_POST['mdp2'];
        $req = $bdd->prepare('SELECT * FROM users WHERE password = :password AND login = :login');
        $req->execute(array(
            'password' => hash('whirlpool', $old),
            'login' => $_GET['log']
          ));
        $res = $req->fetch();
        if($res)
        {
            if (strcmp($mdp, $mdp2) == 0)
            {
                $req = $bdd->prepare('UPDATE users SET password = :password WHERE login = :login');
                $req->execute(array(
                  'password' => hash('whirlpool', $mdp),
                  'login' => $_GET['log']
                  ));
                  $_SESSION['msg'] = "Mot de passe changee avec succes";
                   header('location: account.php');
            }
            else{
              $errors = 'Mot de passe non identique';
            }
        }
        else
        {
          $errors = 'Mauvais mot de passe';
        }
       }
?>

        <form id='connexion' class="connec" method="post" action="<?php echo( $_SERVER['REQUEST_URI'] ); ?>">  
            <p class="left"><label for="user">Ancien mot de passe</label><br><input class="inputtext" type="password" id="user" name="user"></p>
            <p class="left"><label for="mdp">Nouveau mot de passe</label><br><input class="inputtext" type="password" id="mdp" name="mdp"></p>
            <p class="left"><label for="mdp2">Nouveau mot de passe (verification)</label><br><input class="inputtext" type="password" id="mdp2" name="mdp2"></p>

            <p class="msg error"><?php echo $errors; ?></p>
            <input type="submit" class="inputsend btn btn-default" id="send" name="send">

        </form>
<?php
	require_once('templates/footer.php');
?>