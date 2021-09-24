<?php

date_default_timezone_set('Asia/Taipei');
$roomTemplate = [
    'session_id' => 0,
    'speaker_id' => 0,
];
$schedule = [
    '2021-10-23' => [
        ['str' => '09:00', 'end' => '09:15', 'event' => '開幕 Opening', 'isBroadCast' => false],
        ['str' => '09:15', 'end' => '10:00', 'event' => '', 'isBroadCast' => false, 'room' => [
            '2021001' => 114,
        ]],
        ['str' => '10:00', 'end' => '10:10', 'event' => '休息 Break', 'isBroadCast' => false],
        ['str' => '10:10', 'end' => '10:55', 'event' => '', 'isBroadCast' => false, 'room' => [
            '2021002' => 106,
            '2021003' => 111,
            '2021004' => 110,
        ]],
        ['str' => '10:55', 'end' => '11:05', 'event' => '休息 Break', 'isBroadCast' => false],
        ['str' => '11:05', 'end' => '11:50', 'event' => '', 'isBroadCast' => false, 'room' => [
            '2021005' => 107,
            '2021006' => 140,
            '2021007' => 142,
        ]],
        ['str' => '11:50', 'end' => '13:00', 'event' => '午餐 Lunch', 'isBroadCast' => false],
        ['str' => '13:00', 'end' => '13:45', 'event' => '', 'isBroadCast' => false, 'room' => [
            '2021008' => 122,
            '2021009' => 144,
            '2021010' => 109,
        ]],
        ['str' => '13:45', 'end' => '13:55', 'event' => '休息 Break', 'isBroadCast' => false],
        ['str' => '13:55', 'end' => '14:40', 'event' => '', 'isBroadCast' => false, 'room' => [
            '2021011' => 113,
            '2021012' => 143,
            '2021013' => 191,
        ]],
        ['str' => '14:40', 'end' => '14:50', 'event' => '休息 Break', 'isBroadCast' => false],
        ['str' => '14:50', 'end' => '15:35', 'event' => '', 'isBroadCast' => false, 'room' => [
            '2021014' => 187,
            '2021015' => 139,
            '2021016' => 112,
        ]],
        ['str' => '15:35', 'end' => '15:45', 'event' => '休息 Break', 'isBroadCast' => false],
        ['str' => '15:45', 'end' => '16:30', 'event' => '', 'isBroadCast' => false, 'room' => [
            '2021017' => 116,
            '2021018' => 119,
            '2021019' => 105,
        ]],
        ['str' => '16:30', 'end' => '16:40', 'event' => '休息 Break', 'isBroadCast' => false],
        ['str' => '16:40', 'end' => '17:25', 'event' => '', 'isBroadCast' => false, 'room' => [
            // '2021020' => , // 贊助議程
            // '2021021' => , // 贊助議程
            // '2021022' => , // 贊助議程
        ]],
        ['isBroadCast' => false, 'event' => 'END'],
    ],
    '2021-10-24' => [
        ['str' => '09:00', 'end' => '10:10', 'event' => '', 'isBroadCast' => false, 'room' => [
            '2021023' => [186, 145, 185]
        ]],
        ['str' => '10:10', 'end' => '10:20', 'event' => '休息 Break', 'isBroadCast' => false],
        ['str' => '10:20', 'end' => '11:05', 'event' => '', 'isBroadCast' => false, 'room' => [
            '2021024' => 183,
            '2021025' => 138,
            '2021026' => 136,
        ]],
        ['str' => '11:05', 'end' => '11:15', 'event' => '休息 Break', 'isBroadCast' => false],
        ['str' => '11:15', 'end' => '12:00', 'event' => '', 'isBroadCast' => false, 'room' => [
            '2021027' => 188,
            '2021028' => 181,
            '2021029' => 117,
        ]],
        ['str' => '11:00', 'end' => '13:00', 'event' => '午餐 Lunch', 'isBroadCast' => false],
        ['str' => '13:00', 'end' => '13:45', 'event' => '', 'isBroadCast' => false, 'room' => [
            '2021030' => [186, 145, 185],
            '2021031' => 182,
            '2021032' => 189,
        ]],
        ['str' => '13:45', 'end' => '13:55', 'event' => '休息 Break', 'isBroadCast' => false],
        ['str' => '13:55', 'end' => '14:40', 'event' => '', 'isBroadCast' => false, 'room' => [
            // '2021033' => 113, // EMS 沒資料
            '2021034' => 137,
            '2021035' => 108,
        ]],
        ['str' => '14:40', 'end' => '14:50', 'event' => '休息 Break', 'isBroadCast' => false],
        ['str' => '14:50', 'end' => '15:35', 'event' => '', 'isBroadCast' => false, 'room' => [
            '2021036' => 115,
            '2021037' => 121,
            '2021038' => 141,
        ]],
        ['str' => '15:35', 'end' => '15:45', 'event' => '休息 Break', 'isBroadCast' => false],
        ['str' => '15:45', 'end' => '16:30', 'event' => '', 'isBroadCast' => false, 'room' => [
            '2021039' => 120,
        ]],
        ['str' => '16:30', 'end' => '16:40', 'event' => '休息 Break', 'isBroadCast' => false],
        ['str' => '16:40', 'end' => '17:00', 'event' => '閃電秀 Lightning Talk', 'isBroadCast' => false],
        ['str' => '17:00', 'end' => '17:15', 'event' => '閉幕 Closing', 'isBroadCast' => false],
        ['isBroadCast' => false, 'event' => 'END']
    ]
];

$arrange = [];
foreach ($schedule as $date => $sessions) {
    $day = [
        "date" => (int) strtotime($date),
        "period" => []
    ];
    foreach ($sessions as $session) {
        $room = [];
        if (isset($session['room'])) {
            foreach ($session['room'] as $session_id => $speaker_id) {
                $tmpRoom = [
                    'session_id' => $session_id,
                    'speaker_id' => $speaker_id
                ];
                $room[] = $tmpRoom;
            }
        }
        $day["period"][] = [
            'started_at' => isset($session['str']) ? (int) strtotime($date . ' ' . $session['str']) : 0,
            'isBroadCast' => false,
            'ended_at' => isset($session['end']) ? (int) strtotime($date . ' ' . $session['end']) : 0,
            'event' => $session['event'] ?? '',
            'room' => $room,
        ];
    }
    $arrange[] = $day;
}

file_put_contents('./schedule.json', json_encode(array_values($arrange), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
