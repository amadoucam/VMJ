<?php

try

{

    $bdd = new PDO('mysql:host=localhost;dbname=vmj;charset=utf8', 'root', 'RocquetDeMalherbe');

}

catch(Exception $e)

{

        die('Erreur : '.$e->getMessage());

}

$telephone = $_POST['telephone'] ;
$email = $_POST['email'] ;

$req = $bdd->prepare('INSERT INTO rappel(telephone, email) VALUES(:telephone, :email)');
$req->execute(array(
	'telephone' => $telephone,
	'email' => $email,
	));

header ('Location: http://www.viemonjob.com');

// ?>