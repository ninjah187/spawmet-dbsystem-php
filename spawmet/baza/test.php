<?php
	include 'klasy/Table.php';
	
	$dbm = new DBManager();
	$dbm->connect();
	$dbm->query('
		INSERT INTO maszyny VALUES (
			DEFAULT,
			"Kałamarz",
			NULL
		)
	');
	$dbm->close();
	echo 'done';
?>