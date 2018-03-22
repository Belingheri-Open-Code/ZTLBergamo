<! DOCTYPE html>
<html lang="it">
  <?php
  session_start();
  $_SESSION["dove"]="home";
  require("./templates/head.php"); ?>
  <!--meta http-equiv="refresh" content="10"-->
  <link rel="canonical" href="https://www.ztlbergamo.com/index.php"/>
</head>
  <body>
  	<?php require("./templates/navbar.php"); ?>
	<!--h1 onclick="location.href = 'https://ztlbergamo.com';">ZTL Attive</h1-->
  <!--/div-->
<!--/nav-->
    <div class="container-fluid">
    	<div class="row content">
    		<script>
    		var altezza=screen.height;
    		altezza=(altezza*60)/100;
    		</script>
    		<div id="map" class="col-sm-9" ></div>
        <!--style="padding-right:0 !important;padding-left:0 !important;width:100%;height:20px"-->
		    <div class="col-sm-3">
			<h1>Zone a traffico limitato <img src="https://comune.bagheria.pa.it/wp-content/uploads/2017/06/ztl-300x300.png" class="img-fluid" alt="cartello ztl" width="12%"></h1>
          <p>Queste sono le ZTL attive <b> ora</b> in Bergamo</p>
          <p>Guarda le <abbr title="zone a traffico limitato" >ZTL</abbr> presenti<a href="https://ztlbergamo.com/pages/sempreAttive.php"> Bergamo</a></p>
		  <p>Scorri la mappa e clicca sulle zone blu per vedere come si chiamano le ZTL.<br>Le zone di colore <span style="color:blue;">blu</span> sono le zone attive al momento</p>
           
        </div>
      </div>
    </div>
    
      <?php require("./templates/infomie.html"); ?>
    
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
    <?php require("./scripts/create_zones.php"); ?>
    //inserisco il codice per le icone pilomat/videocamere
    //<?php require("./scripts/videocam_pilomat.php"); ?>
    }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAwXraM3VMqwvwrOLghK8cE4-ClW0oD74s&callback=initMap"></script>
    
	<!-- ?php require("./corporate_contact.json"); ?-->
	<!--?php require("./BreadcrumbList.json"); ? -->
	
	
</html>