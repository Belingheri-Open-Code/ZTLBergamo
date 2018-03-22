<?php
$url="https://www.dati.lombardia.it/resource/4ik7-d4js.json";
$file=file_get_contents($url);
$file=json_decode($file,true);
//$i=0;
foreach ($file as $singolo)
{
	$lo= $singolo['localizzazione']['coordinates'][0];
	$la=$singolo['localizzazione']['coordinates'][1];
	$tipo=$singolo['tipo'];
	echo " var image=\"../dati/$tipo.png\";
		var myCenter$i = new google.maps.LatLng($la,$lo);
		var marker$i = new google.maps.Marker({
		position: myCenter$i,
		icon: image
		});
		marker$i.setMap(map);";
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
	echo "\nvar infowindowMarker$i = new google.maps.InfoWindow({
			  content: contentString
			});";
	echo "\ngoogle.maps.event.addListener(marker$i,'click',function(event){
			if(precInfoWindow!=null)
				precInfoWindow.close();
			infowindowMarker$i.setPosition(event.latLng);
			infowindowMarker$i.open(map,marker$i);
			precInfoWindow=infowindowMarker$i;});\n\n";
	//<img src="../dati/Pilomat.png" alt="Pilomat" height="42" width="42">
	$i++;
	
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
