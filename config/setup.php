<?php
require_once('database.php');
try
{
    $bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    $bdd -> exec("set names utf8");
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}
?>