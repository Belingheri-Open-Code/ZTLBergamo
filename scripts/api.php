<?php
$p= explode ("all","tutto l'anno la domenica ed i festivi dalle 10 allle 12 e dalle 14 alle 19. 2");
		$today=date();
		$test=$today["hours"];
		if(($test>($p[1]*1&&$test<($p[2]*1))||($test>($p[3]*1)&&$test<($p[4]*1)))
				echo  "true";
			else
				echo "false";
?>