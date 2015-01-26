<html>
<head>
	<link rel="Stylesheet" type="text/css" href="../style.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Dołącz część do zestawu</title>
</head>
<body>
<div class="baza_bg">
	<?php
		include 'klasy/Create.php';
		Create::backButton($_GET['lastPage']);
	?>
	<?php
		include 'klasy/klasa_zestawy_czesci.php';
		$z = new ZestawyCzesci('
			SELECT
			zestawy_czesci.nr_zestawu AS "Numer zestawu",
			maszyny.nazwa AS "Maszyna",
			czesci.nazwa AS "Część",
			zestawy_czesci.ilosc_potrzebnych_cz AS "Potrzebna ilość"
			FROM zestawy_czesci, maszyny, czesci
			WHERE zestawy_czesci.maszyna = maszyny.id_maszyna && zestawy_czesci.czesc = czesci.id_czesci
					&& zestawy_czesci.id_zestaw_czesci = '.$_GET['setID'].'
		');
		echo '<h2>Czy na pewno chcesz usunąć daną część z zestawu?</h2>';
		$z->showTableWithoutOptions();
		$z->deletePartQuestionCommunicate($_GET['setID']);
		$z->close();
	?>
	
</div>
</body>
</html>