<?php
$urlpil="https://www.dati.lombardia.it/resource/4ik7-d4js.json";
$pil=file_get_contents($urlpil);
$pil=json_decode($pil,true);
$in==0;
foreach ($pil as $singolo)
{
	
	$lo= $singolo['localizzazione']['coordinates'][0];
	$la=$singolo['localizzazione']['coordinates'][1];
	$tipo=$singolo['tipo'];
	echo " var image=\"./dati/$tipo.png\";
		var myCenter$in = new google.maps.LatLng($la,$lo);
		var marker$in = new google.maps.Marker({
		position: myCenter$in,
		icon: image
		});
		marker$in.setMap(map);";
		//contenuto msg
	echo "\nvar contentString = \"<div id='content'>\"+
			\"<div id='siteNotice'>\"+
			\"</div id='bodyContent'>\"+
			\"<h2 id='firstHeading' class='firstHeading'>\"+";
	echo "\n\"".$tipo."</br>\"+";
	echo "\"</h2>\"+
			\"<div>\"+
			\"<p>".$singolo['via']."</p>\"+
			\"</div>\"+
			\"</div>\";";
	//pannello
	echo "\nvar infowindowMarker$in = new google.maps.InfoWindow({
			  content: contentString
			});";
	echo "\ngoogle.maps.event.addListener(marker$in,'click',function(event){
			if(precInfoWindow!=null)
				precInfoWindow.close();
			infowindowMarker$in.setPosition(event.latLng);
			infowindowMarker$in.open(map,marker$in);
			precInfoWindow=infowindowMarker$in;});\n\n";
	//<img src="../dati/Pilomat.png" alt="Pilomat" height="42" width="42">
	$in++;
	
}

/*
	var myCenter2 = new google.maps.LatLng(lat-0.005,lon);
  var marker = new google.maps.Marker({
    position: myCenter,
    icon: image
    });
    marker.setMap(map);
  
    marker2.setMap(map);*/
?>
