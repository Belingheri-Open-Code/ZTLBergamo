<html>
	<?php require("../templates/head.php"); ?>
    <body>
    	<?php require("../templates/navbar.php"); ?>
        <div class="container-fluid">
        	<h1>INFO</h1>
			<?php
			
				$file=file_get_contents("https://territorio.comune.bergamo.it/ZTL/2");
				$doc = new DOMDocument();
				@$doc->loadHTML($file);
				
				//la prima tabella
				$table=$doc->getElementsByTagName('table')->item(0);
				$i=0;
				
				echo "<table class='table'><thead><tr>";
				//la prima row (intestazione)
				$trow=$table->getElementsByTagName('tr')->item(0);
				foreach($trow->getElementsByTagName('th') as $th)
				{
					echo "<th>$th->nodeValue</th>";
				}
				echo "</tr></thead><tbody>";
				foreach($table->getElementsByTagName('tr') as $row)
				{
					echo "<tr>";
					//la prima è intestazione
					if($i>0)
					{
						foreach($row->getElementsByTagName('td') as $td)
						{
							echo "<td>$td->nodeValue</td>";
						}
					}
					$i++;
					echo "</tr>";
				}		
				echo "</tbody></table>";
				//echo $th->nodeValue;
			?>
        </div>
    </body>
</html>