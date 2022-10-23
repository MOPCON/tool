<?php

date_default_timezone_set('Asia/Taipei');
$schedule = [
    '2022-10-15' => [
        ['str' => '09:30', 'end' => '10:00', 'room' => [
            'topic' => '歡迎現場報名',
            'speaker' => '',
            'org' => ''
        ]],
        ['str' => '10:00', 'end' => '10:30', 'room' => [
            'topic' => '歡迎現場報名',
            'speaker' => '',
            'org' => ''
        ]],
        ['str' => '10:30', 'end' => '11:00', 'room' => [
            'topic' => '歡迎現場報名',
            'speaker' => '',
            'org' => ''
        ]],
        ['str' => '11:00', 'end' => '11:30', 'room' => [
            'topic' => '歡迎現場報名',
            'speaker' => '',
            'org' => ''
        ]],
        ['str' => '11:30', 'end' => '12:00', 'room' => [
            'topic' => '歡迎現場報名',
            'speaker' => '',
            'org' => ''
        ]],
        ['str' => '12:00', 'end' => '12:30', 'room' => [
            'topic' => '歡迎現場報名',
            'speaker' => '',
            'org' => ''
        ]],
        ['str' => '12:30', 'end' => '13:20', 'event' => '午餐'],
        ['str' => '13:30', 'end' => '14:00', 'room' => [
            'topic' => '歡迎現場報名',
            'speaker' => '',
            'org' => ''
        ]],
        ['str' => '14:00', 'end' => '14:30', 'room' => [
            'topic' => '歡迎現場報名',
            'speaker' => '',
            'org' => ''
        ]],
        ['str' => '14:30', 'end' => '15:00', 'room' => [
            'topic' => '歡迎現場報名',
            'speaker' => '',
            'org' => ''
        ]],
        ['str' => '15:00', 'end' => '15:30', 'room' => [
            'topic' => '歡迎現場報名',
            'speaker' => '',
            'org' => ''
        ]],
        ['str' => '15:30', 'end' => '16:00', 'room' => [
            'topic' => '歡迎現場報名',
            'speaker' => '',
            'org' => ''
        ]],
        ['str' => '16:00', 'end' => '16:30', 'room' => [
            'topic' => '歡迎現場報名',
            'speaker' => '',
            'org' => ''
        ]],
        ['str' => '16:30', 'end' => '17:00', 'room' => [
            'topic' => '歡迎現場報名',
            'speaker' => '',
            'org' => ''
        ]],
        ['str' => '17:00', 'end' => '17:30', 'room' => [
            'topic' => '歡迎現場報名',
            'speaker' => '',
            'org' => ''
        ]],
    ],
    '2022-10-16' => [
        ['str' => '09:30', 'end' => '10:00', 'room' => [
            'topic' => '歡迎現場報名',
            'speaker' => '',
            'org' => ''
        ]],
        ['str' => '10:00', 'end' => '10:30', 'room' => [
            'topic' => '歡迎現場報名',
            'speaker' => '',
            'org' => ''
        ]],
        ['str' => '10:30', 'end' => '11:00', 'room' => [
            'topic' => '歡迎現場報名',
            'speaker' => '',
            'org' => ''
        ]],
        ['str' => '11:00', 'end' => '11:30', 'room' => [
            'topic' => '歡迎現場報名',
            'speaker' => '',
            'org' => ''
        ]],
        ['str' => '11:50', 'end' => '12:50', 'event' => '午餐'],
        ['str' => '13:00', 'end' => '13:30', 'room' => [
            'topic' => '歡迎現場報名',
            'speaker' => '',
            'org' => ''
        ]],
        ['str' => '13:30', 'end' => '14:00', 'room' => [
            'topic' => '歡迎現場報名',
            'speaker' => '',
            'org' => ''
        ]],
        ['str' => '14:00', 'end' => '14:30', 'room' => [
            'topic' => '歡迎現場報名',
            'speaker' => '',
            'org' => ''
        ]],
        ['str' => '14:30', 'end' => '15:00', 'room' => [
            'topic' => '歡迎現場報名',
            'speaker' => '',
            'org' => ''
        ]],
        ['str' => '15:00', 'end' => '15:30', 'room' => [
            'topic' => '歡迎現場報名',
            'speaker' => '',
            'org' => ''
        ]],
    ]
];

$arrange = [];
$unconf_id = (int) (date('Y') . '100');
foreach ($schedule as $date => $sessions) {
    $day = [
        "date" => (int) strtotime($date),
        "period" => []
    ];
    foreach ($sessions as $session) {
        $room = [];
        if (isset($session['room'])) {
            $name = [];
            if ($session['room']['speaker']) {
                $name[] = $session['room']['speaker'];
            }
            if ($session['room']['org']) {
                $name[] = $session['room']['org'];
            }
            $room = [
                "name" => !empty($name) ? implode(" - ", $name) : '敬請期待',
                "name_e" => '',
                "topic" => $session['room']['topic'] ?? '敬請期待',
                "topic_e" => '',
                "session_id" => $unconf_id++,
            ];
        }
        $day["period"][] = [
            'started_at' => isset($session['str']) ? (int) strtotime($date . ' ' . $session['str']) : 0,
            'ended_at' => isset($session['end']) ? (int) strtotime($date . ' ' . $session['end']) : 0,
            'event' => $session['event'] ?? '',
            'room' => $room,
        ];
    }
    $arrange[] = $day;
}

file_put_contents('./unconf.json', json_encode(array_values($arrange), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
