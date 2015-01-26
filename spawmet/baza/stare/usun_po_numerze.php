<html>
<head>
	<link rel="Stylesheet" type="text/css" href="../style.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Strona</title>
</head>
<body>
<div class="baza_bg">
	<h2>Usuń po numerze:</h2>
	<div class="window">
		<form action="delete_record_by_number.php" method="POST" class="form_login" style="position: relative; left: 80px; top: -10px;">
			<span style="color: white;">Nr w tabeli:</span> <input type=text name=nr style="position: relative; left: 10px;"><br>
			<input type=submit name=accept value="Gotowe" style="position: relative; left: 110px; top: 15px;">
		</form>
	</div>
	<div id="menu" style="height: 42px; position: relative; top: 25px;">
		<a href="baza.php"><span class="menu_button">Powrót</span></a>
	</div>
</div>
</body>
</html>