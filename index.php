<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styl.css">
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
            echo '<br>';
            echo '<button id="guest" onclick="location.href=\'logout.php\'">wyloguj</button>';
        }

        ?>


    </div>


    <div id="main">

        <?php 
            if($zalogowano){
                echo '<button id="login" onclick="location.href=\'lobby/lobby.php\'">GRAJ </button> <br> <br>';
                echo '<button id="login" onclick="location.href=\'online/online.php\'">SPRAWDZ KTO JEST ONLINE </button> <br> <br>';

            }else{
                echo '<button id="login" onclick="location.href=\'login.html\'">ZALOGUJ </button>';
                
            }
        ?>


    </div>




</body>

</html>