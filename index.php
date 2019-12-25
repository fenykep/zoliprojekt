<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="/zoliprojekt/nstyle.css">
	</head>
	
	<body>
		<?php
			include 'server.php';
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
			if (isset($_SERVER['HTTP_REFERER'])) {
				if ($_SERVER['HTTP_REFERER']=="http://localhost/zoliprojekt/email.php") {
	    					unset($_COOKIE["emailsuti"]);
	    					unset($_COOKIE["nickSuti"]);
	    					setcookie("nickSuti", '', time() - 86400, '/');
	    					setcookie("emailsuti", '', time() - 86400, '/');
	    					header("Refresh:0");
					}
			}
			
			if (isset($_POST["email"])) {
				setcookie("emailsuti",$_POST["email"],time() + (86400 * 365), "/");
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
				if (!isset($_COOKIE["emailsuti"]) and !isset($_POST["email"])) {
					echo '<input name="email" type="email" placeholder="Enter your email">';}
				//elseif(!isset($_POST["email"])){echo '<input name="email" type="email" value='.$_COOKIE["emailsuti"].'>';}
				elseif(!isset($_POST["email"]))
				{
					header("Refresh:0; url=/zoliprojekt/email.php");
					exit;
				}
				else{echo '<input name="email" type="email" value='.$_POST["email"].'>';}?>

				<input type="submit" value="Boom">
				<!--Itt csekkold, hogy van-e ilyen email a databaseban-->
			</form>
		</div>
		
		<!--<footer>2019 Ábel Bódis C</footer>-->
	</body>
</html>
