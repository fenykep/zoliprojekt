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

			$sql = "SELECT members FROM `rooms` WHERE ID = '".intval($_POST["roomNum"])."'";	
 			$result = mysqli_query($conn, $sql);
 			while($row = $result->fetch_assoc()){$members = explode("!", $row["members"]);}

 			echo '
 			<div class="card">
				<h1 class="roomuid">'.$_POST["roomNum"].'</h1>
 			';
 			for ($x = 0; $x <= sizeof($members)-1; $x++){
				echo '<button name="gomb" value="'.strval($x+1).'">'.$members[$x]."</button>";}
			echo "</div>";
		?>
		
		<!--<footer>2019 Ábel Bódis C</footer>-->
	</body>
</html>
