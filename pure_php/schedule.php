<?php
// 將 speakers.json 檔案對應到議程表
// php schedule.php speakers.json 

date_default_timezone_set('Asia/Taipei');

$file = $argv[1];
$string = file_get_contents($file);

$roomTemplate = [
    'session_id' => 0,
    'speaker_id' => 0,
];
$schedule = [
    '2021-10-23' => [
        ['str' => '09:00', 'end' => '09:15', 'event' => '開幕 Opening', 'isBroadCast' => false],
        ['str' => '09:15', 'end' => '10:00', 'event' => '', 'isBroadCast' => false, 'room' => [
            '2021001' => [114],
        ]],
        ['str' => '10:00', 'end' => '10:10', 'event' => '休息 Break', 'isBroadCast' => false],
        ['str' => '10:10', 'end' => '10:55', 'event' => '', 'isBroadCast' => false, 'room' => [
            '2021004' => [107],
            '2021005' => [111],
            '2021006' => [110],
        ]],
        ['str' => '10:55', 'end' => '11:05', 'event' => '休息 Break', 'isBroadCast' => false],
        ['str' => '11:05', 'end' => '11:50', 'event' => '', 'isBroadCast' => false, 'room' => [
            '2021007' => [106],
            '2021008' => [140],
            '2021009' => [142],
        ]],
        ['str' => '11:50', 'end' => '13:00', 'event' => '午餐 Lunch', 'isBroadCast' => false],
        ['str' => '13:00', 'end' => '13:45', 'event' => '', 'isBroadCast' => false, 'room' => [
            '2021010' => [190],
            '2021011' => [144],
            '2021012' => [109],
        ]],
        ['str' => '13:45', 'end' => '13:55', 'event' => '休息 Break', 'isBroadCast' => false],
        ['str' => '13:55', 'end' => '14:40', 'event' => '', 'isBroadCast' => false, 'room' => [
            '2021013' => [113],
            '2021014' => [143],
            '2021015' => [191],
        ]],
        ['str' => '14:40', 'end' => '14:50', 'event' => '休息 Break', 'isBroadCast' => false],
        ['str' => '14:50', 'end' => '15:35', 'event' => '', 'isBroadCast' => false, 'room' => [
            '2021016' => [187],
            '2021017' => [139],
            '2021018' => [112],
        ]],
        ['str' => '15:35', 'end' => '15:45', 'event' => '休息 Break', 'isBroadCast' => false],
        ['str' => '15:45', 'end' => '16:30', 'event' => '', 'isBroadCast' => false, 'room' => [
            '2021019' => [116],
            '2021020' => [119],
            '2021021' => [105],
        ]],
        ['str' => '16:30', 'end' => '16:40', 'event' => '休息 Break', 'isBroadCast' => false],
        ['str' => '16:40', 'end' => '17:25', 'event' => '', 'isBroadCast' => false, 'room' => [
            '2021022' => [], // 贊助議程
            '2021023' => [], // 贊助議程
            '2021024' => [], // 贊助議程
        ]],
        ['isBroadCast' => false, 'event' => 'END'],
    ],
    '2021-10-24' => [
        ['str' => '09:00', 'end' => '10:10', 'event' => '', 'isBroadCast' => false, 'room' => [
            '2021025' => [] //[186, 145, 185]
        ]],
        ['str' => '10:10', 'end' => '10:20', 'event' => '休息 Break', 'isBroadCast' => false],
        ['str' => '10:20', 'end' => '11:05', 'event' => '', 'isBroadCast' => false, 'room' => [
            '2021028' => [183],
            '2021029' => [138],
            '2021030' => [136],
        ]],
        ['str' => '11:05', 'end' => '11:15', 'event' => '休息 Break', 'isBroadCast' => false],
        ['str' => '11:15', 'end' => '12:00', 'event' => '', 'isBroadCast' => false, 'room' => [
            '2021031' => [188],
            '2021032' => [181],
            '2021033' => [117],
        ]],
        ['str' => '12:00', 'end' => '13:00', 'event' => '午餐 Lunch', 'isBroadCast' => false],
        ['str' => '13:00', 'end' => '13:45', 'event' => '', 'isBroadCast' => false, 'room' => [
            '2021034' => [108],
            '2021035' => [182],
            '2021036' => [189],
        ]],
        ['str' => '13:45', 'end' => '13:55', 'event' => '休息 Break', 'isBroadCast' => false],
        ['str' => '13:55', 'end' => '14:40', 'event' => '', 'isBroadCast' => false, 'room' => [
            '2021037' => [122],
            '2021038' => [137],
            '2021039' => [186, 145, 185],
        ]],
        ['str' => '14:40', 'end' => '14:50', 'event' => '休息 Break', 'isBroadCast' => false],
        ['str' => '14:50', 'end' => '15:35', 'event' => '', 'isBroadCast' => false, 'room' => [
            '2021040' => [115],
            '2021041' => [121],
            '2021042' => [141],
        ]],
        ['str' => '15:35', 'end' => '15:45', 'event' => '休息 Break', 'isBroadCast' => false],
        ['str' => '15:45', 'end' => '16:30', 'event' => '', 'isBroadCast' => false, 'room' => [
            '2021043' => [120],
        ]],
        ['str' => '16:30', 'end' => '16:40', 'event' => '休息 Break', 'isBroadCast' => false],
        ['str' => '16:40', 'end' => '17:00', 'event' => '閃電秀 Lightning Talk', 'isBroadCast' => false],
        ['str' => '17:00', 'end' => '17:15', 'event' => '閉幕 Closing', 'isBroadCast' => false],
        ['isBroadCast' => false, 'event' => 'END']
    ]
];

$arrange = [];
$mappingSpeaker = function (
    $session_id,
    $speaker_ids,
    array $speakersArr,
    $room_number,
    $started_at,
    $ended_at
) {
    // default
    $tmpRoom = [
        'session_id' => $session_id,
        'room' => $room_number,
        'topic' => 'Coming Soon',
        'topic_e' => '',
        'summary' => '',
        'summary_e' => '',
        'is_keynote' => '',
        'is_online' => '',
        'recordable' => '',
        'level' => '',
        'target' => '',
        'prior_knowledge' => '',
        'expected_gain' => '',
        'tags' => '',
        "started_at" => $started_at,
        "ended_at" => $ended_at,
    ];
    foreach ($speaker_ids as $speaker_id) {
        $tmpRoom = [
            'session_id' => $session_id,
            'room' => $room_number,
            'topic' => $speakersArr[$speaker_id]['topic'] ?? 'Coming Soon',
            'topic_e' => $speakersArr[$speaker_id]['topic_e'] ?? '',
            'summary' => $speakersArr[$speaker_id]['summary'] ?? '',
            'summary_e' => $speakersArr[$speaker_id]['summary_e'] ?? '',
            'is_keynote' => $speakersArr[$speaker_id]['is_keynote'] ?? '',
            'is_online' => $speakersArr[$speaker_id]['is_online'] ?? '',
            'recordable' => $speakersArr[$speaker_id]['recordable'] ?? '',
            'level' => $speakersArr[$speaker_id]['level'] ?? '',
            'target' => $speakersArr[$speaker_id]['target'] ?? '',
            'prior_knowledge' => $speakersArr[$speaker_id]['prior_knowledge'] ?? '',
            'expected_gain' => $speakersArr[$speaker_id]['expected_gain'] ?? '',
            'tags' => $speakersArr[$speaker_id]['tags'] ?? '',
            'sponsor_id' => $speakersArr[$speaker_id]['sponsor_id'] ?? 0,
            'sponsor' => $speakersArr[$speaker_id]['sponsor'] ?? [],
            "started_at" => $started_at,
            "ended_at" => $ended_at,
        ];
        $speakers[] = [
            'speaker_id' => $speaker_id ?? 0,
            'name' => $speakersArr[$speaker_id]['name'] ?? '',
            'name_e' => $speakersArr[$speaker_id]['name_e'] ?? '',
            'job_title' => $speakersArr[$speaker_id]['job_title'] ?? '',
            'job_title_e' => $speakersArr[$speaker_id]['job_title_e'] ?? '',
            'company' => $speakersArr[$speaker_id]['company'] ?? '',
            'company_e' => $speakersArr[$speaker_id]['company_e'] ?? '',
            'img' => $speakersArr[$speaker_id]['img'] ?? ['web' => '', 'mobile' => ''],
            'link_github' => $speakersArr[$speaker_id]['link_github'] ?? '',
            'link_twitter' => $speakersArr[$speaker_id]['link_twitter'] ?? '',
            'link_other' => $speakersArr[$speaker_id]['link_other'] ?? '',
            'link_fb' => $speakersArr[$speaker_id]['link_fb'] ?? '',
        ];
        $tmpRoom['speakers'] = $speakers ?? [];
    }
    return $tmpRoom;
};

$speakersArr = json_decode($string, true);
// change Key to speaker_id
foreach ($speakersArr as $key => $speakerVal) {
    $speaker_id = $speakerVal['speaker_id'];
    $speakersArr[$speaker_id] = $speakersArr[$key];
    unset($speakersArr[$key]);
}

foreach ($schedule as $date => $sessions) {
    $day = [
        "date" => (int) strtotime($date),
        "period" => []
    ];
    foreach ($sessions as $session) {
        $room = [];
        $started_at = isset($session['str']) ? (int) strtotime($date . ' ' . $session['str']) : 0;
        $ended_at = isset($session['end']) ? (int) strtotime($date . ' ' . $session['end']) : 0;
        if (isset($session['room'])) {
            foreach ($session['room'] as $session_id => $speaker_ids) {
                $session_count = (int) substr($session_id, -2);
                $room_number = "R" . ($session_count % 3 == 0 ? 3 : $session_count % 3);
                $started_at = isset($session['str']) ? (int) strtotime($date . ' ' . $session['str']) : 0;
                $ended_at = isset($session['end']) ? (int) strtotime($date . ' ' . $session['end']) : 0;
                $room[] = $mappingSpeaker(
                    $session_id,
                    $speaker_ids,
                    $speakersArr,
                    $room_number,
                    $started_at,
                    $ended_at
                );
                // 將對應資料存回講者
                foreach ($speaker_ids as $speaker_id) {
                    $speakersArr[$speaker_id]['room'] = $room_number;
                    $speakersArr[$speaker_id]['started_at'] = $started_at;
                    $speakersArr[$speaker_id]['ended_at'] = $ended_at;
                    $speakersArr[$speaker_id]['session_id'] = $session_id;
                }
            }
        }
        $day["period"][] = [
            'started_at' => $started_at,
            'isBroadCast' => $session['isBroadCast'],
            'ended_at' => $ended_at,
            'event' => $session['event'] ?? '',
            'room' => $room,
        ];
    }
    $arrange[] = $day;
}

file_put_contents('./schedule.json', json_encode(array_values($arrange), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
file_put_contents($file, json_encode(array_values($speakersArr), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
