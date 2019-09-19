<?php
/**
 * $ php conver_speaker.php input_tsv output_json
 */

$extraField = [
    'started_at' => '',
    'ended_at' => '',
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

    if (trim($result[27]) !== '關閉前台修改') {
        continue;
    }

    array_walk_recursive($result, function (&$value) {
        $value = str_replace(array('\\x22','\\x27','\\n'), array("'",'"',"\n"), $value);
    });
    //tag filter empty
    $result[18] = $result[18] == '' ? [] : explode(',', $result[18]);
    //convert keynote
    $result[29] = $result[29] === '是';
    $newData = [
        'name' => $result[1],
        'name_e' => $result[2],
        'speaker_id' => (int) $result[0],
        'company' => $result[3],
        'company_e' => $result[4],
        'job_title' => $result[5],
        'job_title_e' => $result[6],
        'bio' => $result[7],
        'bio_e' => $result[8],
        'photo_for_speaker_web' => 'api/2019/speaker/images/web/speaker_' . (string)$result[0],
        'photo_for_speaker_mobile' => 'api/2019/speaker/images/mobile/speaker_' . (string)$result[0],
        'photo_for_session_web' => 'api/2019/speaker/images/web/speaker_' . (string)$result[0],
        'photo_for_session_mobile' => 'api/2019/speaker/images/mobile/speaker_' . (string)$result[0],
        'photo_for_sponsor_web' => 'api/2019/speaker/images/web/speaker_' . (string)$result[0],
        'photo_for_sponsor_mobile' => 'api/2019/speaker/images/mobile/speaker_' . (string)$result[0],
        'link_fb' => $result[10],
        'link_github' => $result[11],
        'link_twitter' => $result[12],
        'link_other' => $result[13],
        'topic' => $result[14],
        'topic_e' => $result[15],
        'summary' => $result[16],
        'summary_e' => $result[17],
        'is_keynote' => $result[29],
        'recordable' => $result[20] == '謝絕所有錄音錄影，但接受 MOPCON 工作人員文字紀錄。' ? false : true,
        'level' => explode('-', $result[19])[0],
        'tags' => $result[18],
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
