<style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
  p{
    font-size: 13pt;
  }
  </style>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="https://ztlbergamo.com">ZTL Bergamo</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li <?php if($_SESSION["dove"]=="home") echo "class='active'";?>><a href="https://ztlbergamo.com">Attive ora</a></li>
      <li <?php if($_SESSION["dove"]=="sempreAttive") echo "class='active'";?>><a href="https://ztlbergamo.com/pages/sempreAttive.php">Presenti in Bergamo</a></li>
      <li <?php if($_SESSION["dove"]=="aboutMe") echo "class='active'";?>><a href="#">About me</a></li>
	  <li <?php if($_SESSION["dove"]=="descrizione") echo "class='active'";?>><a href="https://ztlbergamo.com/pages/descrizione.php">Cosa sono le ZTL?</a></li>
	  <li <?php if($_SESSION["dove"]=="contattami") echo "class='active'";?>><a href="https://ztlbergamo.com/pages/contatti.php">Contatti</a></li>
      <li><a  class="btn navbar-btn" style="padding-top: 0; padding-bottom: 0" href="https://paypal.me/pools/c/80pvKCHp3F" target="_blank"><img src="https://ztlbergamo.com/dati/paypal-donazione.png" width="100"></a></li>
      </ul>
    </div>
  </div>
</nav>
<!--nav class="navbar navbar-inverse" style="    margin-bottom: 0">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="https://ztlbergamo.com">ZTL Bergamo</a>
    </div>
    <ul class="nav navbar-nav">
      <li <?php  //if($_SESSION["dove"]=="home") echo "class='active'";?>><a href="https://ztlbergamo.com">Attive ora</a></li>
      <li <?php  //if($_SESSION["dove"]=="sempreAttive") echo "class='active'";?>><a href="https://ztlbergamo.com/pages/sempreAttive.php">Presenti in Bergamo</a></li>
      <li <?php  //if($_SESSION["dove"]=="aboutMe") echo "class='active'";?>><a href="#">About me</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
    	<a  class="btn navbar-btn" href="https://paypal.me/pools/c/80pvKCHp3F" target="_blank"><img src="https://ztlbergamo.com/dati/paypal-donazione.png" width="110"></a>
	</ul>
  </div>
</nav-->