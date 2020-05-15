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
        $url_sadnice = 'xml/sadnice.xml';
        $url_pozebe = 'xml/pozebe.xml';
        //
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
		if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $post_key = array_keys($_POST);
            $arr_key_sadnice = ['name', 'location', 'temperature', 'desc'];
            $arr_key_pozebe = ['key1', 'key2', 'key3', 'key4']; 

            // Odredjivanje koju xml datoteku treba popuniti
            // type=0 sadnice | type=false pozebe 
            $type = strpos($post_key[1], $arr_key_sadnice[1]);

            if($type !== false) {
                // Sadnice
            } else {
                // Pozebe
            }

            // Brisanje tako sto se poredi i ukoliko se poklapa neki zapis
            // Onda se ne upise u xml

            // Nakon birsanja mora se ponovo ucitati podaci 21-35 linija
            // Jer u nizu jos uvek oni postoje

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