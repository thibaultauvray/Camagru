<?php
	require_once('templates/header.php');
			
	if (isset($_GET['id']))
	{
	
	$id = $_GET['id'];
	if (isset($_GET['up']) && $_GET['up'] == 1)
	{
		if (isset($_SESSION['login']))
		{
		$req = $bdd->prepare('SELECT * FROM vote WHERE id_image = :id_image AND id_users = :id_user AND vote = :vote');
		$req->execute(array(
			'id_image' => $id,
			'id_user' => $id_users,
			'vote' => 1
			));
		$resultats = $req->fetch();
		if (!$resultats)
		{
			$req = $bdd->prepare("SELECT * FROM vote WHERE id_image = :id_image AND id_users = :id_user AND vote = :vote");
			$req->execute(array(
			'id_image' => $id,
			'id_user' => $id_users,
			'vote' => -1
			));
			$resultats = $req->fetch();
			if (!$resultats)
			{
					$req = $bdd->prepare('INSERT INTO vote(id_users, id_image, vote) VALUES (:id_users, :id_image, :vote)');
					$req->execute(array(
						'id_users' => $id_users,
						'id_image' => $_GET['id'],
						'vote' => 1
					));
			}
			else
			{
				$req = $bdd->prepare('UPDATE vote SET  vote = :vote WHERE id_users = :id_users AND id_image = :id_image');
				$req->execute(array(
					'vote' => 1,
					'id_users' => $id_users,
					'id_image' => $id
					));
			}	
		}   
		else
		{
			echo "Already voted";
		}    
		}
		else{
			echo 'Vous n\'etes pas connecte';
		}                      
	}

	if (isset($_GET['down']) && $_GET['down'] == -1 && isset($_SESSION['login']))
	{
		if(isset($_SESSION['login']))
		{
		$req = $bdd->prepare('SELECT * FROM vote WHERE id_image = :id_image AND id_users = :id_user AND vote = :vote');
		$req->execute(array(
			'id_image' => $id,
			'id_user' => $id_users,
			'vote' => -1
			));
		$resultats = $req->fetch();
		if (!$resultats)
		{
			$req = $bdd->prepare("SELECT * FROM vote WHERE id_image = :id_image AND id_users = :id_user AND vote = :vote");
			$req->execute(array(
			'id_image' => $id,
			'id_user' => $id_users,
			'vote' => 1
			));
			$resultats = $req->fetch();
			if (!$resultats)
			{
					$req = $bdd->prepare('INSERT INTO vote(id_users, id_image, vote) VALUES (:id_users, :id_image, :vote)');
					$req->execute(array(
						'id_users' => $id_users,
						'id_image' => $_GET['id'],
						'vote' => -1
					));
			}
			else
			{
				$req = $bdd->prepare('UPDATE vote SET  vote = :vote WHERE id_users = :id_users AND id_image = :id_image');
				$req->execute(array(
					'vote' => -1,
					'id_users' => $id_users,
					'id_image' => $id
					));
			}	
		}   
		else
		{
			echo "Already voted";
		}                          
	}
	else
	{
		echo 'Vous n\'etes pas connecte';
	}
	}

}


	if (isset($_GET['id']))
	{
		$id = $_GET['id'];
		$req = $bdd->prepare('SELECT * FROM image INNER JOIN users ON users.id = image.id_users WHERE image.id = :id');
		$req->execute(array(
				'id' => $id
			));
		$resultat = $req->fetch();
		$mail = $resultat['mail'];
		echo "<div class='single'>";
		?>
		<div class="info">
			<p class="auteur">Par <?php echo $resultat['login']?></p>
			<p class="date_img">Le <?php echo $resultat['date']?></p>
		</div>
		<img src="<?php echo $resultat['url_image']; ?>" alt="" class="single_img"/>

		<div class="like">
			<div class="up">
	<a href="<?php echo  "commentaire.php?up=1&id=$id"; ?>"><img class="icon icons8-Thumb-Up" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABoAAAAaCAYAAACpSkzOAAAA30lEQVRIie3WwQ2DMBAEQJdACSmBTpISUgIdkBIogRLSQfjvrq4E0gHpwPn4gRACm9iPRDlpX8iM7k5YOJdYAG4kRzOrU89Gl5lVJH3IvRgkqZlBzyJI6GYs3hHJboZ4SdcSyGWOFBmbmdUkpwXU5UYqALZAvKSmOELSAzAAZ0mtpJbkI2Qk+Uja33L5KQEwxHZTH0VC+phO7ivLT820O74Pgfjx5YJ2P4Fc0O7tnrGj7bvw20bXbyK5IAC2CznnnJmdJF0BDAehWxS0gjYk+wA/V17+Cs+6ov8S//qNegMwFXJ3jIA4sAAAAABJRU5ErkJggg==" width="26" height="26">Up</a>
	<?php 
		$req = $bdd->prepare('SELECT * FROM vote WHERE id_image = :id_image AND vote = :vote');
		$req->execute(array(
			'id_image' => $id,
			'vote' => 1
			));
		$res =  $req->rowCount();
		echo "<span class='count'>" . $res . "</span>";

	?>
	</div>
	<div class="up">
	<a href="<?php echo  "commentaire.php?down=-1&id=$id"; ?>"><img class="icon icons8-Thumbs-Down" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAr0lEQVRIid2U0Q3CMAxEbwRGYISO0FEYgRE6SkfoBvB/Z3kE2KDdAD4ISKCqhKSWgJPyFeU9y7YC/F3cfSPpIOmScU4k2/vb1/tZgaQ+E/6QZAvcffsh/An0VkCyCxOk3o9hAjPblcCzBZLOYQKSbSk8SyBpiBYUw79GMIUK0pBLt2hCbZbkJLsquLs3C9X31dWb2T4MDgAkj2FwYHaF14MnwRAGB27feGrT+vCfyBXh+rR8WwIrvgAAAABJRU5ErkJggg==" width="24" height="24">Down</a>
		<?php 
		$req = $bdd->prepare('SELECT * FROM vote WHERE id_image = :id_image AND vote = :vote');
		$req->execute(array(
			'id_image' => $id,
			'vote' => -1
			));
		$res =  $req->rowCount();
		echo "<span class='count'>" . $res . "</span>";
		echo "</div>";
		?>
		</div>
		<?php
		if( filter_has_var( INPUT_POST, 'send' ) )
	{

if (isset($_SESSION['login']))
	{
		if (empty($_POST['message']))
		{
			echo "<p class='msg msg-error'> Votre message est vide</p>";
		}
		else
		{
		$req = $bdd->prepare('INSERT INTO commentaire(id_users, id_image, texte, date) VALUES (:id_users, :id_image, :texte, :date)');
		$req->execute(array(
			'id_users' => $id_users,
			'id_image' => $_GET['id'],
			'texte' => $_POST['message'],
			'date' => date("Y-m-d", time())
			));
		$reqe = $bdd->prepare('SELECT * FROM users WHERE id = :id');
		$reqe->execute(array(
			'id' => $id_users)); 
		$res = $reqe->fetch();
		$destinataire = $mail;
				$sujet = "Reponse a votre image" ;
				$entete = "From: camagru@camagru.com" ;
				 
				// Le lien d'activation est composé du login(log) et de la clé(cle)
				$message = 'Bonjour,
				 
				On a repondu a votre image,

				'.$_POST['message'].' par '.$res['login'].'
				 
				https://camagru.local.42.fr:8443'.$_SERVER['PHP_SELF'].'?id='.$_GET['id'].'
				 
				 
				---------------
				Ceci est un mail automatique, Merci de ne pas y répondre.';
				 
				 
				mail($destinataire, $sujet, $message, $entete) ; // Envoi du mail
		}	
		}	
		else
		{
				echo "<p class='msg msg-error'> Vous n'etes pas connecte</p>";
		}
	}
		?>
		<?php
                    $title=urlencode('Camagru');
                    $urle = "https://camagru.local.42.fr:8443/". $_SERVER['PHP_SELF'] . "?id=$id";
                    $url=urlencode($urle);
                    $image=urlencode('http://livemarketnews.com/dressfinity/skin/frontend/default/default/images/logo.jpg');
                ?>
                <a class="share" onClick="window.open('http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo $title;?>&amp;p[url]=<?php echo $url; ?>&amp;&p[images][0]=<?php echo $image;?>', 'sharer', 'toolbar=0,status=0,width=548,height=325');" target="_parent" href="javascript: void(0)">
                    Partager cette image!
                </a>
                <a target="_blank" title="Cliquez pour partager sur Tweeter" href="http://twitter.com/home?status=En train de lire <?php echo $urle?> via @camagru" class="share-twitter share-icon" via="wpchannel" rel="nofollow">Twitter</a>

		<div class="commentary">

			<?php
				$req = $bdd->prepare('SELECT * FROM commentaire INNER JOIN users ON users.id = commentaire.id_users WHERE id_image = :id_image');
				$req->execute(array(
					'id_image' => $_GET['id']));
				$resultats = $req->fetchAll();
				foreach ($resultats as $key => $value) {
					echo "<div class='comen'>";
					echo "<div class='topside'>";
					echo "<span class='login'> <img class='icon icons8-User' src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAiElEQVRIie2T4QmAIBSEvxEcwQ0boTbSTRrBNqgN6kdKIWUlz0Lo4ANRuPPJCb9qkQYM4DzG74mZj8AcMUqF2APzgJUImBIBrnTAIBFQ/Ik0x1NMCDfJsj7J4Ndi5nVLAQ3bL97X0/gzlWvecd6emPbprfsH5oH+7jSp3l9h7gTkmge+D/j1rhYMiX8qP7THZAAAAABJRU5ErkJggg==' width='24' height='24'><span class='logine'>" . $value['login'] . "</span></span>";
					echo "<span class='date'><img class='icon icons8-Calendar' src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABkAAAAZCAYAAADE6YVjAAAAlElEQVRIie2WbwqAIAzF3xG9Sd0gb1Y3yKN4A/uywbA1jKZB9OCBzI2ffyYInBUAFHJQ5jXdromVXWqSWAWbk+u45auaHTTouZOiQbzvRIV4ayyktz92XKwZwOLgyYLIRxUBbGQZa80xIVJchAc570Hc2vb1nQyByFZcyTLWmmNCIv4WboRk+LRvtiA9NA6i/VY8nQ6eRPMsjsrkdQAAAABJRU5ErkJggg==' width='25' height='25'><span class='datee'>" . $value['date'] . "</span></span>";
					echo "</div>";
					echo "<span class='texte'>" . $value['texte'] . "</span>";
					echo "</div>";
				}
			?>
			<div class="answer">
				<form action="<?php echo $_SERVER['PHP_SELF']."?id=$id" ?>" method="post">
					<label for="message"></label><textarea type="text" name="message"> </textarea>
					<input type="submit" name="send" class="btn btn-default">
				</form>
			</div>
		</div>

                
		</div>
		<?php
	}
	else
	{
		echo "There are some problem";
	}

?>

<?php
	require_once('templates/footer.php');
?>
</body>
</html>
