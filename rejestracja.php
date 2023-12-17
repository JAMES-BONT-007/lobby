<?php
    $nazwa = $_POST["nazwa"];
    $haslo = sha1($_POST["haslo"]);

    $conn = new mysqli("127.0.0.1", "root", "", "tictactoeDB");

    if ($conn->connect_error) {
        echo json_encode(array('wszystkojedno' => false, 'cokolwiek' => 'cos poszło nie tak ¯\_(ツ)_/¯'));
    }

    $q1 = "SELECT * FROM uzytkownicy WHERE nazwa = '$nazwa'";

    $wyn = $conn->query($q1);

    if ($wyn->num_rows > 0) {
        echo json_encode(array('wszystkojedno' => false, 'cokolwiek' => "Konto o nazwie '$nazwa' już istnieje! Użyj innego loginu dla swojego konta."));
        $q3 = "INSERT INTO `log` (`opis operacji`) VALUES ('niepowodzenie sworzenia konta o nazwie $nazwa, KONTO JUŻ ISTNIEJE')";
        $conn->query($q3);
    } else {
        $q2 = "INSERT INTO uzytkownicy (nazwa, haslo, ranking) VALUES ('$nazwa', '$haslo', 410)";
        
        if ($conn->query($q2) === TRUE) {
            echo json_encode(array('wszystkojedno' => true, 'cokolwiek' => "Pomyślnie stworzono konto: $nazwa!!!"));

            $q4 = "INSERT INTO `log` (`opis operacji`) VALUES ('stworzenia konta o nazwie $nazwa')";
            $conn->query($q4);

        } else {
            echo json_encode(array('wszystkojedno' => false, 'cokolwiek' => "Coś poszło nie tak przy tworzeniu konta: " . $conn->error));

            $q5 = "INSERT INTO `log` (`opis operacji`) VALUES ('sworzenia konta: $conn->error')";
            $conn->query($q5);
        }
    }

    $conn->close();
?>