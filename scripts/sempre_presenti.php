<?php

$url="https://www.dati.lombardia.it/resource/muag-42jz.json";/*$file=file_get_contents($url);*/
$fileName="../dati/data.json";
$myfile = fopen($fileName, "r") or die ("fallito");$file = fread($myfile, filesize($fileName));
$file=json_decode($file,true);
$i=0;
$color=0;
$vettcol=array("#ff7f50","#6495ed","#dc143c","#00ffff","#00008b","#008b8b","#b8860b","#a9a9a9","#006400","#a9a9a9","#bdb76b","#8b008b","#556b2f","#ff8c00","#9932cc","#8b0000","#e9967a","#8fbc8f","#483d8b","#2f4f4f","#2f4f4f","#00ced1","#9400d3","#ff1493","#00bfff","#696969","#696969","#1e90ff","#b22222","#fffaf0","#228b22","#ff00ff","#dcdcdc","#f8f8ff","#ffd700","#daa520","#808080","#008000","#adff2f","#808080","#f0fff0","#ff69b4","#cd5c5c","#4b0082","#fffff0","#f0e68c","#e6e6fa","#fff0f5","#7cfc00","#fffacd","#add8e6","#f08080","#e0ffff","#fafad2","#d3d3d3","#90ee90","#d3d3d3","#ffb6c1","#ffa07a","#20b2aa","#87cefa","#778899","#778899","#b0c4de","#ffffe0","#00ff00","#32cd32","#faf0e6","#ff00ff","#800000","#66cdaa","#0000cd","#ba55d3","#9370db","#3cb371","#7b68ee","#00fa9a","#48d1cc","#c71585","#191970","#f5fffa","#ffe4e1","#ffe4b5","#ffdead","#000080","#fdf5e6","#808000","#6b8e23","#ffa500","#ff4500","#da70d6","#eee8aa","#98fb98","#afeeee","#db7093","#ffefd5","#ffdab9","#cd853f","#ffc0cb","#dda0dd","#b0e0e6","#800080","#ff0000","#bc8f8f","#4169e1","#8b4513","#fa8072","#f4a460","#2e8b57","#fff5ee","#a0522d","#c0c0c0","#87ceeb","#6a5acd","#708090","#708090","#fffafa","#00ff7f","#4682b4","#d2b48c","#008080","#d8bfd8","#ff6347","#40e0d0","#ee82ee","#f5deb3","#ffffff","#f5f5f5","#ffff00","#9acd32");
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
			strokeColor: '".$vettcol[$color]."',
			strokeOpacity: 0.8,
			strokeWeight: 2,
			fillColor: '".$vettcol[$color]."',
			fillOpacity: 0.35
			});";
	
	echo "\nzona$i.setMap(map);";
	$color++;
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