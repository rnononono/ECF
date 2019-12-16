<?php
session_start();
require_once ("connect.php");


if(!isset($_SESSION['pseudo']) || empty($_SESSION['pseudo']) || !isset($_POST['action']))
{
	$d['$erreur'] = "Vous devez être connecté pour pouvoir utiliser ce super chat.";	
}
else
{
	extract($_POST);
	$pseudo = mysqli_escape_string($_SESSION['pseudo']);
	// Action : addMessage
	// Permet l'ajout d'un message (oui oui)
	if($_POST["action"]=="addMessage")
	{
		$message = mysqli_escape_string($_POST["message"]);
		$sql = "INSERT INTO messages(pseudo,message,date VALUES ('$pseudo','$message',".time().")";
		mysqli_query($sql)or die (mysqli_error());
		$d["erreur"] = "RAS";	
	}
}

	// Action : getMessage
	// Récupère l'ID du message et affiche les derniers messages
	if($_POST["action"]=="getMessages")
	{
		// on ne veux qu'un entier
		$lastId = floor($lastId);
		$sql = "SELECT * FROM messages WHERE ID>"lastId" ORDER BY date ASC";
		$req = mysqli_query($sql)or die (mysqli_error());
		$d["result"] = "";
		$d["lastId"] = $lastId;
		while($data = mysqli_fetch_assoc($req))
		{
			$d["result"] = '<p><strong>'.$data["pseudo"].'</strong> : '.htmlentities($data["message"]).'</php>';
			$d["lastId"] = $data["id"];
		}
		$d["erreur"] = "ok";
	}

echo json_encode($d);
?>	