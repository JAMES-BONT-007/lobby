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
        <h2>to są osoby które też chcą sprawdzić kto jest online!</h2>
        <div id="online">

        </div>
    </div>

    <script src="onlineskrypt.js"></script>


</body>

</html>