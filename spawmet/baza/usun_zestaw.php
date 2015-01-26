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
					&& zestawy_czesci.nr_zestawu = '.$_GET['setNumber'].'
		');
		echo '<h2>Czy na pewno chcesz usunąć dany zestaw części?</h2>';
		$z->showTableWithoutOptions();
		$z->deleteQuestionCommunicate($_GET['setNumber']);
		$z->close();
	?>
	
</div>
</body>
</html>