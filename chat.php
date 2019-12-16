<?php
require_once ("connect.php");
session_start();
// on revérifie si la session contient qqch
if(!isset($_SESSION["pseudo"]) || empty($_SESSION["pseudo"]))
{
	// si c'est pas le cas, on retourne à l'index (mesure de sécurité)
	header("location:index.php");
}

?>

<head>
	<title>Chat</title>
	<link rel="stylesheet" href="style.css"/>
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"/>
	<script src="chat.js"/>
	<script>
	<?php
		// selection des ID des messages et on les affiche
		$sql = "SELECT id FROM messages ORDER BY id DESC LIMIT 1";
		$req = mysqli_query($req) or die (mysqli_error());
		$data = mysqli_fetch_assoc($req);
	?>
	var lastId = <?php echo $data ['id']; ?>
	</script>
</head>


<body>
	<div id="conteneur">
	<h1> Un chat , bienvenue <?php echo $_SESSION["pseudo"]; ?></h1>
	</div>
	<div id="chat">
		<?php
			$sql = "SELECT * FROM messages ORDER BY date DESC LIMIT 15";
			$req = mysqli_query($sql) or die(mysqli_error());
			$d = array();
			while ($data = mysqli_fetch_assoc($req))
			{
				$d[] = $data;
			}
			for($i = count($d) - 1;$i > 0;$i--)
				?>
			{
			
				<p><strong><?php echo $d[$i]['pseudo']; ?></strong> : <?php date("d/m/Y" "H:i:s") ?> : <?php echo htmlentities(utf8_decode($d[$i]['message']));?></p>
			}
			

	<div id="chatForm"/>
		<form method="post" action="#">
			<textarea name="message"></textarea>
			<input type="submit" value="Envoyer"/>
		</form>
	</div>
</body>	