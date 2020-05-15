<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Позеба - ПОЧЕТНА</title>

	<link rel="stylesheet" href="css/style.css">
</head>

<body>
	<?php 
		// Ukljucivanje headera
		include('inc/header.inc.html');

		// Ukljucivanje xml objekta
		$xml;
		$url = 'xml/sadnice.xml';
		if(file_exists($url)) $xml = simplexml_load_file($url);
        else exit('Ne mogu pronaci datoteku!');
		
		// Pravljenje moga niza radi lakseg upravljanja
		$xml_arr = [];
		foreach($xml->sadnica as $sadnica) array_push($xml_arr, $sadnica);

	?>
	<div class="container">
		<form action="info.php" method="get">
			<label for="vrsta_sadnice">
				<p>Врста саднице:</p>
				<select name="sel_vrsta_sadnice" id="sel_vrsta_sadnice">
					<?php 
						// Pravljenje niza od neponavljajucih elemenata
						$ubaceni_arr = [];
						foreach($xml_arr as $sadnica) 
							if(!in_array($sadnica->name->__toString(), $ubaceni_arr)) 
								array_push($ubaceni_arr, $sadnica->name->__toString());
						sort($ubaceni_arr); // Sortiranje radi lakseg koriscenja
						// Generisanje html koda za select - option
						foreach($ubaceni_arr as $sadnica)
							echo '<option value="'.strtolower($sadnica).'" >'.$sadnica.'</option>';
					?>
				</select>
			</label>
			<label for="lokacija">
				<p>Локација:</p>
				<select name="sel_lokacija" id="sel_lokacija">
					<?php 
						$ubaceni_arr = [];
						foreach($xml_arr as $sadnica) 
							if(!in_array($sadnica->location->__toString(), $ubaceni_arr)) 
								array_push($ubaceni_arr, $sadnica->location->__toString());
						sort($ubaceni_arr);
						foreach($ubaceni_arr as $lokacija)
							echo '<option value="'.strtolower($lokacija).'" >'.$lokacija.'</option>';
					?>
				</select>
			</label>
			<label for="povrsina">
				<p>Површина[ha]:</p>
				<input type="text" name="povrsina" id="povrsina">
			</label>
			<button type="submit" id="posalji" disabled>ПОШАЉИ</button>
		</form>
	</div>
	<?php
		include('inc/footer.inc.html');
	?>

	<script src="js/script.js"></script>
	<script src="js/header.js"></script>
</body>

</html>