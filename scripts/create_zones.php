<?php
function festivo()
{
	$url="./../pages/feste.json";
	$file=file_get_contents($url);
	$file=json_decode($file,true);
	$i=0;
	foreach($file as $dat){
		if ($dat["Data"]==date("d.m.Y")) 
			return true;
	}
	return false;
}
function colli($dettagli,$today)
{
	
	$dettagli = explode("-",$dettagli);
	array_shift($dettagli);
	/* work in progress
	//1
	if (festivo() or today["wday"]==0)
	{
		$p= explode ("all",$dettagli[1]);
		$test=$today["hours"];
		if(($test>($p[1]*1&&$test<($p[2]*1))||($test>($p[3]*1)&&$test<($p[4]*1)))
				return true;
			else
				return false;
	}*/
	return true;
}

function stadio($today,$tipo)
{
	$url="http://www.football-data.org/v1/fixtures?league=SA&timeFrame=p1";
	$file=file_get_contents($url);
	$file=json_decode($file,true);
	foreach ($file['fixtures'] as $item){
		if ($item['homeTeamName']=="Atalanta BC")
		{
			$test=($today["hours"])+($today["minutes"]/100);
			$str=explode("T",$item['date']);
			$s=explode(":",$str[1]);
			$oraInizio=$s[0]+($s[1]/100);
			$n=$s[1]+30;
			if ($n>=60)
			{
				$n-=60;
				$s[0]++;
			}
			$fineZtl=$s[0]+($n/100);
			//echo $item['homeTeamName']." ".$oraInizio." ".($oraInizio-2.00)." ".$fineZtl."</br>";
			if($tipo==1){//stadio
			if($test>($oraInizio-2.00)&&$test<$fineZtl)
				return true;
			}else if (tipo==2)//finardi
			{
				if($test>($oraInizio-2.00)&&$test<$oraInizio)
				return true;
			}
			return false;
		}
	}
	return false;
}
function viewOrari($pass) {
	$today = getdate();
	/*
	"seconds" - secondi
	"minutes" - minuti
	"hours" - ore
	"mday" - giorno del mese
	"wday" - giorno della settimana, numerico : da 0 come Domenica a 6 come Sabato
	"mon" - mese, numerico
	"year" - anno, numerico
	"yday" - giorno dell'anno, numerico; i.e. "299"
	"weekday" - giorno della settimana, testuale, per intero; i.e. "Friday"
	"month" - mese, testuale, per intero; i.e. "January"
	*/
    if($pass['periodo']=="Permanente")
	{
		$test=($today["hours"])+($today["minutes"]/100);
		if($pass['nome_ztl']!="VICOLO SAN LAZZARO"){
			$t=explode("dalle",$pass['dettagli']);
			$t=explode("alle",$t[1]);
			//echo "\n da: $t[0] alle: $t[1]";
			if($test<$t[0]||$test>$t[1])
				return false;
			else
				return true;
		}
		else{
			$t=explode("dalle",$pass['dettagli']);
			$p=explode("alle",$t[1]);
			$s=explode("alle",$t[2]);
			//echo $test."".$p[0]." ".($p[1]*1)." ".$s[0]." ".($s[1]*1);
			if(($test>$p[0]&&$test<($p[1]*1))||($test>$s[0]&&$test<($s[1]*1)))
				return true;
			else
				return false;
		}	
	}
	else if($pass['periodo']=="Notturna")
	{
		$test=($today["hours"])+($today["minutes"]/100);
		$t=explode("dalle",$pass['dettagli']);
		$t=explode("alle",$t[1]);
		//echo "\n da: $t[0] alle: $t[1]  ".$test;
		if($test<$t[1]||$test>$t[0])
		{
			//echo "verr";
			return true;
		}
		else
			return false;
	}
	else if($pass['periodo']=="Scolastica")
	{
		if($today["wday"]<1||$today["wday"]>5)
			return false;
		else
		{
			$test=($today["hours"])+($today["minutes"]/100);
			$str=explode(":",$pass['dettagli']);
			$s=explode("dal lun",$str[1]);
			$str=explode("dalle",$s[0]);
			foreach($str as $item)
			{
				if($item!=" "){
					$s=explode("alle",$item);
					if(($test>($s[0]*1))&&($test<($s[1])*1))
						return true;
				}
			}
			return false;
		}
	}
	else if($pass['periodo']=="Pedonale")
	{
		return true;
	}
	else if($pass['periodo']=="Temporale")
	{
		if($pass['nome_ztl']=="STADIO")
			return stadio($today,1);
		else if($pass['nome_ztl']=="FINARDI")
			return stadio($today,2);
		return true;
	}
	else if($pass['periodo']=="Annuale")
	{
		return colli($pass['dettagli'],$today);
	}
}


$url="https://www.dati.lombardia.it/resource/muag-42jz.json";
$file=file_get_contents($url);
$file=json_decode($file,true);
$i=0;
$urlpil="https://www.dati.lombardia.it/resource/4ik7-d4js.json";
$pil=file_get_contents($urlpil);
$pil=json_decode($pil,true);
echo "var precInfoWindow;\n\n";
$in=0;
$color=0;
$vettcol=array("#d2691e","#ff7f50","#6495ed","#dc143c","#00ffff","#00008b","#008b8b","#b8860b","#a9a9a9","#006400","#a9a9a9","#bdb76b","#8b008b","#556b2f","#ff8c00","#9932cc","#8b0000","#e9967a","#8fbc8f","#483d8b","#2f4f4f","#2f4f4f","#00ced1","#9400d3","#ff1493","#00bfff","#696969","#696969","#1e90ff","#b22222","#fffaf0","#228b22","#ff00ff","#dcdcdc","#f8f8ff","#ffd700","#daa520","#808080","#008000","#adff2f","#808080","#f0fff0","#ff69b4","#cd5c5c","#4b0082","#fffff0","#f0e68c","#e6e6fa","#fff0f5","#7cfc00","#fffacd","#add8e6","#f08080","#e0ffff","#fafad2","#d3d3d3","#90ee90","#d3d3d3","#ffb6c1","#ffa07a","#20b2aa","#87cefa","#778899","#778899","#b0c4de","#ffffe0","#00ff00","#32cd32","#faf0e6","#ff00ff","#800000","#66cdaa","#0000cd","#ba55d3","#9370db","#3cb371","#7b68ee","#00fa9a","#48d1cc","#c71585","#191970","#f5fffa","#ffe4e1","#ffe4b5","#ffdead","#000080","#fdf5e6","#808000","#6b8e23","#ffa500","#ff4500","#da70d6","#eee8aa","#98fb98","#afeeee","#db7093","#ffefd5","#ffdab9","#cd853f","#ffc0cb","#dda0dd","#b0e0e6","#800080","#ff0000","#bc8f8f","#4169e1","#8b4513","#fa8072","#f4a460","#2e8b57","#fff5ee","#a0522d","#c0c0c0","#87ceeb","#6a5acd","#708090","#708090","#fffafa","#00ff7f","#4682b4","#d2b48c","#008080","#d8bfd8","#ff6347","#40e0d0","#ee82ee","#f5deb3","#ffffff","#f5f5f5","#ffff00","#9acd32");
foreach ($file as $pass){
	if(viewOrari($pass)){
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
		$color++;
		if(viewOrari($pass)){
			echo "\nzona$i.setMap(map);";
			//
			$vin=$pass['nome_ztl'];
			foreach ($pil as $singolo)
			{
				$pre=$singolo['ztl'];
				//echo $vin;
				//echo $pre;
				if($pre==$vin){
				//echo "alert('".$pre." - ".$vin."');";
					
				
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
				
			}
			//
		}
		/*else
			echo "alert(\"".$pass['nome_ztl']." disattiva ora\");";*/
			
		//aggiungi la zona alla mappa
		//echo "\nzona$i.setMap(map);";
		
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
	
}
?>