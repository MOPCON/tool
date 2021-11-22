<?php

/**
 * $ php youtube_acl_trans.php attendees.csv yt-attendees.json
 */


$file = $argv[1];
$target = $argv[2];
if (!file_exists($file)) {
    echo "File not found";
    die();
}
$data = [];
$producionData = file_exists($target) ? json_decode(file_get_contents($target), true) : [];

$f = fopen($file, 'r');
$firstLine = true;

$accessMail = array();
$invalidMail = array();

while (($row = fgets($f)) !== false) {
    if ($firstLine) {
        $firstLine = false;
        continue;
    }
    $row = trim($row);
    $results = explode(",", $row);
    list($account, $domain) = explode("@", $results[0]);
    if ($domain != "gmail.com") {
        // var_dump($domain);
        $output = shell_exec("dig +short MX $domain");
        if (preg_match('/(google)/', $output) || preg_match('/(GOOGLE)/', $output)) {
            $accessMail[] = $results[0];
        } else {
            $invalidMail[] = $results[0];
        }
    } else {
        $accessMail[] = $results[0];
    }
}
// 正確信箱
var_dump("correct: " . count($accessMail));
// 錯誤信箱
var_dump("incorrect: " . count($invalidMail));
// 錯誤率
var_dump("incorrect rate: " . count($invalidMail) / (count($accessMail) + count($invalidMail)));

file_put_contents(str_replace('.json', '-invalid.json', $target), json_encode(array_values($invalidMail), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
file_put_contents($target, json_encode(array_values($accessMail), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
