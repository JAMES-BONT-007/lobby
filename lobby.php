<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../styl.css">
</head>

<body>

    <div id="naglowek1">
        <?php

        $zalogowano = false;

        if (isset($_COOKIE["konto"])) {
            $zalogowano = True;
            $login = $_COOKIE["konto"];

            echo "<b>Zalogowano jako: " . $login."</b>";
            echo '<br>';
        }

        if(!$zalogowano){
            header("refresh:0.1;url=index.php"); 
        }
        ?>


    </div>


    <div id="main">
        <h1>Witaj</h1>
        <h2>Czekasz w lobby! Szukamy dla ciebie osoby z którą bedziesz mógł grać!</h2>
        <div id="comm">

        </div>
    </div>

    <script src="lobbyskrypt.js"></script>


</body>

</html>
    
