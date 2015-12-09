<?php
	require_once('templates/header.php');
		include_once('paginate.php');

if(isset($_GET['order']))
{

$num_rec_per_page=10;
if (isset($_GET['id']))
{
	if (isset($_SESSION['login']))
	{
	$id = $_GET['id'];
	if (isset($_GET['up']) && $_GET['up'] == 1)
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
	if (isset($_GET['down']) && $_GET['down'] == -1)
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
}
else
{
	echo 'Vous n\'etes pas log';
}
}

?>
<div class="galerie">
	<div class="tri">
		<span class="txt">Trier par </span>
		<a href="galerie.php?order=pop" class="pop">POPULARITE</a>
		<a href="galerie.php?order=unpop">NON POPULARITE</a>
	</div>
	<?php

$requete=$bdd->prepare("SELECT * FROM image");
$requete->execute();
$total = $requete->rowCount();
$epp = 10;
$nbPages = ceil($total/$epp);
$current = 1;
if (isset($_GET['p']) && is_numeric($_GET['p'])) 
{
		$page = intval($_GET['p']);
		if ($page >= 1 && $page <= $nbPages) {
			// cas normal
			$current=$page;
		} else if ($page < 1) {
			// cas où le numéro de page est inférieure 1 : on affecte 1 à la page courante
			$current=1;
		} else {
			//cas où le numéro de page est supérieur au nombre total de pages : on affecte le numéro de la dernière page à la page courante
			$current = $nbPages;
		}
}

$start = ($current * $epp - $epp);
if (isset($_GET['order']) && $_GET['order'] == "pop")
{

	$req = $bdd->prepare('SELECT image.id, url_image, sum(vote) FROM image LEFT JOIN vote ON vote.id_image = image.id GROUP BY image.id ORDER BY sum(vote) DESC LIMIT :start, :epp');
}
else if (isset($_GET['order']) && $_GET['order'] == "unpop")
{
	$req = $bdd->prepare('SELECT image.id, url_image, sum(vote) FROM image LEFT JOIN vote ON vote.id_image = image.id GROUP BY image.id ORDER BY sum(vote) ASC LIMIT :start, :epp');
}
else
{
$req = $bdd->prepare('SELECT * FROM image ORDER BY id DESC LIMIT :start, :epp');
}
  $req->bindParam(':start', $start, PDO::PARAM_INT);
 $req->bindParam(':epp', $epp, PDO::PARAM_INT);
 $req->execute();

?>
<div class="galerie">
<?php
while($item = $req->fetch()) 
{
	$id = $item['id'];
 ?>
 <div class="gal">
 	<a href="<?php echo "commentaire.php?id=$id" ?>">
  		<img src="<?php echo $item['url_image']; ?>" alt="" class="cadre">
  	</a>
  		<div class="like">
  			
		<div class="up">
	<a href="<?php echo  "galerie.php?page=$current&up=1&id=$id"; ?>"><img class="icon icons8-Thumb-Up" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABoAAAAaCAYAAACpSkzOAAAA30lEQVRIie3WwQ2DMBAEQJdACSmBTpISUgIdkBIogRLSQfjvrq4E0gHpwPn4gRACm9iPRDlpX8iM7k5YOJdYAG4kRzOrU89Gl5lVJH3IvRgkqZlBzyJI6GYs3hHJboZ4SdcSyGWOFBmbmdUkpwXU5UYqALZAvKSmOELSAzAAZ0mtpJbkI2Qk+Uja33L5KQEwxHZTH0VC+phO7ivLT820O74Pgfjx5YJ2P4Fc0O7tnrGj7bvw20bXbyK5IAC2CznnnJmdJF0BDAehWxS0gjYk+wA/V17+Cs+6ov8S//qNegMwFXJ3jIA4sAAAAABJRU5ErkJggg==" width="26" height="26">Up</a>
	<?php 
		$reqe = $bdd->prepare('SELECT * FROM vote WHERE id_image = :id_image AND vote = :vote');
		$reqe->execute(array(
			'id_image' => $id,
			'vote' => 1
			));
		$res =  $reqe->rowCount();
		echo "<span class='count'>" . $res . "</span>";
	?>
	</div>
	<div class="up">
	<a href="<?php echo  "galerie.php?page=$current&down=-1&id=$id"; ?>"><img class="icon icons8-Thumbs-Down" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAr0lEQVRIid2U0Q3CMAxEbwRGYISO0FEYgRE6SkfoBvB/Z3kE2KDdAD4ISKCqhKSWgJPyFeU9y7YC/F3cfSPpIOmScU4k2/vb1/tZgaQ+E/6QZAvcffsh/An0VkCyCxOk3o9hAjPblcCzBZLOYQKSbSk8SyBpiBYUw79GMIUK0pBLt2hCbZbkJLsquLs3C9X31dWb2T4MDgAkj2FwYHaF14MnwRAGB27feGrT+vCfyBXh+rR8WwIrvgAAAABJRU5ErkJggg==" width="24" height="24">Down</a>
		<?php 
		$reqe = $bdd->prepare('SELECT * FROM vote WHERE id_image = :id_image AND vote = :vote');
		$reqe->execute(array(
			'id_image' => $id,
			'vote' => -1
			));
		$res =  $reqe->rowCount();
		echo "<span class='count'>" . $res . "</span>";
	?>
	</div>
	<?php 
		$reqe = $bdd->prepare('SELECT * FROM commentaire WHERE id_image = :id_image');
		$reqe->execute(array(
			'id_image' => $item['id']));
		$resu = $reqe->rowCount();
	?>
	<span class="comment"><a href="<?php echo "commentaire.php?id=$id" ?>">Commenter(<?php echo $resu; ?>)</a></span>
</div>
</div>
  <?php
}

echo "</div>";
echo "</div>";
$url = 'https://camagru.local.42.fr:8443' . $_SERVER['REQUEST_URI'];
echo paginate($url, '&p=', $nbPages, $current);

echo "</div>";


?>
</div>
<?php
}
else
{
	echo "Oups";
}
	require_once('templates/footer.php');
?>
</body>
</html>