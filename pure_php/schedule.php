<?php

date_default_timezone_set('Asia/Taipei');
$roomTemplate = [
    'session_id' => 0,
    'speaker_id' => 0,
];
$schedule = [
    '2020-10-24' => [
        ['str' => '08:30', 'end' => '09:05', 'event' => '報到 Registration', 'isBroadCast' => false],
        ['str' => '09:05', 'end' => '09:20', 'event' => '開幕 Opening', 'isBroadCast' => false],
        ['str' => '09:20', 'end' => '10:00', 'event' => '', 'isBroadCast' => false, 'room' => [
            // '2020001' => 27,
            '2020002' => 27,
            '2020003' => 28,
        ]],
        ['str' => '10:00', 'end' => '10:15', 'event' => '休息 Break', 'isBroadCast' => false],
        ['str' => '10:15', 'end' => '10:55', 'event' => '', 'isBroadCast' => false, 'room' => [
            // '2020004' => 3,
            '2020005' => 3,
            '2020006' => 43,
        ]],
        ['str' => '10:55', 'end' => '11:10', 'event' => '休息 Break', 'isBroadCast' => false],
        ['str' => '11:10', 'end' => '11:50', 'event' => '', 'isBroadCast' => false, 'room' => [
            '2020007' => 26,
            '2020008' => 42,
            '2020009' => 32,
        ]],
        ['str' => '11:50', 'end' => '13:00', 'event' => '午餐 Lunch', 'isBroadCast' => false],
        ['str' => '13:00', 'end' => '13:40', 'event' => 'BoF', 'isBroadCast' => false],
        ['str' => '13:40', 'end' => '13:55', 'event' => '休息 Break', 'isBroadCast' => false],
        ['str' => '13:55', 'end' => '14:35', 'event' => '', 'isBroadCast' => false, 'room' => [
            '2020010' => 41,
            '2020011' => 20,
            // '2020012' => 19,
        ]],
        ['str' => '14:35', 'end' => '14:50', 'event' => '休息 Break', 'isBroadCast' => false],
        ['str' => '14:50', 'end' => '15:30', 'event' => '', 'isBroadCast' => false, 'room' => [
            // '2020013' => 36,
            '2020014' => 36,
            // '2020015' => 36,
        ]],
        ['str' => '15:30', 'end' => '16:00', 'event' => '下午茶 Afternoon tea', 'isBroadCast' => false],
        ['str' => '16:00', 'end' => '16:40', 'event' => '', 'isBroadCast' => false, 'room' => [
            '2020016' => 49,
            '2020017' => 35,
            // '2020018' => 35,
        ]],
        ['str' => '16:40', 'end' => '16:55', 'event' => '休息 Break', 'isBroadCast' => false],
        ['str' => '16:55', 'end' => '17:35', 'event' => '', 'isBroadCast' => false, 'room' => [
            '2020019' => 2,
            '2020020' => 53,
            // '2020021' => 5,
        ]],
        ['isBroadCast' => false, 'event' => 'END'],
        ['isBroadCast' => false, 'event' => '講者晚宴 Speakers Dinner'],
    ],
    '2020-10-25' => [
        ['str' => '08:30', 'end' => '09:05', 'event' => '報到 Registration', 'isBroadCast' => false],
        ['str' => '09:05', 'end' => '09:20', 'event' => '事項宣達 Announcement', 'isBroadCast' => false],
        ['str' => '09:20', 'end' => '10:00', 'event' => '', 'isBroadCast' => false, 'room' => [
            '2020022' => 21,
            '2020023' => 4,
            '2020024' => 34,
        ]],
        ['str' => '10:00', 'end' => '10:15', 'event' => '休息 Break', 'isBroadCast' => false],
        ['str' => '10:15', 'end' => '10:55', 'event' => '', 'isBroadCast' => false, 'room' => [
            '2020025' => 39,
            // '2020026' => 28,
            '2020027' => 30,
        ]],
        ['str' => '10:55', 'end' => '11:10', 'event' => '休息 Break', 'isBroadCast' => false],
        ['str' => '11:10', 'end' => '11:50', 'event' => '', 'isBroadCast' => false, 'room' => [
            '2020028' => 29,
            '2020029' => 18,
            '2020030' => 25,
        ]],
        ['str' => '11:50', 'end' => '13:00', 'event' => '午餐 Lunch', 'isBroadCast' => false],
        ['str' => '13:00', 'end' => '13:40', 'event' => '', 'isBroadCast' => false, 'room' => [
            '2020031' => 23,
            '2020032' => 22,
            '2020033' => 38,
        ]],
        ['str' => '13:40', 'end' => '13:55', 'event' => '休息 Break', 'isBroadCast' => false],
        ['str' => '13:55', 'end' => '14:35', 'event' => '', 'isBroadCast' => false, 'room' => [
            '2020034' => 40,
            '2020035' => 33,
            '2020036' => 37,
        ]],
        ['str' => '14:35', 'end' => '14:50', 'event' => '休息 Break', 'isBroadCast' => false],
        ['str' => '14:50', 'end' => '15:30', 'event' => '', 'isBroadCast' => false, 'room' => [
            '2020037' => 1,
            '2020038' => 19,
            '2020039' => 31,
        ]],
        ['str' => '15:30', 'end' => '16:00', 'event' => '下午茶 Afternoon tea', 'isBroadCast' => false],
        ['str' => '16:00', 'end' => '17:00', 'event' => '', 'isBroadCast' => false, 'room' => [
            '2020040' => [44, 45, 46],
            // ['2020041' => 28],
            // ['2020042' => 28],
        ]],
        ['str' => '17:00', 'end' => '17:10', 'event' => '休息 Break', 'isBroadCast' => false],
        ['str' => '17:10', 'end' => '17:30', 'event' => '閃電秀 Lightning Talk', 'isBroadCast' => false],
        ['str' => '17:30', 'end' => '17:45', 'event' => '閉幕 Closing', 'isBroadCast' => false],
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

file_put_contents('./time.json', json_encode(array_values($arrange), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
