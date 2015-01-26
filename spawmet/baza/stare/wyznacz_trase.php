<html>
<head>
	<link rel="Stylesheet" type="text/css" href="../style.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<script type="text/javascript" src="options.js"></script>
	<title>Wyznacz trasę</title>
	<script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
</head>
<body onLoad="mapaStart()">
<div class="baza_bg">
	<?php
		include 'klasy/Create.php';
		Create::backButton('menu.php');
	?>
	<h1 style="text-align: center;">WYZNACZ TRASĘ</h1>
	<!--<div id="menu">
		<a href="dodaj_zestaw.php?lastPage=zestawy_czesci.php"><span class="menu_button">Dodaj</span></a>
		<a href="usun_po_nazwie.php"><span class="menu_button">Usuń po nazwie</span></a>
		<a href="usun_po_numerze.php"><span class="menu_button">Usuń po numerze</span></a>
		<a href="modyfikuj_po_nazwie.php"><span class="menu_button">Modyfikuj po nazwie</span></a>
		<a href="modyfikuj_po_numerze.php"><span class="menu_button">Modyfikuj po numerze</span></a>
		<a href="sortuj.php" style="position: relative; top: 25px;"><span class="menu_button">Wyświetl posortowane</span></a>
	</div>-->
	<script text="text/javascript">
		/*var map;
		
		var directionsDisplay;
		var directionsService = new google.maps.DirectionService();
		
		function mapStart() {
			directionsDisplay = new google.maps.DirectionsRenderer();
			var coordinates = new google.maps.LatLng(53.2583333, 17.1511173);
			var mapOptions = {
				zoom: 13,
				center: coordinates,
				mapTypeId: google.maps.MapTypeId.ROADMAP
			};
			map = new google.maps.Map(document.getElementById("map"), mapOptions);
			directionsDisplay.setMap(map);
			obliczDroge("św. Walentego 19, 89-320 Wysoka, wielkopolskie", "Wyrzysk, wielkopolskie");
		}
		
		function obliczDroge(poczatek, koniec) {
			var waypts = [];
			waypts.push({
				location: "Falmierowo, wielkopolskie",
				stopover: true
			});
			waypts.push({
				location: "Kijaszkowo, wielkopolskie",
				stopover: true
			});
			
			var request = {
				origin: poczatek,
				destination: koniec,
				travelMode: google.maps.TravelMode.DRIVING,
				waypoints: waypts,
				optimizeWaypoints: true
			}; //DirectionsRequest object
			directionsService.route(request, function(response, status) {
				if(status == google.maps.DirectionsStatus.OK) {
					directionsDisplay.setDirections(response);
				} else {
					alert('Obliczenie trasy nie powiodło się. Kod błędu: ' + status);
				}
			});
		}
		
		function addOriginAndDestinationBlocks() {
			document.write("<div>");
			var origin = document.createElement("INPUT");
			origin.id = "origin"
			origin.value = "Z";
			var textBlocks = document.getElementById("text_blocks");
			textBlocks.appendChild(origin);
			document.write("</div>");
			document.write('<div style="margin-top: 10px;">');
			var destination = document.createElement("INPUT");
			destination.id = "destination";
			destination.value = "Do";
			textBlocks.appendChild(destination);
			document.write("</div>");
		}
		
		function addWaypoint() {
			var waypt = document.createElement("INPUT");
			waypt.className = "waypoints";
			//waypt.value = "Przez";
			var wayptsBlocks = document.getElementById("waypts_blocks");
			wayptsBlocks.innerHTML += '<div style="margin-top: 10px;">';
			wayptsBlocks.appendChild(waypt);
			wayptsBlocks.innerHTML += '</div>';
			//document.write("<br />");
		}
		
		function removeWaypoint() {
			var wayptsBlocks = document.getElementById("waypts_blocks");
			wayptsBlocks.removeChild(wayptsBlocks.lastChild);
			wayptsBlocks.removeChild(wayptsBlocks.lastChild);
		}
		
		function findRoute() {
			var org = document.getElementById("origin").value;
			var dest = document.getElementById("destination").value;
			
			var waypts = document.getElementsByClassName("waypoints");
			var through = [];
			for(var i = 0; i < waypts.length; i++) {
				through.push({
					location: waypts[i].value,
					stopover: true
				});
			}
			
			var request = {
				origin: org,
				destination: dest,
				travelMode: google.maps.TravelMode.DRIVING,
				waypoints: through,
				optimizeWaypoints: true
			};

			directionsService.route(request, function(response, status) {
				if(status == google.maps.DirectionsStatus.OK) {
					directionsDisplay.setDirections(response);
				} else {
					alert("Błąd! Kod błędu: " + status);
				}
			});
		}
		
		function foo() {
			document.write("chuuuj");
		}*/
		var mapa;
			var geocoder;
			
			var directionsDisplay;
			var directionsService = new google.maps.DirectionsService();
			
			/*function dodajMarker(lat, lon, opcjeMarkera) {
				opcjeMarkera.position = new google.maps.LatLng(lat, lon);
				opcjeMarkera.map = mapa;
				var marker = new google.maps.Marker(opcjeMarkera);
			}*/
			
			function dodajMarker(posLatLng, opcjeMarkera) {
				opcjeMarkera.position = posLatLng;
				opcjeMarkera.map = mapa;
				var marker = new google.maps.Marker(opcjeMarkera);
			}
			
			function mapaStart() {
				geocoder = new google.maps.Geocoder();
				directionsDisplay = new google.maps.DirectionsRenderer();
				var wspolrzedne = new google.maps.LatLng(53.2583333, 17.1511173);
				var opcjeMapy = {
					zoom: 13,
					center: wspolrzedne,
					mapTypeId: google.maps.MapTypeId.ROADMAP
				}
				mapa = new google.maps.Map(document.getElementById("map"), opcjeMapy);
				directionsDisplay.setMap(mapa);
				//dodajMarker(53.2583333, 17.1511173, { title: "Marker!" });
				//dodajMarker(new google.maps.LatLng(53.2583333, 17.1511173), { title: "Marker!" });
				//kodujAdres("Wyrzysk, wielkopolskie");
				//kodujAdres("św. Walentego 19, 89-320 Wysoka, wielkopolskie");
				obliczDroge("św. Walentego 19, 89-320 Wysoka, wielkopolskie", "Wyrzysk, wielkopolskie"); //string or LatLng
				//rozważ opcję zwracania LatLng przez funkcję kodujAdres()
			}
			
			//adres - string z adresem miejsca do geokodowania - uzyskania współrzędnych
			function kodujAdres(adres) {
				geocoder.geocode( { 'address': adres }, function(results, status) {
					if(status == google.maps.GeocoderStatus.OK) {
						//mapa.setCenter(results[0].geometry.location);
						//dodajMarker(results[0].geometry.location, { title: "Marker2!" });
						dodajMarker(results[0].geometry.location, { title: results[0].formatted_address });
						//dodajMarker(results[0].geometry.location, { title: results[0].address_components[0].short_name });
						//return results[0].geometry.location;
					} else {
						alert('Geocode was not successful for the following reason: ' + status);
					}
				});
			}
			
			function obliczDroge(poczatek, koniec) {
				var waypts = [];
				waypts.push({
					location: "Falmierowo, wielkopolskie",
					stopover: true
				});
				waypts.push({
					location: "Kijaszkowo, wielkopolskie",
					stopover: true
				});
				
				var request = {
					origin: poczatek,
					destination: koniec,
					travelMode: google.maps.TravelMode.DRIVING,
					waypoints: waypts,
					optimizeWaypoints: true
				}; //DirectionsRequest object
				directionsService.route(request, function(response, status) {
					if(status == google.maps.DirectionsStatus.OK) {
						directionsDisplay.setDirections(response);
					} else {
						alert('Obliczenie trasy nie powiodło się. Kod błędu: ' + status);
					}
				});
			}
			
			function addOriginAndDestinationBlocks() {
				var origin = document.createElement("INPUT");
				origin.id = "origin"
				origin.value = "Z";
				var textBlocks = document.getElementById("text_blocks");
				textBlocks.appendChild(origin);
				
				document.write("<br /><br />");
				
				var destination = document.createElement("INPUT");
				destination.id = "destination";
				destination.value = "Do";
				textBlocks.appendChild(destination);
			}
			
			function addWaypoint() {
				var waypt = document.createElement("INPUT");
				waypt.className = "waypoints";
				waypt.value = "Przez";
				
				var wayptsBlocks = document.getElementById("waypts_blocks");
				wayptsBlocks.appendChild(waypt);
				wayptsBlocks.innerHTML += "<br /><br />";
			}
			
			function removeWaypoint() {
				var wayptsBlocks = document.getElementById("waypts_blocks");
				wayptsBlocks.removeChild(wayptsBlocks.lastChild);
			}
			
			function showRoute() {
				var poczatek = document.getElementById("origin").value;
				var koniec = document.getElementById("destination").value;
				
				var waypts = document.getElementsByClassName("waypoints");
				var przez = [];
				for(var i = 0; i < waypts.length; i++) {
					przez.push({
						location: waypts[i].value,
						stopover: true
					});
				}
				
				var request = {
					origin: poczatek,
					destination: koniec,
					travelMode: google.maps.TravelMode.DRIVING,
					waypoints: przez,
					optimizeWaypoints: true
				};
				
				directionsService.route(request, function(response, status) {
					if(status == google.maps.DirectionsStatus.OK) {
						directionsDisplay.setDirections(response);
					} else {
						alert("Błąd! Kod błędu: " + status);
					}
				});
			}
			//mapaStart() -> mapStart(); showRoute() -> findRoute(); div id mapka -> map
	</script>
	<div id="map" style="width: 700px; height: 500px; border: 1px solid black; background: gray; margin-left: auto; margin-right: auto;">
	</div>
	<div style="margin-top: 15px;">
	<?php
		include 'klasy/Table.php';
		
		$z = new Table('
			SELECT zamowienia.id_zamowienie AS "id", klienci.nazwa AS "Klient", maszyny.nazwa AS "Maszyna",
			klienci.ulica as "Ulica", klienci.miejscowosc AS "Miejscowość", klienci.kod_pocztowy AS "Kod pocztowy", klienci.wojewodztwo as "Województwo"
			FROM (klienci INNER JOIN zamowienia ON klienci.id_klient = zamowienia.klient)
				  INNER JOIN maszyny ON maszyny.id_maszyna = zamowienia.maszyna
			
		');
		//WHERE zamowienia.status = "Zakończone"
		$z->showTableWithoutOptions();
		$z->close();
	?>
	</div>
	<div id="text_blocks" style="margin-top: 20px; margin-left: auto; margin-right: auto; font-family: Arial; color: white;">
		<script type="text/javascript">
			addOriginAndDestinationBlocks();
		</script>
		<p>Przez:</p>
		<div id="waypts_blocks">
		
		</div>
		<div style="display: inline-flex; margin-top: 10px;">
			<!--<div onclick="addWaypoint()" id="add_box_btn" style="width: 30px; height: 30px; background-color: black;">+</div>
			<div onclick="removeWaypoint()" id="delete_box_btn" style="width: 30px; height: 30px; background-color: black; margin-left: 10px;">-</div>-->
			<div onclick="addWaypoint()" id="add_box_btn" class="trace_btns">
				<span style="position: relative; top: 9px;">+</span>
			</div>
			<div onclick="removeWaypoint()" id="delete_box_btn" class="trace_btns" style="margin-left: 20px;">
				<span style="position: relative; top: 9px;">-</span>
			</div>
		</div>
		<div style="margin-top: 15px">
			<input onclick="showRoute()" type=button value="Wyznacz">
		</div>
	</div>
</div>
</body>
</html>