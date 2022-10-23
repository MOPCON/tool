<?php
// 將 speakers.json 檔案對應到議程表
// php schedule.php speakers.json
// 更新至 2022 議程 2022/08/23

date_default_timezone_set('Asia/Taipei');

$file = $argv[1];
$string = file_get_contents($file);

$roomTemplate = [
    'session_id' => 0,
    'speaker_id' => 0,
];
$schedule = [
    '2022-10-15' => [
        ['str' => '08:45', 'end' => '09:00', 'event' => '開幕 Opening', 'isBroadCast' => false],
        ['str' => '09:00', 'end' => '09:45', 'event' => '', 'isBroadCast' => false, 'room' => [
            '2022001' => [],
        ]],
        ['str' => '09:45', 'end' => '09:55', 'event' => '休息 Break', 'isBroadCast' => false],
        ['str' => '09:55', 'end' => '10:40', 'event' => '', 'isBroadCast' => false, 'room' => [
            '2022005' => [236],
            '2022006' => [225],
            '2022007' => [202],
            '2022008' => [222],
        ]],
        ['str' => '10:40', 'end' => '10:50', 'event' => '休息 Break', 'isBroadCast' => false],
        ['str' => '10:50', 'end' => '11:35', 'event' => '', 'isBroadCast' => false, 'room' => [
            '2022009' => [],
            '2022010' => [],
            '2022011' => [195],
            '2022012' => [205],
        ]],
        ['str' => '11:35', 'end' => '11:45', 'event' => '休息 Break', 'isBroadCast' => false],
        ['str' => '11:45', 'end' => '12:30', 'event' => '', 'isBroadCast' => false, 'room' => [
            '2022013' => [214],
            '2022014' => [],
            '2022015' => [221],
            '2022016' => [197],
        ]],
        ['str' => '12:30', 'end' => '13:20', 'event' => '午餐 Lunch', 'isBroadCast' => false],
        ['str' => '13:20', 'end' => '14:05', 'event' => '', 'isBroadCast' => false, 'room' => [
            '2022017' => [],
            '2022018' => [203],
            '2022019' => [196],
            '2022020' => [227],
        ]],
        ['str' => '14:05', 'end' => '14:15', 'event' => '休息 Break', 'isBroadCast' => false],
        ['str' => '14:15', 'end' => '15:00', 'event' => '', 'isBroadCast' => false, 'room' => [
            '2022021' => [228],
            '2022022' => [240],
            '2022023' => [201],
            '2022024' => [241],
        ]],
        ['str' => '15:00', 'end' => '15:10', 'event' => '休息 Break', 'isBroadCast' => false],
        ['str' => '15:10', 'end' => '15:55', 'event' => '', 'isBroadCast' => false, 'room' => [
            '2022025' => [199],
            '2022026' => [206],
            '2022027' => [211],
            '2022028' => [226],
        ]],
        ['str' => '15:55', 'end' => '16:05', 'event' => '休息 Break', 'isBroadCast' => false],
        ['str' => '16:05', 'end' => '16:50', 'event' => '', 'isBroadCast' => false, 'room' => [
            '2022029' => [212],
            '2022030' => [215],
            '2022031' => [200],
            '2022032' => [216],
        ]],
        ['str' => '16:50', 'end' => '17:00', 'event' => '休息 Break', 'isBroadCast' => false],
        ['str' => '17:00', 'end' => '17:45', 'event' => '', 'isBroadCast' => false, 'room' => [
            '2022033' => [233],
        ]],
        ['str' => '17:45', 'isBroadCast' => false, 'event' => 'END'],
        ['str' => '18:30', 'isBroadCast' => false, 'event' => 'MOPNight(講者晚宴)'],
    ],
    '2022-10-16' => [
        ['str' => '09:00', 'end' => '10:00', 'event' => '', 'isBroadCast' => false, 'room' => [
            '2022037' => [217],
        ]],
        ['str' => '10:00', 'end' => '10:10', 'event' => '休息 Break', 'isBroadCast' => false],
        ['str' => '10:10', 'end' => '10:55', 'event' => '', 'isBroadCast' => false, 'room' => [
            '2022041' => [247, 248],
            '2022042' => [220],
            '2022043' => [209],
            '2022044' => [238, 239],
        ]],
        ['str' => '10:55', 'end' => '11:05', 'event' => '休息 Break', 'isBroadCast' => false],
        ['str' => '11:05', 'end' => '11:50', 'event' => '', 'isBroadCast' => false, 'room' => [
            '2022045' => [208],
            '2022046' => [],
            '2022047' => [232],
            '2022048' => [234],
        ]],
        ['str' => '11:50', 'end' => '12:50', 'event' => '午餐 Lunch', 'isBroadCast' => false],
        ['str' => '12:50', 'end' => '13:35', 'event' => '', 'isBroadCast' => false, 'room' => [
            '2022049' => [224],
            '2022050' => [235],
            '2022051' => [218],
            '2022052' => [229],
        ]],
        ['str' => '13:35', 'end' => '13:45', 'event' => '休息 Break', 'isBroadCast' => false],
        ['str' => '13:45', 'end' => '14:30', 'event' => '', 'isBroadCast' => false, 'room' => [
            '2022053' => [204],
            '2022054' => [207],
            '2022055' => [230],
            '2022056' => [223],
        ]],
        ['str' => '14:30', 'end' => '14:40', 'event' => '休息 Break', 'isBroadCast' => false],
        ['str' => '14:40', 'end' => '15:25', 'event' => '', 'isBroadCast' => false, 'room' => [
            '2022057' => [198],
            '2022058' => [231],
            '2022059' => [213],
            '2022060' => [219],
        ]],
        ['str' => '15:25', 'end' => '15:35', 'event' => '休息 Break', 'isBroadCast' => false],
        ['str' => '15:35', 'end' => '16:45', 'event' => '', 'isBroadCast' => false, 'room' => [
            '2022061' => [],
        ]],
        ['str' => '16:45', 'end' => '16:55', 'event' => '休息 Break', 'isBroadCast' => false],
        ['str' => '16:55', 'end' => '17:30', 'event' => '閃電秀 Lightning Talk', 'isBroadCast' => false],
        ['str' => '17:30', 'end' => '17:45', 'event' => '閉幕 Closing', 'isBroadCast' => false],
        ['str' => '17:45', 'isBroadCast' => false, 'event' => 'END']
    ]
];

$arrange = [];
$mappingSpeaker = function ($session_id, $speaker_ids, array $speakersArr, $room_number) {
    // default
    $tmpRoom = [
        'session_id' => $session_id,
        'room' => $room_number,
        'topic' => 'Coming Soon',
        'topic_e' => '',
        'summary' => '',
        'summary_e' => '',
        'is_keynote' => false,
        'is_online' => false,
        'recordable' => true,
        'level' => '',
        'target' => '',
        'prior_knowledge' => '',
        'expected_gain' => '',
        'tags' => [],
    ];
    foreach ($speaker_ids as $speaker_id) {
        $index = $speaker_id - 195;
        $tmpRoom = [
            'session_id' => $session_id,
            'room' => $room_number,
            'topic' => $speakersArr[$index]['topic'] ?? 'Coming Soon',
            'topic_e' => $speakersArr[$index]['topic_e'] ?? '',
            'summary' => $speakersArr[$index]['summary'] ?? '',
            'summary_e' => $speakersArr[$index]['summary_e'] ?? '',
            'is_keynote' => $speakersArr[$index]['is_keynote'] ?? false,
            'is_online' => $speakersArr[$index]['is_online'] ?? false,
            'recordable' => $speakersArr[$index]['recordable'] ?? true,
            'level' => $speakersArr[$index]['level'] ?? '',
            'target' => $speakersArr[$index]['target'] ?? '',
            'target_e' => $speakersArr[$index]['target_e'] ?? '',
            'prior_knowledge' => $speakersArr[$index]['prior_knowledge'] ?? '',
            'prior_knowledge_e' => $speakersArr[$index]['prior_knowledge_e'] ?? '',
            'expected_gain' => $speakersArr[$index]['expected_gain'] ?? '',
            'expected_gain_e' => $speakersArr[$index]['expected_gain_e'] ?? '',
            'tags' => $speakersArr[$index]['tags'] ?? [],
        ];
        $speakers[] = [
            'speaker_id' => $speaker_id ?? 0,
            'name' => $speakersArr[$index]['name'] ?? '',
            'name_e' => $speakersArr[$index]['name_e'] ?? '',
            'job_title' => $speakersArr[$index]['job_title'] ?? '',
            'job_title_e' => $speakersArr[$index]['job_title_e'] ?? '',
            'company' => $speakersArr[$index]['company'] ?? '',
            'company_e' => $speakersArr[$index]['company_e'] ?? '',
            'img' => $speakersArr[$index]['img'] ?? ['web' => '', 'mobile' => ''],
            'link_github' => $speakersArr[$index]['link_github'] ?? '',
            'link_twitter' => $speakersArr[$index]['link_twitter'] ?? '',
            'link_other' => $speakersArr[$index]['link_other'] ?? '',
            'link_fb' => $speakersArr[$index]['link_fb'] ?? '',
        ];
        $tmpRoom['speakers'] = $speakers ?? [];
    }
    return $tmpRoom;
};

$speakersArr = json_decode($string, true);
// because array index is from 0, but speaker id is from 1
array_unshift($speakersArr, []);
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
                $room_number = "R" . ($session_count % 4 == 0 ? 4 : $session_count % 4);
                $room[] = $mappingSpeaker($session_id, $speaker_ids, $speakersArr, $room_number);
                // 將對應資料存回講者
                foreach ($speaker_ids as $speaker_id) {
                    $index = $speaker_id - 194;
                    $speakersArr[$index]['room'] = $room_number;
                    $speakersArr[$index]['started_at'] = $started_at;
                    $speakersArr[$index]['ended_at'] = $ended_at;
                    $speakersArr[$index]['session_id'] = $session_id;
                }
            }
        }
        $day["period"][] = [
            'started_at' => $started_at,
            'isBroadCast' => true,
            'ended_at' => $ended_at,
            'event' => $session['event'] ?? '',
            'room' => $room,
        ];
    }
    $arrange[] = $day;
}
// remove first empty element
array_shift($speakersArr);

file_put_contents('./schedule.json', json_encode(array_values($arrange), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
file_put_contents('./speakers.json', json_encode(array_values($speakersArr), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
