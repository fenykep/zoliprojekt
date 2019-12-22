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
			else{echo '
				<div class="card">
					<h1 class="roomuid">#Room UID</h1>
					<h2 class="member">Tóth Zoltán</h2>
					<h2 title="The '."'$'".' sign marks who paid last time " class="member">Bódis Gergely</h2>
					<h2><a href="/zoliprojekt/index.php">ADD</a></h2>
				</div>
			';}//login
			
			mysqli_close($conn);
		?>

		
		
		<!--<footer>2019 Ábel Bódis C</footer>-->
	</body>
</html>

<!--
	

			$sql = "SELECT * FROM users;";
			echo '<h1>Szevasztok</h1>';
			$result = $conn->query($sql);
			if ($result->num_rows = 0) {
				echo "nincs itt semmi látnivaló";
			}
			
			
			$sql = "INSERT INTO termekek (`id`, `termeknev`, `tag`, `ar`, `szin`, `kep`) VALUES (NULL, '$_POST[termeknev]', '$_POST[tag]', '$_POST[ar]', '$_POST[szin]', '$kephely');";
    echo "<br>".$sql."<br>";
    if(mysqli_query($conn, $sql)===TRUE){echo("done!");};
			mysqli_close($conn);
			?>

-->