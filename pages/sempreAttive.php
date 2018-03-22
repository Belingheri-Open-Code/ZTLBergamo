<! DOCTYPE html>
<?php
session_start();
$_SESSION["dove"]="sempreAttive";
?>
<html lang="it">

  <?php require("../templates/head.php"); ?>

  <!--meta http-equiv="refresh" content="10"-->

</head>
  <body>

    <?php require("../templates/navbar.php"); ?>

  <!--h1 onclick="location.href = 'https://ztlbergamo.com';">ZTL in Bergamo</h1-->

    <div class="container-fluid">

      <div class="row">

    <script>

    var altezza=screen.height;

    //alert(altezza);

    altezza=(altezza*60)/100;

    //alert(altezza);

    </script>

        <div id="map" class="col-sm-9"></div>
        <div class="col-sm-3">
        <p>Queste sono le ZTL <b>totali</b> in Bergamo</p>

    <p>Guarda le <abbr title="zone a traffico limitato" >ZTL</abbr> presenti <a href="https://ztlbergamo.com/pages/sempreAttive.php"> <b> ora </b></a></p>

  
</div>

  </div>

    </div>
    <?php require("../templates/infomie.html"); ?>
  </body>

  <script>

    document.getElementById("map").style.height= altezza;

    function initMap() {

        var Centro = {lat: 45.7029340, lng: 9.6597030};

        var map = new google.maps.Map(document.getElementById('map'), {

          zoom: 13,

          //mapTypeId: 'hybrid',

          center: Centro

        });

    google.maps.event.addListener(map,'click',function(event){

    if(precInfoWindow!=null)

      precInfoWindow.close();

  });

    

  //inserisco il codice che crea i poligoni(zone), li inserisce nella mappa e crea i rispettivi infobox.

    <?php require("../scripts/sempre_presenti.php"); ?>

    //inserisco il codice per le icone pilomat/videocamere

    <?php require("../scripts/static_videoPilomaaat.php"); ?>

    }

    </script>

    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAwXraM3VMqwvwrOLghK8cE4-ClW0oD74s&callback=initMap"></script>

  

  

</html>