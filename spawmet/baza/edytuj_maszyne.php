<html>
<head>
	<link rel="Stylesheet" type="text/css" href="../style.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Maszyny</title>
</head>
<body>
<div class="baza_bg">
	<?php
		include 'klasy/Create.php';
		Create::backButton($_GET['lastPage']);

		include 'klasy/klasa_maszyny.php';
		$m = new Maszyny('
			SELECT nazwa AS "Nazwa", cena AS "Cena" FROM maszyny
			WHERE id_maszyna = '.$_GET['machineID'].'
		');
		echo '<h2>Edytuj maszynę:</h2>';
		$m->showTableWithoutOptions($_GET['machineID']);
		$m->editMachineForm($_GET['machineID']);
		$m->close();
	?>
</div>
</body>
</html>