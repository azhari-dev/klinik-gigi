<?php

	$dbc = new PDO('mysql:host=localhost;dbname=customerdb','root','');

	$statement = $dbc->query("SELECT firstname, address FROM customer WHERE balance > 0");

	foreach ($statement as $row){
		// echo "<h1>{$row['firstname']}</h1>";
		// echo "<p>{$row['address']}</p>";
		echo print_r($row)."<br>";
		// var_dump($row);
	}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>



</body>
</html>