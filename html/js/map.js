/*START GOOGLE MAP*/
function initMap() {
	// Styles a map in night mode.
	var map = new google.maps.Map(document.getElementById('map'), {
		center: {
			lat: 50.006203,
			lng: 36.229171
		},
		zoom: 16,
		styles: [{
			"featureType": "all",
			"elementType": "geometry.fill",
			"stylers": [{
				"weight": "2.00"
			}]
		}, {
			"featureType": "all",
			"elementType": "geometry.stroke",
			"stylers": [{
				"color": "#ff5b0a"
			}]
		}, {
			"featureType": "all",
			"elementType": "labels.text",
			"stylers": [{
				"visibility": "on"
			}]
		}, {
			"featureType": "landscape",
			"elementType": "all",
			"stylers": [{
				"color": "#ff5b0a"
			}]
		}, {
			"featureType": "landscape",
			"elementType": "geometry.fill",
			"stylers": [{
				"color": "#000000"
			}]
		}, {
			"featureType": "landscape.man_made",
			"elementType": "geometry.fill",
			"stylers": [{
				"color": "#000000"
			}]
		}, {
			"featureType": "poi",
			"elementType": "all",
			"stylers": [{
				"visibility": "off"
			}]
		}, {
			"featureType": "road",
			"elementType": "all",
			"stylers": [{
				"saturation": -100
			}, {
				"lightness": 45
			}]
		}, {
			"featureType": "road",
			"elementType": "geometry.fill",
			"stylers": [{
				"color": "#ff5b0a"
			}]
		}, {
			"featureType": "road",
			"elementType": "labels.text.fill",
			"stylers": [{
				"color": "#ff5b0a"
			}]
		}, {
			"featureType": "road",
			"elementType": "labels.text.stroke",
			"stylers": [{
				"color": "#000000"
			}]
		}, {
			"featureType": "road.highway",
			"elementType": "all",
			"stylers": [{
				"visibility": "simplified"
			}]
		}, {
			"featureType": "road.arterial",
			"elementType": "labels.icon",
			"stylers": [{
				"visibility": "off"
			}]
		}, {
			"featureType": "transit",
			"elementType": "all",
			"stylers": [{
				"visibility": "off"
			}]
		}, {
			"featureType": "water",
			"elementType": "all",
			"stylers": [{
				"color": "#46bcec"
			}, {
				"visibility": "on"
			}]
		}, {
			"featureType": "water",
			"elementType": "geometry.fill",
			"stylers": [{
				"color": "#ff5b0a"
			}]
		}, {
			"featureType": "water",
			"elementType": "labels.text.fill",
			"stylers": [{
				"color": "#070707"
			}]
		}, {
			"featureType": "water",
			"elementType": "labels.text.stroke",
			"stylers": [{
				"color": "#000000"
			}]
		}]
	});
	var marker = new google.maps.Marker({
		position: {
			lat: 50.006203,
			lng: 36.229171
		},
		map: map,
		//icon:   'img/marker.png'
	});
}
initMap();
/*END GOOGLE MAP*/
//$black: #000000;
//$orange: #ff5b0a;
