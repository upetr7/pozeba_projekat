<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Позеба - ИНФО </title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php
        // Ukljucivanje html kod za header
		include('inc/header.inc.html');

		// Ukljucivanje xml objekta
		$url = 'xml/sadnice.xml';
        if(file_exists($url)) $xml = simplexml_load_file($url);
        else exit('Ne mogu pronaci datoteku!');
		
		// Pravljenje moga niza radi lakseg upravljanja
		$xml_arr = [];
		foreach($xml->sadnica as $sadnica) array_push($xml_arr, $sadnica);
        
        // Stavljanje u promenljive prispele podatke sa index.php
        $vrsta_sadnice = $_GET['sel_vrsta_sadnice'];
        $lokacija = $_GET['sel_lokacija'];
        $povrsina = $_GET['povrsina'];
    
    ?>
    <div class="container">
        <h1>&gt;&gt;ИНФО&lt;&lt;</h1>
        <div class="prispeli-podaci">
            <h2>ПРИСПЕЛИ ПОДАЦИ</h2>
            <ul>
                <?php 
                    echo '<li>САДНИЦА: <em>'.strtoupper($vrsta_sadnice).'</em></li>';
                    echo '<li>ЛОКАЦИЈА: <em>'.strtoupper($lokacija).'</em></li>';
                    echo '<li>ПОВРШИНА: <em>'.strtoupper($povrsina).'</em></li>';
                ?>
            </ul>
        </div>
        <hr>
        <div class="obrada-podataka">
            <h2>ОБРАДА ПОДАТАКА:</h2>
            <?php 
                $pot_poruka = '<p>Овакав предмет <em>постоји</em> у бази података.</p>';
                $odr_poruka = '<p>Овакав предмет <em>не постоји</em> у бази података.</p>';

                $ima = 0; // >ima< sluzi za ispis pot_poruke i za bojenje teksta uz pomoc js-a
                // Provera da li postoji prispela sadnica u bazi podataka
                foreach($xml_arr as $sadnica) {
                    if(strtolower($sadnica->naziv->__toString()) == $vrsta_sadnice && 
                        strtolower($sadnica->lokacija->__toString()) == $lokacija) {
                        echo $pot_poruka.'<br>'; 
                        ++$ima; 
                        echo 'ОПИС: '.$sadnica->opis->__toString().'<br>';
                        break;
                    }
                }
                if(!$ima) echo $odr_poruka;
            ?>
        </div>
    </div>    
    <?php 
        // Generisanje JS koda za bojenje teksta
        $ima_script_1 = 'var p = document.querySelector("p"); p.style.color = "green"';
        $ima_script_0 = 'var p = document.querySelector("p"); p.style.color = "red"';
        echo '<script>';
        if($ima) echo $ima_script_1; 
        else echo $ima_script_0; 
        echo '</script>';
    ?>
</body>
</html>