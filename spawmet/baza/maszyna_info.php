<html>
<head>
	<link rel="Stylesheet" type="text/css" href="../style.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Info</title>
</head>
<body>
<div class="baza_bg">
	<?php
		include 'klasy/Create.php';
		Create::backButton($_GET['lastPage']);
	?>
	<h1 style="text-align: center;">INFO</h1>
	<?php
		include 'klasy/Table.php';
		$t = new Table('
			SELECT zestawy_czesci.nr_zestawu AS "Numer zestawu",
			maszyny.nazwa AS "Maszyna",
			czesci.nazwa AS "Część",
			zestawy_czesci.ilosc_potrzebnych_cz AS "Potrzebna ilość"
			FROM zestawy_czesci, maszyny, czesci
			WHERE zestawy_czesci.maszyna = maszyny.id_maszyna && zestawy_czesci.czesc = czesci.id_czesci
			&& maszyny.id_maszyna = '.$_GET['machineID']);
			
			/*SELECT maszyny.nazwa AS "Maszyna",
			czesci.nazwa AS "Część",
			zestawy_czesci.ilosc_potrzebnych_cz AS "Potrzebna ilość"
			FROM zestawy_czesci, maszyny, czesci
			WHERE 
		');
		//przekazuj id, nie nazwę i w ten sposób kombinuj
		/*$t = new Table('
			SELECT maszyny.nazwa AS "Maszyna",
			czesci.nazwa AS "Część",
			zestawy_czesci.ilosc_potrzebnych_cz AS "Potrzebna ilość"
			FROM zestawy_czesci, maszyny, czesci
			WHERE 
		');*/
		$t->showTableWithoutOptions();
		$t->close();
	?>
</div>
</body>
</html>