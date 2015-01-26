var mapa;
	
var directionsDisplay;
var directionsService = new google.maps.DirectionsService();
	
function mapaStart() {
	directionsDisplay = new google.maps.DirectionsRenderer();
	var wspolrzedne = new google.maps.LatLng(53.2583333, 17.1511173);
	var opcjeMapy = {
		zoom: 13,
		center: wspolrzedne,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	}
	mapa = new google.maps.Map(document.getElementById("map"), opcjeMapy);
	directionsDisplay.setMap(mapa);
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