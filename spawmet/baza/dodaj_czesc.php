<html>
<head>
	<link rel="Stylesheet" type="text/css" href="../style.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Dodaj część</title>
</head>
<body>
<div class="baza_bg">
	<?php
		include 'klasy/Create.php';
		Create::backButton($_GET['lastPage']);
	?>
	<h1 style="text-align: center;">DODAJ CZĘŚĆ</h1>
	<div class="window">
		<form action="add_part.php?lastPage=czesci.php" method="POST" class="form">
			<div id="inputs">
				<input type=text name=nazwa><br />
				<input type=text name=ilosc><br />
				<select name=pochodzenie>
					<option>Kupno</option>
					<option>Sprzedaż</option>
					<option>Inne</option>
				</select><br />
				<input type=submit name=accept value="Gotowe">
			</div>
			<div id="inputs_names">
				<div id="inputs_text">
					<div class="inputs_name">Nazwa:</div>
					<div class="inputs_name">Ilość:</div>
					<div class="inputs_name">Pochodzenie:</div>
				</div>
			</div>
		</form>
	</div>
</div>
</body>
</html>