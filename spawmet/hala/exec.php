<html>
<head>
	<link rel="Stylesheet" type="text/css" href="../style.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<script type="text/javascript" src="../baza/options.js"></script>
	<title>Części</title>
</head>
<body>
<div class="baza_bg" style="padding-top: 20px;">
	<?php
		//include '../baza/klasy/Create.php';
		//Create::backButton($_GET['lastPage']);
	
		include '../baza/klasy/klasa_hala.php';
		$t = new Hala('
			SELECT id_czesci
			FROM czesci
		');
		$ilosc = $_POST['ilosc'];
		if($_GET['raise'] == 0) {
			$ilosc = -$ilosc;
		}
		$t->edit($_GET['partID'], $ilosc);
		$t->close();
	?>
</div>
</body>
</html>