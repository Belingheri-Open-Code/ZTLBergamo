<?php
$url="https://www.dati.lombardia.it/resource/muag-42jz.json";/*$file=file_get_contents($url);*/
$fileName="../dati/data.json";
$myfile = fopen($fileName, "r") or die ("fallito");$file = fread($myfile, filesize($fileName));
$file=json_decode($file,true);
$i=0;
echo "var precInfoWindow;\n\n";
foreach ($file as $pass){
	foreach ($pass['the_geom']['coordinates'][0] as $zona){
		//creo le coordinate della zona
		echo "var zonaCoords$i=[\n";
		foreach ($zona as $coords){
		  $lo=$coords[0];
		  $la=$coords[1];
		  echo "{lat: $la, lng:$lo},\n";
	  }
	echo "];";
	
	//creo il poligono a partire dalle coordinate precedentemente create
	echo "\nvar zona$i=new google.maps.Polygon({
			paths: zonaCoords$i,
			strokeColor: '#0000FF',
			strokeOpacity: 0.8,
			strokeWeight: 2,
			fillColor: '#0000FF',
			fillOpacity: 0.35
			});";
	
	echo "\nzona$i.setMap(map);";
	
	//CONTROLLO - la zona colli deve essere sotto la zona di città alta
	if($pass['nome_ztl']=="COLLI")
		echo "\nzona$i.set('zIndex',-1);";
	echo "\nvar contentString = \"<div id='content'>\"+
			\"<div id='siteNotice'>\"+
			\"</div id='bodyContent'>\"+
			\"<h2 id='firstHeading' class='firstHeading'>\"+";
	$str=explode("- ",$pass['nome_ztl']);
			foreach ($str as $io)
				echo "\n\"".$io."</br>\"+";
	echo "\"</h2>\"+
			\"<div>\"+
			\"<p>".$pass['dettagli']."</p>\"+
			\"</div>\"+
			\"</div>\";";
	
	//creo una infowindow
	echo "\nvar infowindow$i = new google.maps.InfoWindow({
			  content: contentString
			});";
	echo "\ngoogle.maps.event.addListener(zona$i,'click',function(event){
			if(precInfoWindow!=null)
				precInfoWindow.close();
			infowindow$i.setPosition(event.latLng);
			infowindow$i.open(map,zona$i);
			precInfoWindow=infowindow$i;});\n\n";
	$i++;
	}
}
?>