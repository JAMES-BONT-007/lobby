<?php
    $nazwa = $_POST['nazwa'];
    $haslo = sha1($_POST['haslo']);

    $conn = new mysqli("127.0.0.1", "root", "", "tictactoedb");

    if ($conn->connect_error) {
        echo json_encode(array('wszystkojedno' => false, 'cokolwiek' => 'cos poszło nie tak ¯\_(ツ)_/¯'));
    }

    $q = "SELECT * FROM uzytkownicy WHERE nazwa='$nazwa' AND haslo='$haslo'";
    $wynik = $conn->query($q);

    if ($wynik->num_rows > 0) {
        echo json_encode(array('wszystkojedno' => true, 'cokolwiek' => 'Zalogowano pomyślnie<br>Siema ' . $nazwa . '!!'));
        setcookie("konto", $nazwa, time() + 16200);
        $q2 = "INSERT INTO `log` (`opis operacji`) VALUES ('zalogowanie do konta $nazwa')";
        $conn->query($q2);
    }else{
        echo json_encode(array('wszystkojedno' => false, 'cokolwiek' => 'Podany login lub hasło jest nieprawidłowe!'));
        $q3 = "INSERT INTO `log` (`opis operacji`) VALUES ('niepowodzenie zalogowania do konta $nazwa')";
        $conn->query($q3);
    }
    $conn->close();
?>
