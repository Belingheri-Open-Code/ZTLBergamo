<?php
$url="https://www.dati.lombardia.it/resource/muag-42jz.json";
$file=file_get_contents($url);
$file=json_decode($file,true);
$i=0;

echo "<div id=\"accordion\" role=\"tablist\">";
foreach ($file as $pass){
	echo "
      <div class=\"card\">
        <div class=\"card-header\" role=\"tab\" id=\"heading$i\">
          <h5 class=\"mb-0\">
            <a data-toggle=\"collapse";
            echo ($i==0)?"\"":"d\" data-toggle=\"collapse\" ";
            echo "href=\"#collapse$i\" aria-expanded=\"";
            echo ($i==0)?"true":"false";
            echo "\" aria-controls=\"collapse$i\">".$pass['nome_ztl']."</a>
          </h5>
        </div>
        <div id=\"collapse$i\" class=\"collapse";
        echo ($i==0)?" show":"";
        echo "\" role=\"tabpanel\" aria-labelledby=\"heading$i\" data-parent=\"#accordion\">
          <div class=\"card-body\">
          <p><b>Orari zona</b><br>".$pass['dettagli']."</p>
          </div>
        </div>
      </div>";    
    
	$i++;
}
echo "</div>";
?>