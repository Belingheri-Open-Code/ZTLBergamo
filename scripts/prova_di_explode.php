<?php
$url="http://www.football-data.org/v1/fixtures?league=SA&timeFrame=p1";
$file=file_get_contents($url);
$file=json_decode($file,true);
foreach ($file['fixtures'] as $item){
	$str=explode("T",$item['date']);
	$s=explode(":",$str[1]);
	echo $s[0]." ".$s[1]." ";
	$str=$s[0]+($s[1]/100);
	$n=$s[1]+30;
	if ($n>=60)
	{
		$n-=60;
		$s[0]++;
	}
	$st=$s[0]+($n/100);
	echo $item['homeTeamName']." ".$str." ".($str-2.00)." ".$st."</br>";
}
?>