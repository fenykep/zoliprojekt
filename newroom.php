<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="/zoliprojekt/ustyle.css">
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

		?>

		<div class="card">
			<form action="/zoliprojekt/email.php" method="post">
				<?php
				if ($_POST["cjr"]=="create") {
					echo '<h1>New friendships begin...</h1>';
					echo '<input name="rTc" placeholder="How do you call the band?">
						  <input type="submit" value="Eat!">';
				}
				
				else{
					echo '<h1>Kapcsolatunk komolyodik</h1>';
					echo '<input name="rTj" placeholder="What room would you like to join?">
						  <input type="submit" value="Csatlakozom">';
				}
				

				?>
				
				
			</form>
		</div>
	</body>
</html>