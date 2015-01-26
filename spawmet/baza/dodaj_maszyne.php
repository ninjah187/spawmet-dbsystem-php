<html>
<head>
	<link rel="Stylesheet" type="text/css" href="../style.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Dodaj maszynę</title>
</head>
<body>
<div class="baza_bg">
	<?php
		include 'klasy/Create.php';
		Create::backButton($_GET['lastPage']);
	?>
	<h1 style="text-align: center;">DODAJ MASZYNĘ</h1>
	<div class="window">
		<form action="add_machine.php?lastPage=maszyny.php" method="POST" class="form">
			<div id="inputs">
				<input type=text name=nazwa><br />
				<input type=text name=cena><br />
				<input type=submit name=accept value="Gotowe">
			</div>
			<div id="inputs_names">
				<div id="inputs_text">
					<div class="inputs_name">Nazwa:</div>
					<div class="inputs_name">Cena:</div>
				</div>
			</div>
		</form>
	</div>
</div>
</body>
</html>