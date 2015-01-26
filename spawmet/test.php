<html>
<head>
<style type="text/css" media="screen">
	#moje_menu {
		background-color: red;
		width: 200px;
	}
	#moje_menu li {
		list-style: none;
	}
	#moje_menu #opcje {
		visibility: hidden;
	}
</style>
<script type="text/javascript">
	function show(objId) {
		document.getElementById(objId).style.visibility = 'visible';
	}
</script>
</head>
<body>
	<div id="moje_menu">
		<ul id="naglowek" onclick="show('opcje')">
			<li>Naglowek</li>
		</ul>
		<ul id="opcje">
			<li>opcja 1</li>
			<li>opcja 2</li>
		</ul>
	</div>
</body>
</html>