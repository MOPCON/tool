<?php

/**
 * $ php convert_speaker.php speakers.tsv speaker.json
 */

$file = $argv[1];
$target = $argv[2];
if (!file_exists($file) || !file_exists($target)) {
    echo "File not found";
    die();
}
$data = [];
$productionData = json_decode(file_get_contents($target), true);
if (count($productionData) > 0) {
    foreach ($productionData as $speaker) {
        $data[$speaker['speaker_id']] = $speaker;
    }
}

$f = fopen($file, 'r');
$firstLine = true;

$sort = [];
while (($row = fgets($f)) !== false) {
    if ($firstLine) {
        $firstLine = false;
        continue;
    }
    $line = explode("\t", $row);
    $sort[(int) $line[4]] = $line[0];
    print_r($line);
}

usort($data, function ($a, $b) use ($sort) {
    if ($sort[$a['speaker_id']] === $sort[$b['speaker_id']]) {
        return 0;
    }
    return $sort[$a['speaker_id']] > $sort[$b['speaker_id']] ? 1 : -1;
});

file_put_contents(str_replace('.json', '-sort.json', $target), json_encode(array_values($data), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
