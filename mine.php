<?php
	require_once('templates/header.php');

	
	if( filter_has_var( INPUT_POST, 'delete' ) ){
		$id = $_POST['id'];
		$req = $bdd->prepare('DELETE FROM image WHERE id_users = ? and id = ?');
		
		$ret = $req->execute(array($id_users, $id));
		if ($ret)
			echo "<p class='msg msg-success'>Supprimer avec succes</p>";
		else
			echo "<p class='msg msg-error'>Erreur inconnu</p>";
	}
	if(isset($id_users))
	{
	$req = $bdd->prepare('SELECT * FROM image WHERE id_users = ? ORDER BY id DESC');
	$req->execute(array($id_users));
	$res = $req->fetchAll();
	echo "<div class='galerie'>";
	foreach ($res as $key => $value) {

		?>
		<div class="gal">
	<img src="<?php echo $value['url_image']; ?>" alt="" class="cadre">
	<form action="" method="post" name="delete" onsubmit="return confirm('Etes-vous sur de votre choix ?');">
		<input name="id" type="hidden" value="<?php echo $value['id'] ?>">
		<input type="submit" value="Supprimer" name="delete" class="btn btn-default btn-center" />
	</form>
</div>
		<?php
	}
	
	}
?>
</div>
<?php
	require_once('templates/footer.php');
?>