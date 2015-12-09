<?php

	require_once('templates/header.php');
$login = $_GET['log'];
$cle = $_GET['cle'];
 
// Récupération de la clé correspondant au $login dans la base de données
$stmt = $bdd->prepare("SELECT cle,actif FROM users WHERE login = :login ");
if($stmt->execute(array(':login' => $login)) && $row = $stmt->fetch())
  {
    $clebdd = $row['cle'];	// Récupération de la clé
    $actif = $row['actif']; // $actif contiendra alors 0 ou 1
  }
  if($actif == '1') // Si le compte est déjà actif on prévient
  {
     echo "Votre compte est déjà actif !";
  }
else // Si ce n'est pas le cas on passe aux comparaisons
  {
     if($cle == $clebdd) // On compare nos deux clés	
       {
          // Si elles correspondent on active le compte !	
          echo "Votre compte a bien été activé !";
 
          // La requête qui va passer notre champ actif de 0 à 1
          $stmt = $bdd->prepare("UPDATE users SET actif = 1 WHERE login = :login ");
          $stmt->bindParam(':login', $login);
          $stmt->execute();
       }
     else // Si les deux clés sont différentes on provoque une erreur...
       {
          echo "Erreur ! Votre compte ne peut être activé...";
       }
  }
	require_once('templates/footer.php');

?>