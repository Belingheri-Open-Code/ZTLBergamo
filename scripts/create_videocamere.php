<?php
$url="https://www.dati.lombardia.it/resource/4ik7-d4js.json";
$file=file_get_contents($url);
$file=json_decode($file,true);
foreach ($file as $singolo)
{
	echo $singolo['ztl']."</br>";
}
?>