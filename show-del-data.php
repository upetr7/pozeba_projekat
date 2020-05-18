<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Прикажи - Обриши - ПОЗЕБА</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/show-del-data.css">
</head>
<body>
    <?php 
        include('inc/header.inc.html');
        //
        $xml_sadnice = [];
        $xml_pozebe = [];
        $arr_sadnice = [];
        $arr_pozebe = [];
        $url_sadnice = 'xml/sadnice.xml'; //define('FILE_SADNICE', 'xml/sadnice.xml')
        $url_pozebe = 'xml/pozebe.xml'; //define('FILE_POZEBE', 'xml/pozebe.xml')
        $arr_key_sadnice = ['name', 'location', 'temperature', 'desc'];
        $arr_key_pozebe = ['key1', 'key2', 'key3', 'key4']; 
        if(file_exists($url_sadnice)) $xml_sadnice = simplexml_load_file($url_sadnice);
        else {
            echo "Datoteka $url_sadnice ne postoji!";
            exit();
        }
        if(file_exists($url_pozebe)) $xml_pozebe = simplexml_load_file($url_pozebe);      
        else {
            echo "Datoteka $url_pozebe ne postoji!";
            exit();
        }
        //
        foreach($xml_sadnice->sadnica as $sadnica)
            array_push($arr_sadnice, $sadnica);
        foreach($xml_pozebe->pozeba as $pozeba)
            array_push($arr_pozebe, $pozeba);
            
		// Poslati podaci da se obrisu
        // Vec imas nizove u arr_sadnice i arr_pozebe samo uporedi poslate vrednosti
        // Preko kljuca utvrdis koje podatke treba izbirsati
        $req_uri = urldecode($_SERVER['REQUEST_URI']);
		if($_SERVER['REQUEST_METHOD'] == 'GET' && strpos($req_uri, '?')) {
            $get_keys = array_keys($_GET);

            // Odredjivanje koju xml datoteku treba popuniti
            // type=0 sadnice | type=false pozebe 
            $type = strpos($get_keys[1], $arr_key_sadnice[1]);
            // print_r($_GET);

            // Sadnice
            if($type !== false) {
                echo 'usao u sadnice';

                $xml_doc = new DOMDocument("1.0", "UTF-8");
                $sadnice_el = $xml_doc->createElement('sadnice');
                $xml_doc->appendChild($sadnice_el); // Kreiranje roota

                $fp = fopen($url_sadnice, 'w');
                fwrite($fp, '');
                fclose($fp);

                for($i = 0; $i < count($arr_sadnice); $i++) {
                    $name = $arr_sadnice[$i]->name;
                    $location = $arr_sadnice[$i]->location;
                    // Deli sa brojem polja koja se uporedjuju - 2
                    for($j = 0; $j < (count($_GET) / 2); $j++) {
                        $tmp_name = $_GET[$get_keys[$j * 2]];
                        $tmp_location = $_GET[$get_keys[$j * 2 + 1]];
                        // Ako postoji podudaranje ne upisuj u datoteku(brisanje)
                        if($tmp_name == $name && $tmp_location == $location) break;
                        // Ako nije doslo do poklapanja ni sa poslednjim pisi u datoteku
                        else if($j == (count($_GET) / 2) - 1) {
                            $el = $xml_doc->createElement('sadnica');
                            for($k = 0; $k < count($arr_key_sadnice); $k++) {
                                $key = $arr_key_sadnice[$k]; // Mora ovako da se izdvoji $key ne radi kada se odmah stavi
                                $field = $xml_doc->createElement($arr_key_sadnice[$k], $arr_sadnice[$i]->$key->__toString());
                                $el->appendChild($field);
                            }
                            $sadnice_el->appendChild($el);
                        }
                    } // Kraj for J
                } // Kraj for I
                $xml_doc->save($url_sadnice);
            } else { // Pozebe PROVERI DA LI RADI SVE KAKO TREBA S POZEBAMA
                echo 'usao u pozebe';

                $xml_doc = new DOMDocument("1.0", "UTF-8");
                $pozebe_el = $xml_doc->createElement('pozebe');
                $xml_doc->appendChild($pozebe_el); // Kreiranje roota

                $fp = fopen($url_pozebe, 'w');
                fwrite($fp, '');
                fclose($fp);

                for($i = 0; $i < count($arr_pozebe); $i++) {
                    $key1 = $arr_pozebe[$i]->key1;
                    $key2 = $arr_pozebe[$i]->key2;
                    // Deli sa brojem polja koja se uporedjuju - 2
                    for($j = 0; $j < (count($_GET) / 2); $j++) {
                        $tmp_key1 = $_GET[$get_keys[$j * 2]];
                        $tmp_key2 = $_GET[$get_keys[$j * 2 + 1]];
                        // Ako postoji podudaranje ne upisuj u datoteku(brisanje)
                        if($tmp_key1 == $key1 && $tmp_key2 == $key2) break;
                        // Ako nije doslo do poklapanja ni sa poslednjim pisi u datoteku
                        else if($j == (count($_GET) / 2) - 1) {
                            $el = $xml_doc->createElement('pozeba');
                            for($k = 0; $k < count($arr_key_pozebe); $k++) {
                                $key = $arr_key_pozebe[$k]; // Mora ovako da se izdvoji $key ne radi kada se odmah stavi
                                $field = $xml_doc->createElement($arr_key_pozebe[$k], $arr_pozebe[$i]->$key->__toString());
                                $el->appendChild($field);
                            }
                            $pozebe_el->appendChild($el);
                        }
                    } // Kraj for J
                } // Kraj for I
                $xml_doc->save($url_pozebe);
            }

            // Brisanje tako sto se poredi i ukoliko se poklapa neki zapis
            // Onda se ne upise u xml

            // Nakon birsanja mora se ponovo ucitati podaci 21-35 linija
            // Jer u nizu jos uvek oni postoje
            $arr_sadnice = [];
            $xml_sadnice = simplexml_load_file($url_sadnice);
            foreach($xml_sadnice->sadnica as $sadnica)
                array_push($arr_sadnice, $sadnica);
            $arr_pozebe = [];
            $xml_pozebe = simplexml_load_file($url_pozebe);
            foreach($xml_pozebe->pozeba as $pozeba)
            array_push($arr_pozebe, $pozeba);

		}
    ?>
    <div class="container">
        <!-- CONTAINER SADNICE -->
        <div class="container-sadnice">
            <h3>Саднице</h3>
            <table>
                <tr>
                    <th>Поље 1</th>
                    <th>Поље 2</th>
                    <th>Поље 3</th>
                </tr>
                <?php
                    foreach($arr_sadnice as $sadnica) {
                        echo '<tr>';
                        echo '<td>'.$sadnica->name.'</td>';
                        echo '<td>'.$sadnica->location.'</td>';
                        echo '<td>'.$sadnica->desc.'</td>';
                        echo '<td>'.'<div class="delete-check">Избриши</div>'.'</td>';
                        echo '</tr>';
                    }
                ?>
            </table>
            <button id="btn-sadnice" disabled="disabled">Избриши изабрано</button>
        </div>
        <!-- CONTAINER POZEBE -->
        <div class="container-pozebe">
            <h3>Позебе</h3>
            <table>
                <tr>
                    <th>Поље 1</th>
                    <th>Поље 2</th>
                    <th>Поље 3</th>
                    <th>Поље 4</th>
                </tr>
                <?php
                    foreach($arr_pozebe as $pozeba) {
                        echo '<tr>';
                        echo '<td>'.$pozeba->key1.'</td>';
                        echo '<td>'.$pozeba->key2.'</td>';
                        echo '<td>'.$pozeba->key3.'</td>';
                        echo '<td>'.$pozeba->key4.'</td>';
                        echo '<td>'.'<div class="delete-check">Избриши</div>'.'</td>';
                        echo '</tr>';
                    }
                ?>
            </table>
            <button id="btn-pozebe" disabled="disabled">Избриши изабрано</button>
        </div>
        <!-- END CONTAINER POZEBE -->
    </div>
    <?php
		include('inc/footer.inc.html');
	?>
    <script src="js/header.js"></script>
    <script src="js/show-del-data.js"></script>
</body>
</html>