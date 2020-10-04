<?php
/**
 * $ php conver_sponsor.php input_tsv output_json
 */

$extraField = [
    'career_information' => '',
];

$file = $argv[1];
$target = $argv[2];
if (!file_exists($file)) {
    echo "File not found";
    die();
}
$data = [];
$producionData = file_exists($target) ? json_decode(file_get_contents($target), true) : [];
if (count($producionData) > 0) {
    foreach ($producionData as $sponsor) {
        $data[$sponsor['sponsor_id']] = $sponsor;
    }
}

$f = fopen($file, 'r');
$firstLine = true;

while (($row = fgets($f)) !== false) {
    if ($firstLine) {
        $firstLine = false;
        continue;
    }

    $row = trim($row);
    $result = explode("\t", $row);

    if (trim($result[2]) !== '已確認') {
        continue;
    }

    array_walk_recursive($result, function (&$value) {
        $value = str_replace(array('\\x22','\\x27','\\n'), array("'",'"',"\n"), $value);
    });
    //convert sponsor_type
    $result[2] = strtolower($result[3]);
    $result[2] = preg_replace('/ /', '_', $result[3]);

    $newData = [
        "logo_path" => 'api/' . $result[1] . '/sponsor/images/sponsor_' . $result[0],
        "name" => $result[4],
        "name_e" => $result[5],
        "sponsor_id" => (int) $result[0],
        "about_us" => $result[6],
        "about_us_e" => $result[7],
        "facebook_url" => $result[9],
        "official_website" => $result[8],
        "sponsor_type" => $result[3],
    ];

    if (array_key_exists($newData['sponsor_id'], $data)) {
        $oldData = $data[$newData['sponsor_id']];
        $data[$newData['sponsor_id']] = array_replace($oldData, $newData);
    } else {
        $data[$newData['sponsor_id']] = array_merge($newData, $extraField);
    }
}

ksort($data);

file_put_contents($target, json_encode(array_values($data), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
