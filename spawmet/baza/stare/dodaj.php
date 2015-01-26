<html>
<head>
	<link rel="Stylesheet" type="text/css" href="../style.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Strona</title>
</head>
<body>
<div class="baza_bg">
	<h2>Dodaj rekord:</h2>
	<div class="window">
		<form action="add_record.php" method="POST" class="form_login" style="position: relative; left: 90px; top: -10px;">
			<span style="color: white;">Nazwa:</span> <input type=text name=nazwa style="position: relative; left: 5px;"><br>
			<span style="position: relative; top: 5px;"><span style="color: white;">Ilość:</span> <input type=text name=ilosc style="position: relative; left: 21px"></span><br>
			<input type=submit name=accept value="Gotowe" style="position: relative; left: 95px; top: 15px;">
		</form>
	</div>
	<div id="menu" style="height: 42px; position: relative; top: 25px;">
		<a href="baza.php"><span class="menu_button">Powrót</span></a>
	</div>
</div>
</body>
</html>