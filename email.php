<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="/zoliprojekt/nstyle.css">
	</head>
	
	<body>
		<?php
			include server.php;
			/*		
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "zoliprojekt";
			*/
			$conn = mysqli_connect($servername, $username, $password, $dbname);

			// Check connection
			if (!$conn) {die("Connection failed: " . mysqli_connect_error());}
			else{echo("");}

			$sql = "SELECT email FROM users;";
			$users = array();
			$result = mysqli_query($conn, $sql);
			while($row = $result->fetch_assoc()){array_push($users, $row["email"]);} 

			echo "<br>";

			if (isset($_POST["rTj"])){
				$sql = "UPDATE users SET rooms = coalesce(concat(rooms,'".strval($_POST["rTj"])."x'),'".strval($_POST["rTj"])."x',rooms) WHERE email = '".$_COOKIE["emailsuti"]."'; "." UPDATE rooms SET members = concat(members,'".$_COOKIE["nickSuti"]."!') WHERE ID = ".$_POST["rTj"];
				mysqli_multi_query($conn, $sql);
				header("Refresh:0");
								
			}
			
			if (isset($_POST["rTc"])){
				$sql = "INSERT INTO `rooms` (`ID`, `name`, `members`, `turn`) VALUES (NULL, '".$_POST["rTc"]."','".$_COOKIE["nickSuti"]."!',1)";
				mysqli_query($conn,$sql);
				$lastID = mysqli_insert_id($conn);
				$sql = "UPDATE users SET rooms = coalesce(concat(rooms,'".strval($lastID)."x'),'".strval($lastID)."x',rooms) WHERE email = '".$_COOKIE["emailsuti"]."'";
				mysqli_query($conn,$sql);
				//mysqli_multi_query($conn, $sql);
				//header("Refresh:0");
				//echo "RoomName to create:".$_POST["rTc"];
			}
						
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
					setcookie("nickSuti",$cNick,time() + (86400 * 365), "/");
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
						<button name="cjr" value="join" form="cj">Join Room</button>
						<button name="cjr" value="create" form="cj">Create Room</button>
						<h2><a href="/zoliprojekt/index.php">Logout</a></h2>
					</form>
				</div>
				';
				
			}
			
			mysqli_close($conn);
		?>
		<form action="/zoliprojekt/newroom.php" method="post" id="cj"></form>
		<!-- title="The '."'$'".' sign marks who paid last time " -->
		<!--<footer>2019 Ábel Bódis C</footer>-->
	</body>
</html>

<!--


UPDATE users SET rooms = concat(rooms,'1x') WHERE ID = 1
INSERT INTO `rooms` (`ID`, `name`, `members`, `turn`) VALUES ('5', 'DumbledoreSerege', 'Abel', '1');
	-->
