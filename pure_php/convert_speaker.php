<?php
/**
 * $ php convert_speaker.php speakers.tsv speaker.json
 */

$extraField = [
    'started_at' => 0,
    'ended_at' => 0,
    'room' => '',
    'floor' => '',
    'sponsor_id' => 0,
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
    foreach ($producionData as $speaker) {
        $data[$speaker['speaker_id']] = $speaker;
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
    $speaker_id = (int) $result[0];

    if (!in_array(trim($result[34]), ['關閉前台修改', '已確認'])) {
        continue;
    }


    array_walk_recursive($result, function (&$value) {
        $value = str_replace(array('\\x22','\\x27','\\n'), array("'",'"',"\n"), $value);
    });
    
    echo $result[1];
    echo "\n";
    //tag filter empty
    $result[23] = $result[23] == '' ? [] : explode(',', $result[23]);
    //convert keynote
    $result[37] = $result[37] === '是';
    $newData = [
        'name' => $result[1],
        'name_e' => $result[2],
        'speaker_id' => $speaker_id,
        'company' => $result[4],
        'company_e' => $result[5],
        'job_title' => $result[6],
        'job_title_e' => $result[7],
        'bio' => $result[10],
        'bio_e' => $result[11],
        'photo_for_speaker_web' => 'api/2020/speaker/images/web/speaker_' . (string) $speaker_id,
        'photo_for_speaker_mobile' => 'api/2020/speaker/images/mobile/speaker_' . (string) $speaker_id,
        'photo_for_session_web' => 'api/2020/speaker/images/web/speaker_' . (string) $speaker_id,
        'photo_for_session_mobile' => 'api/2020/speaker/images/mobile/speaker_' . (string) $speaker_id,
        'photo_for_sponsor_web' => 'api/2020/speaker/images/web/speaker_' . (string) $speaker_id,
        'photo_for_sponsor_mobile' => 'api/2020/speaker/images/mobile/speaker_' . (string) $speaker_id,
        'link_fb' => $result[13],
        'link_github' => $result[14],
        'link_twitter' => $result[15],
        'link_other' => $result[16],
        'link_slide' => '', //$result[17],
        'topic' => $result[19],
        'topic_e' => $result[20],
        'summary' => $result[21],
        'summary_e' => $result[22],
        "community_partner" => "",
        'is_keynote' => $result[37],
        "is_online" => false,
        'recordable' => $result[25] == '否' ? false : true,
        'level' => explode('-', $result[24])[0],
        'tags' => $result[23],
    ];

    if (array_key_exists($newData['speaker_id'], $data)) {
        $oldData = $data[$newData['speaker_id']];
        $data[$newData['speaker_id']] = array_replace($oldData, $newData);
    } else {
        $data[$newData['speaker_id']] = array_merge($newData, $extraField);
    }
}
ksort($data);

file_put_contents($target, json_encode(array_values($data), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
