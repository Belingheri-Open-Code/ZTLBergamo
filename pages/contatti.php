<?php
session_start();
$_SESSION["dove"]="contattami";
?>
<!DOCTYPE html>
<html lang="it">
  <?php require("../templates/head.php"); ?>
  <!--google pubblicità-->
  <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
				<script>
				  (adsbygoogle = window.adsbygoogle || []).push({
					google_ad_client: "ca-pub-7484192058927543",
					enable_page_level_ads: true
				  });
				</script>
				<!--google pubblicità-->
				<!--google reChapca-->
				<script src='https://www.google.com/recaptcha/api.js'></script>
				<!--google reChapca-->
				</head>
  <body style="background-color: #eee;">
    <?php require("../templates/navbar.php"); ?>
    <div class="container-fluid">
		<div class="row">
			<div class="col-sm-6">
			<h1>Contatti</h1>
			<?php
			if (isset($_POST["email"]))
			{
				if(isset($_POST['g-recaptcha-response'])){
					$captcha=$_POST['g-recaptcha-response'];
					if (!$captcha){
						echo "<h2 id='ris' style='color:red;'>selezione il captcha grazie</h2>";}
					else{
						$secretKey = "6LexbUsUAAAAAP4OmA0btUdwlXjWYD-_5g7l7ihA";
						$ip = $_SERVER['REMOTE_ADDR'];
						$response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip);
						$responseKeys = json_decode($response,true);
						if(intval($responseKeys["success"]) !== 1) {
						  echo '<h2 id=\'ris\' style=\'color:red;\' >You are spammer ! Get the @$%K out</h2>';
						} else {				  
							$msg = filter_var($_POST["descrizione"],FILTER_SANITIZE_SPECIAL_CHARS)." by ".$_POST["email"];
							$mess = "Ciao ".$_POST["email"]."\n Il tuo commento e' stato salvato correttamente.";
							$mail_headers = "From: ZTL bergamo <info@ztlbergamo.com>\r\n";
							$mail_headers .= "Reply-To: info@ztlbergamo.com\r\n";
							$mail_headers .= "X-Mailer: PHP/" . phpversion();
							if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
								echo "<h2 id='ris' style='color:red;'>Inserisci una mail valida </h2>";}
							else{
								if (mail($_POST["email"],"ZTL bergamo",$mess,$mail_headers)&& mail("riccardo.beli99@gmail.com","ZTL BERGAMO",$msg))
								{
									echo "<h2 id='ris' style='color:green;'>La tua richesta &eacute; andata a buon fine </h2><br><p ><b>Antemprima messaggio:</b><br> $msg</p>";
									
								}else{
									echo "<h2 id='ris' style='color:red;'>Si &eacute; riscontrato un problema </h2>";
								}
							}
						}
					}
				}else{
					echo "<h2 id='ris' style='color:red;'>selezione il captcha grazie</h2>";
				}
				
			}
			?>
				<form action="" method="post">
				  <div class="form-group">
					<label for="email">Indirizzo email :</label>
					<input type="email" class="form-control" placeholder='indirizzo email' name="email" required>
				  </div>
				  <div class="form-group">
					<label for="comment">Commenti:</label>
					<textarea style="resize:none;" rows="3" cols="50" onkeyup="dec()" class='form-control'  placeholder='descrizione' name='descrizione' id="comm"  maxlength="255" required></textarea>
					<small id="frase">Ti sono rimasti 255 caratteri</small>
				  </div>
				  <div id="obblicoClick">
				  <!--google reChapca-->
					<div  class="g-recaptcha" data-theme="dark"  data-sitekey="6LexbUsUAAAAAP7_OE_doag7Fv2_UT_sU6JVeJHG" data-callback="onSuccess" ></div>
					<!--google reChapca-->
				  </div>
				  <button id="buttonForm" type="submit" class="btn btn-default" disabled >Invia</button>
				</form>
			</div>
			<div class="col-sm-6"> 
				<p>Se preferisci scrivimi direttamente una mail <strong>info@ztlbergamo.com</strong></p>
				<hr>
				<script type="text/javascript" src="https://platform.linkedin.com/badges/js/profile.js" async defer></script>
				<div class="LI-profile-badge"  data-version="v1" data-size="medium" data-locale="it_IT" data-type="vertical" data-theme="dark" data-vanity="riccardo-belingheri-a57809155"><a class="LI-simple-link" href='https://it.linkedin.com/in/riccardo-belingheri-a57809155?trk=profile-badge'>Riccardo Belingheri</a></div>
			</div>
		</div>
	</div>
    <?php require("../templates/infomie.html"); ?>
	<script>
						function dec(){
							var str = document.getElementById("comm").value;
							var x = 255-str.length;
							document.getElementById("frase").innerHTML = "Ti sono rimasti: " + x + " caratteri";
						}
						window.setTimeout(function(){
							$("#ris").fadeTo(500,0).slideUp(500,function(){
								$(this).remove();
							});
						},4000);
						function onSuccess() {
							document.getElementById("buttonForm").disabled = false;
						}
					</script>
  </body>
</html>