<html>
<head>
	<link rel="Stylesheet" type="text/css" href="../style.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Zamówienia</title>
</head>
<body>
<div class="baza_bg">
	<?php
		include 'klasy/Create.php';
		Create::backButton($_GET['lastPage']);
	?>
	<?php
		include 'klasy/klasa_zamowienia.php';
		$z = new Zamowienia('
			SELECT zamowienia.id_zamowienie AS "id", klienci.nazwa AS "Klient", maszyny.nazwa AS "Maszyna", zamowienia.status AS "Status",
			zamowienia.data_zlozenia AS "Data złożenia", zamowienia.uwagi AS "Uwagi"
			FROM (klienci INNER JOIN zamowienia ON klienci.id_klient = zamowienia.klient)
				  INNER JOIN maszyny ON maszyny.id_maszyna = zamowienia.maszyna
			WHERE zamowienia.id_zamowienie = '.$_GET['orderID'].'
		');
		$z->changeStatus($_GET['orderID'], $_POST['status']);
		$z->close();
	?>
</div>
</body>
</html>