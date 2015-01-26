<html>
<head>
	<link rel="Stylesheet" type="text/css" href="../style.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Dodaj klienta</title>
</head>
<body>
<div class="baza_bg">
	<?php
		include 'klasy/Create.php';
		Create::backButton($_GET['lastPage']);
	?>
	<h1 style="text-align: center;">DODAJ KLIENTA</h1>
	<div class="window">
		<form action="add_customer.php?lastPage=klienci.php" method="POST" class="form">
			<div id="inputs">
				<input type=text name=nazwa><br />
				<input type=text name=miejscowosc><br />
				<input type=text name=telefon><br />
				<input type=text name=email><br />
				<input type=text name=nip><br />
				<input type=text name=wojewodztwo><br />
				<input type=text name=ulica><br />
				<input type=text name=kodPocztowy><br />
				<input type=submit name=accept value="Gotowe">
			</div>
			<div id="inputs_names">
				<div id="inputs_text">					
					<div class="inputs_name">Nazwa:</div>
					<div class="inputs_name">Miejscowość:</div>
					<div class="inputs_name">Telefon:</div>
					<div class="inputs_name">Email:</div>
					<div class="inputs_name">NIP:</div>
					<div class="inputs_name">Województwo:</div>
					<div class="inputs_name">Ulica:</div>
					<div class="inputs_name">Kod Pocztowy:</div>
				</div>
			</div>
		</form>
	</div>
</div>
</body>
</html>