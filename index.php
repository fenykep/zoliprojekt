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
			if (isset($_POST["email"])) {
				$sql = "INSERT INTO users (ID, nick, email,rooms) VALUES (NULL, '$_POST[nick]', '$_POST[email]',NULL)";
				if ($conn->query($sql) === TRUE) {
    				echo "Registered!";
				} else {echo "Error: " . $sql . "<br>" . $conn->error;}
			}
			
			mysqli_close($conn);
		?>
		<div class="card">
			<form action="/zoliprojekt/email.php" method="post">
				<h1>Hello</h1>
				<?php
				if (!isset($_COOKIE["emailsuti"])) {
					echo '<input name="email" type="email" placeholder="Enter your email">';
				}
				else{
					echo '<input name="email" type="email" value='.$_COOKIE["emailsuti"].'>';	
				}
				?>
				
				<input type="submit" value="Boom">
				<!--Itt csekkold, hogy van-e ilyen email a databaseban-->
			</form>
		</div>
		
		<!--<footer>2019 Ábel Bódis C</footer>-->
	</body>
</html>
