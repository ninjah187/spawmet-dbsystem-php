<html>
<head>
	<link rel="Stylesheet" type="text/css" href="../style.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Dodaj zamówienie</title>
</head>
<body>
<div class="baza_bg">
	<?php
		include 'klasy/Create.php';
		Create::backButton($_GET['lastPage']);
	?>
	<h1 style="text-align: center;">DODAJ ZAMÓWIENIE</h1>
	<div class="window">
		<form action="add_order.php?lastPage=zamowienia.php" method="POST" class="form">
			<div id="inputs">
				<select name=maszyna>
				<?php
					include 'klasy/klasa_maszyny.php';
					$t = new Table('SELECT nazwa FROM maszyny ORDER BY nazwa');
					for($i = 0; $i < $t->numberOfRows; $i++) {
						echo '<option>'.$t->getRecord($t->table, $i, "nazwa").'</option>';
					}
					$t->close();
				?>
				</select><br />
				<select name=klient>
				<?php
					//include 'klasy/klasa_klienci.php';
					$t = new Table('SELECT id_klient, nazwa FROM klienci ORDER BY nazwa');
					for($i = 0; $i < $t->numberOfRows; $i++) {
						$klient = $t->getRecord($t->table, $i, "nazwa");//.' (id '.$t->getRecord($t->table, $i, "id_klient").')';
						echo '<option>'.$klient.'</option>';
					}
					$t->close();
				?>
				</select><br />
				<input type=text name=uwagi style="width: 200px; height: 100px"><br>
				<input type=submit name=accept value="Gotowe">
			</div>
			<div id="inputs_names">
				<div id="inputs_text">
					<span class="inputs_name">Maszyna:</span><br />
					<span class="inputs_name">Klient:</span><br />
					<span class="inputs_name">Uwagi:</span><br />
				</div>
			</div>			
		</form>
	</div>
</div>
</body>
</html>