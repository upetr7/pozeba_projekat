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

        // if($_SERVER['REQUEST_METHOD'] == 'POST') {
        //     echo '<script>console.log(\'post method\')</script>';

        //     include('inc/azur-uspesno.inc.html');
        // }
        
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
        <form action="azur-xml.php" method="post" id="sadnice">
            <div class="fields-nm">
                <ul>
                    <li>Naziv</li>
                    <li>Lokacija</li>
                    <li>Temperatura</li>
                    <li>Itd</li>
                </ul>
            </div>
            <div class="fields-vl">
                <input type="text" name="name-1">
                <input type="text" name="location-1">
                <input type="text" name="temperature-1">
                <input type="text" name="etc-1">
                <div class="delete">X</div>
            </div>
        </form>
        <button  id="btn-azur-sadnice" disabled="disabled">Azuriraj</button>
        <!-- type="submit" form="sadnice" -->
        <!-- <form action="azur-xml.php" method="post" id="pozebe">
            <div class="fields-nm">
                <ul>
                    <li>Naziv</li>
                    <li>Lokacija</li>
                    <li>Temperatura</li>
                    <li>Itd</li>
                </ul>
            </div>
            <div class="fields-vl">
                <input type="text" name="naziv-1">
                <input type="text" name="lokacija-1">
                <input type="text" name="temperatura-1">
                <input type="text" name="itd-1">
            </div>
            <div class="fields-vl">
                <input type="text" name="naziv-1">
                <input type="text" name="lokacija-1">
                <input type="text" name="temperatura-1">
                <input type="text" name="itd-1">
            </div>
            <div class="fields-vl">
                <input type="text" name="naziv-1">
                <input type="text" name="lokacija-1">
                <input type="text" name="temperatura-1">
                <input type="text" name="itd-1">
            </div>
        </form> -->

    </div>
    <!-- SCRIPT -->
    <script src="js/azur-xml.js"></script>
    <script src="js/azur-sadnica-xml.js"></script>
    <script src="js/azur-pozeba-xml.js"></script>
</body>

</html>