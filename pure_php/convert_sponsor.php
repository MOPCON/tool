<?php
/**
 * $ php conver_sponsor.php input_tsv output_json
 */

//  mapping data
$sponsor_type = [
    'Tony Stark' => 'tony_stark',
    'Bruce Wayne' => 'bruce_wayne',
    'Hacker' => 'hacker',
    'Developer' => 'developer',
    '其他' => 'special_thanks',
];

$special_sponsor_type = [
    79 => 'education'
];

$sponsor_type_name = [
    'tony_stark' => [
        'name' => 'Tony Stark',
        'name_e' => 'Tony Stark',
        'icon' => 'BruceWayne',
    ],
    'bruce_wayne' => [
        'name' => 'Bruce Wayne',
        'name_e' => 'Bruce Wayne',
        'icon' => 'BruceWayne',
    ],
    'hacker' => [
        'name' => 'Hacker',
        'name_e' => 'Hacker',
        'icon' => 'Hacker',
    ],
    'developer' => [
        'name' => 'Developer',
        'name_e' => 'Developer',
        'icon' => 'Developer',
    ],
    'education' => [
        'name' => '教育贊助',
        'name_e' => 'Education Sponsor',
        'icon' => 'Other',
    ],
    'special_thanks' => [
        'name' => '特別感謝',
        'name_e' => 'Special Thanks',
        'icon' => 'Other',
    ],
];

$sponsor_type_sort = array_flip(array_keys($sponsor_type_name));

// sponsor id => speaker id
$sponsor_speaker = [
    70 => 182,
    // 71 => 189 //not ready
];

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
$producionData = [] ;// file_exists($target) ? json_decode(file_get_contents($target), true) : [];
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
        "logo_path" => 'assets/images/sponsors/' . $result[0] . '.png',
        "name" => $result[4],
        "name_e" => $result[5],
        "sponsor_id" => (int) $result[0],
        "about_us" => $result[6],
        "about_us_e" => $result[7],
        "facebook_url" => $result[9],
        "official_website" => $result[8],
        "sponsor_type" => $special_sponsor_type[(int) $result[0]] ?? $sponsor_type[$result[3]],
        "speaker_information" => [],
    ];

    if (array_key_exists($newData['sponsor_id'], $data)) {
        $oldData = $data[$newData['sponsor_id']];
        $data[$newData['sponsor_id']] = array_replace($oldData, $newData);
    } else {
        $data[$newData['sponsor_id']] = array_merge($newData, $extraField);
    }
}

ksort($data);

$speaker_file = $argv[3];
if (file_exists($speaker_file) && count($sponsor_speaker) > 0) {
    // mapping speakers
    $speakers = [];
    foreach (json_decode(file_get_contents($speaker_file), true) as $speaker) {
        $speakers[$speaker['speaker_id']] = $speaker;
    }

    foreach ($sponsor_speaker as $sponsor_id => $speaker_id) {
        $speakers[$speaker_id]['sponsor_id'] = $sponsor_id;
        $speakers[$speaker_id]['sponsor_info'] = [
            "logo_path" => $data[$sponsor_id]["logo_path"],
            "name" => $data[$sponsor_id]["name"],
            "name_e" => $data[$sponsor_id]["name_e"]
        ];

        $data[$sponsor_id]['speaker_information'][] = $speakers[$speaker_id];
        file_put_contents(
            $speaker_file,
            json_encode(array_values($speakers), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
        );
    }
}

usort($data, function ($a, $b) use ($sponsor_type_sort) {
    if ($sponsor_type_sort[$a['sponsor_type']] == $sponsor_type_sort[$b['sponsor_type']]) {
        return 0;
    }
    return $sponsor_type_sort[$a['sponsor_type']] > $sponsor_type_sort[$b['sponsor_type']] ? 1 : -1;
});

$group_data = [];
$img_data = [];

foreach ($data as $sponsor) {
    $group_data[$sponsor['sponsor_type']]['data'][] = $sponsor;
    $img_data[] = [
        "logo_path" => $sponsor["logo_path"],
        "name" => $sponsor["name"],
        "name_e" => $sponsor["name_e"],
        "sponsor_id" => $sponsor["sponsor_id"],
    ];
}

foreach ($sponsor_type_name as $key => $names) {
    if (!isset($group_data[$key]['data'])) {
        continue;
    }
    $group_data[$key] = array_merge($names, $group_data[$key]);
}

file_put_contents($target, json_encode(array_values($group_data), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
file_put_contents('sponsor-img.json', json_encode(array_values($img_data), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
