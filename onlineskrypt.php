<?php
$nazwa = $_POST['nazwa'];
$data = $_POST['czas'];

$FilePath = 'online.txt';
$pisz = "$nazwa - $data";

$lines = file($FilePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$usernameExists = false;

foreach ($lines as $key => $line) {
    if (strpos($line, $nazwa) !== false) {
        $lines[$key] = $pisz;
        $usernameExists = true;
    }
}

if (!$usernameExists) {
    $lines[] = $pisz;
}

$now = strtotime($data);

$lines = array_filter($lines, function ($line) use ($now, $nazwa) {
    $lineData = explode(' - ', $line);
    if (count($lineData) === 2) {
        $lineDate = strtotime($lineData[1]);
        return $lineData[0] === $nazwa || $now - $lineDate <= 10;
    }
    return false;
});

file_put_contents($FilePath, implode("\n", $lines) . "\n");

$onlineAcc = array_map(function ($line) {
    return explode(' - ', $line)[0];
}, $lines);

header('Content-Type: application/json');
echo json_encode($onlineAcc);



?>