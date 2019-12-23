<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="/zoliprojekt/astyle.css">
	</head>
	
	<body>
		<?php
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "zoliprojekt";

			$conn = mysqli_connect($servername, $username, $password, $dbname);

			// Check connection
			if (!$conn) {die("Connection failed: " . mysqli_connect_error());}
			else{echo("");}

			$sql = "SELECT email FROM users;";
			$users = array();
			
			
			$result = mysqli_query($conn, $sql);
			while($row = $result->fetch_assoc()) {
				//echo $row["email"] . "<br>";
				array_push($users, $row["email"]);
			} 

			echo "<br>";
						

			if (!in_array($_POST["email"], $users)) {
				echo '
				<div class="card">
					<form method="post" action="/zoliprojekt/index.php">
						<h1>Hello</h1>
						<input name="nick" type="text" placeholder="How shall I call you?">
						<input name="email" type="text" value='.$_POST["email"].'>
						<input type="submit" value="Boom">
					</form>
				</div>
				';
			}
			else{
				setcookie("emailsuti",$_POST["email"],time() + (86400 * 365), "/");
				$sql = "SELECT nick, rooms FROM `users` WHERE email = '".$_COOKIE["emailsuti"]."'";
				$result = mysqli_query($conn, $sql);
				while($row = $result->fetch_assoc()) {
					$cNick = $row["nick"];
					$cRooms = $row["rooms"];
					//echo "valami történik";
				}
				echo '
				<div class="card">
					<h1 class="nick">'.$cNick.' Társaságai</h1>
					<!--ide listázd az elérhető szobákat-->
					<h2><a href="/zoliprojekt/index.php">ADD</a></h2>
				</div>
			';}
			
			mysqli_close($conn);
		?>

		
		<!--<h2 title="The '."'$'".' sign marks who paid last time " class="member">Bódis Gergely</h2>-->
		<!--<footer>2019 Ábel Bódis C</footer>-->
	</body>
</html>
