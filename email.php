<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="/zoliprojekt/nstyle.css">
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
			while($row = $result->fetch_assoc()){array_push($users, $row["email"]);} 

			echo "<br>";
						
			if (!isset($_POST["email"])) {$_POST["email"] = $_COOKIE["emailsuti"];}
			
			if (!in_array($_POST["email"], $users)) 
			{
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

			else
			{
				setcookie("emailsuti",$_POST["email"],time() + (86400 * 365), "/");
				$sql = "SELECT nick, rooms FROM `users` WHERE email = '".$_POST["email"]."'";
				$result = mysqli_query($conn, $sql);
				
				while($row = $result->fetch_assoc()) 
				{
					$cNick = $row["nick"];
					$cRooms = explode("x", $row["rooms"]);
				}
				
				echo '
				<div class="card">
					<form action="/zoliprojekt/szoba.php" method="post">
						<h1 class="nick">'.$cNick.' Társaságai</h1>
					';					
				
				$roomNames = array();
				for ($x = 0; $x <= sizeof($cRooms)-1; $x++) 
				{
 					$sql = "SELECT name FROM `rooms` WHERE ID = '".intval($cRooms[$x])."'";	
 					$result = mysqli_query($conn, $sql);
 					while($row = $result->fetch_assoc())
 						{
 							array_push($roomNames, $row["name"]);
 							echo '<button name="roomNum" type="submit" value="'.$cRooms[$x].'" >'.$row["name"].'</button>';
 						}
				}
				echo '
						<h2><a href="/zoliprojekt/index.php">ADD</a></h2>
					</form>
				</div>
				';
				
			}
			
			mysqli_close($conn);
		?>

		
		<!-- title="The '."'$'".' sign marks who paid last time " -->
		<!--<footer>2019 Ábel Bódis C</footer>-->
	</body>
</html>
