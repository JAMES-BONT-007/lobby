<?php

$nazwa = $_POST['nazwa'];
$data = $_POST['czas'];
$now = strtotime($data);

$conn = new mysqli("127.0.0.1", "root", "", "tictactoedb");

$q = "SELECT * FROM uzytkownicy WHERE nazwa='$nazwa'";
$wynik = $conn->query($q);

while($row=$wynik->fetch_array()){
    $MMR = $row[3];
}

$FilePath = 'lobbyStatus.txt';
$status = "waiting";
$lobbyMMRmin = $MMR - 50;
$lobbyMMRmax = $MMR + 50;
$lobbyfound = false;
$nazwa2 = "xxx";

$pisz = "$status - $lobbyMMRmin - $lobbyMMRmax - $nazwa - $nazwa2 - $data";
$lobbyExists = false;

$lines = file($FilePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$redirect = false;


//jesli w danej linii czas jest mniejszy niz 5 sekund zwraca true(zostawia ta linie) w innym przypadku ja usuwa
$lines = array_filter($lines, function ($line) use ($now) {
    $lineData = explode(' - ', $line);
    $currentLobbyTime = strtotime(trim($lineData[5]));
    if (count($lineData) === 6) {
        return $now - $currentLobbyTime <= 5;
    }
    return false;
});


foreach ($lines as $key => $line) {
    $lineData = explode('-', $line);
    $currentLobbystatus = trim($lineData[0]);
    $currentLobbyMinMMR = trim($lineData[1]);
    $currentLobbyMaxMMR = trim($lineData[2]);
    $currentLobbyPlayer = trim($lineData[3]);
    $currentLobbyPlayer2 = trim($lineData[3]);
    

    if($currentLobbystatus == "waiting"){
        if ($currentLobbyPlayer == $nazwa) {
            $lobbyExists = true;
            $lines[$key] = $pisz;
            $redirect = false;
        } elseif ($MMR >= $currentLobbyMinMMR && $MMR <= $currentLobbyMaxMMR) {
            $status = "starting ";
            $lobbyExists = true;
            $lineData[0] = $status;
            $lineData[4] = " $nazwa ";
            $lines[$key] = implode('-', $lineData);
            $redirect = true;
        }
    } else {

        if ($currentLobbyPlayer == $nazwa) {
            $enemyplayer = $nazwa;
        }else{
            $enemyplayer = $currentLobbyPlayer2;
        }
        $redirect = true;
        $lobbyExists = true;

    }


}

if (!$lobbyExists) {
    $lines[] = $pisz;
}

file_put_contents($FilePath, implode("\n", $lines) . "\n");

header('Content-Type: application/json');
echo json_encode(['redirect' => $redirect]);


?>
