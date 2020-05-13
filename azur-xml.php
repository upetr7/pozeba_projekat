<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Azuriranje XML</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/azur-xml.css">
</head>

<body>
    <?php
        include('inc/header.inc.html');

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $dom = new DOMDocument();
            $url_sadnice = 'xml/sadnice.xml';
            $url_pozebe = 'xml/pozebe.xml';

            $post_key = array_keys($_POST);
            $arr_key_sadnice = ['name', 'location', 'temperature', 'desc'];
            $arr_key_pozebe = ['key1', 'key2', 'key3']; 

            // Odredjivanje koju xml datoteku treba popuniti
            $type; // type=0 sadnice | type=false pozebe 
            $type = strpos($post_key[1], $arr_key_sadnice[1]);

            
            
            if($type !== false) {
                $dom->load($url_sadnice);
                $sadnice = $dom->firstChild;
                // trebace count()/count() - 1 zbog poslednjeg inputa koji je prazan
                for($j = 0; $j < (count($_POST) / count($arr_key_sadnice)) - 1; $j++){
                    $el = $dom->createElement('sadnica');
                    for($i = 0; $i < count($arr_key_sadnice); $i++) {
                        $field = $dom->createElement($arr_key_sadnice[$i], $_POST[$post_key[$i + $j * 3]]);
                        $el->appendChild($field);
                    }
                    print_r($el);
                    $sadnice->appendChild($el);
                }
                echo $dom->save($url_sadnice);
            } else {
                $dom->load($url_pozebe);
                $pozebe = $dom->firstChild;
                for($j = 0; $j < (count($_POST) / count($arr_key_pozebe)) - 1; $j++){
                    $el = $dom->createElement('sadnica');
                    for($i = 0; $i < count($arr_key_pozebe); $i++) {
                        $field = $dom->createElement($arr_key_pozebe[$i], $_POST[$post_key[$i + $j * 3]]);
                        $el->appendChild($field);
                    }
                    $pozebe->appendChild($el);
                }
                echo $dom->save($url_pozebe);
            }
            




            // include('inc/azur-uspesno.inc.html');
        }
        
    ?>

    <div class="container">
        <h2>AZURIRAJ XML</h2>
        <hr>
        <div class="choose-frm">
            <ul>
                <li>Sadnice</li>
                <li>Pozebe</li>
            </ul>
        </div>
        <!-- sadnice form -->
        <form action="azur-xml.php" method="post" id="sadnice">
            <div class="fields-nm">
                <ul>
                    <li>Naziv</li>
                    <li>Lokacija</li>
                    <li>Temperatura</li>
                    <li>Itd</li>
                </ul>
            </div>
        </form>
        <button  id="btn-azur-sadnice" disabled="disabled" form="sadnice">Azuriraj sadnice</button>
        <!-- end sadnice form -->
        <form action="azur-xml.php" method="post" id="pozebe">
            pozebe
            <div class="fields-nm">
                <ul>
                    <li>Naziv</li>
                    <li>Lokacija</li>
                    <li>Temperatura</li>
                    <li>Itd</li>
                </ul>
            </div>
        </form>
        <button  id="btn-azur-pozebe" disabled="disabled" form="pozebe">Azuriraj pozebe</button>
        <!-- end pozebe form -->
    </div>
    <!-- SCRIPT -->
    <script src="js/azur-xml.js"></script>
</body>

</html>