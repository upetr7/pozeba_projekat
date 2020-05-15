<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Azuriranje XML</title>
    <link rel="stylesheet" href="css/style.css">
    <!-- Promeni ime u add-xml.css -->
    <link rel="stylesheet" href="css/add-data.css">
</head>

<body>
    <?php
        include('inc/header.inc.html');

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            echo 'postic';

            $dom = new DOMDocument();
            // Dodaj file_exist
            $url_sadnice = 'xml/sadnice.xml';
            $url_pozebe = 'xml/pozebe.xml';

            $post_key = array_keys($_POST);
            $arr_key_sadnice = ['name', 'location', 'temperature', 'desc'];
            $arr_key_pozebe = ['key1', 'key2', 'key3', 'key4']; 

            // Odredjivanje koju xml datoteku treba popuniti
            // type=0 sadnice | type=false pozebe 
            $type = strpos($post_key[1], $arr_key_sadnice[1]);

            if($type !== false) {
                $dom->load($url_sadnice);
                $sadnice = $dom->firstChild;
                // trebace count()/count() - 1 zbog poslednjeg inputa koji je prazan
                for($j = 0; $j < (count($_POST) / count($arr_key_sadnice)) - 1; $j++){
                    $el = $dom->createElement('sadnica');
                    for($i = 0; $i < count($arr_key_sadnice); $i++) {
                        // count($arr_key_pozebe) - 1 za broj u $i + $j * >X<
                        $field = $dom->createElement($arr_key_sadnice[$i], $_POST[$post_key[$i + $j * count($arr_key_sadnice)]]);
                        $el->appendChild($field);
                    }
                    $sadnice->appendChild($el);
                }
                echo $dom->save($url_sadnice);
            } else {
                $dom->load($url_pozebe);
                $pozebe = $dom->firstChild;
                for($j = 0; $j < (count($_POST) / count($arr_key_pozebe)) - 1; $j++){
                    $el = $dom->createElement('pozeba');
                    for($i = 0; $i < count($arr_key_pozebe); $i++) {
                        $field = $dom->createElement($arr_key_pozebe[$i], $_POST[$post_key[$i + $j * count($arr_key_pozebe)]]);
                        $el->appendChild($field);
                    }
                    $pozebe->appendChild($el);
                }
                echo $dom->save($url_pozebe);
            }
            
            // Promeni ime u add-uspesno.inc.html
            include('inc/azur-uspesno.inc.html');
        }
        
    ?>

    <div class="container">
        <h2>Додај у базу података</h2>
        <hr>
        <div class="choose-frm">
            <ul>
                <li>Саднице</li>
                <li>Позебе</li>
            </ul>
        </div>
        <!-- sadnice form -->
        <form action="add-data.php" method="post" id="sadnice">
            <div class="fields-nm">
                <ul>
                    <li>Поље 1</li>
                    <li>Поље 2</li>
                    <li>Поље 3</li>
                    <li>Поље 4</li>
                </ul>
            </div>
        </form>
        <button  id="btn-azur-sadnice" disabled="disabled" form="sadnice">Додај</button>
        <!-- end sadnice form -->
        <form action="add-data.php" method="post" id="pozebe">
            <div class="fields-nm">
                <ul>
                    <li>Поље 1</li>
                    <li>Поље 2</li>
                    <li>Поље 3</li>
                    <li>Поље 4</li>
                </ul>
            </div>
        </form>
        <button  id="btn-azur-pozebe" disabled="disabled" form="pozebe">Додај</button>
        <!-- end pozebe form -->
    </div>
    <?php
		include('inc/footer.inc.html');
	?>
    <!-- SCRIPT -->
    <script src="js/add-data.js"></script>
    <script src="js/header.js"></script>
</body>

</html>