<?php
// on vérifie tout d'abord que le champ pseudo a bien une valeur
if(!empty($_POST) && isset($_POST["pseudo"]) && !empty($_POST["pseudo"]))
{
	//si tout se passe bien, on initialise la session
	session_start();
	// on envoie le pseudo
	$_SESSION["pseudo"] = $_POST["pseudo"];
	// redirection vers le chat
	header("location:chat.php");
}
?>

<head>
	<title>Bienvenue</title>
	<link rel="stylesheet" href="style.css"/>
</head>

<body>
	<div id="conteneur">
		<h1>Un tchate</h1>
		<form action= "chat.php" method= "post">
			Pseudo : <input type="text" name="pseudo" placeholder="Ne soyez pas timide !"/>
			<input type="submit" value="C'est parti !"/> 
		</form>
	</div>
</body>
