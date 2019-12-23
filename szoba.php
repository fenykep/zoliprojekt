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

			
 			
			if (isset($_POST["gomb"])) {

			$sql = "UPDATE `rooms` SET `turn` = '"."' WHERE `rooms`.`ID` = '".intval($_POST["roomNum"])."'";
			
 			$result = mysqli_query($conn, $sql);
				if ($conn->query($sql) === TRUE) {
    				echo "New record created successfully";
				} else {
    				echo "Error: " . $sql . "<br>" . $conn->error;
				}
			}

			$sql = "SELECT members, turn FROM `rooms` WHERE ID = '".intval($_POST["roomNum"])."'";	
 			$result = mysqli_query($conn, $sql);
 			while($row = $result->fetch_assoc()){$members = explode("!", $row["members"]);$turn=$row["turn"];}

 			echo '
 			<div class="card">
 				<form method="post" action="/zoliprojekt/szoba.php">
				<h1 class="roomuid">'.$_POST["roomNum"].'</h1>
 			';
 			for ($x = 0; $x <= sizeof($members)-1; $x++){
 				if ($x+1==$turn) {
 					echo '<button type="submit" name="gomb" value="'.strval($x+1).'">'.$members[$x]." $$$</button>";}
 				else{
 					echo '<button type="submit" name="gomb" value="'.strval($x+1).'">'.$members[$x]."</button>";}				
			}
			echo "</form></div>";
		?>
		
		<!--<footer>2019 Ábel Bódis C</footer>-->
	</body>
</html>
