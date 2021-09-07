<?php

date_default_timezone_set('Asia/Taipei');
$schedule = [
    '2020-10-24' => [
        ['str' => '09:30', 'end' => '10:00', 'room' => [
            'topic' => '貴賓接待及記者會',
            'speaker' => '公關組',
            'org' => 'MOPCON'
        ]],
        ['str' => '10:00', 'end' => '10:30', 'room' => [
            'topic' => '歡迎現場報名',
            'speaker' => '',
            'org' => ''
        ]],
        ['str' => '10:30', 'end' => '11:00', 'room' => [
            'topic' => '本土化不只是翻譯，開發者的 Localization 踩坑紀錄',
            'speaker' => 'Bruno Chen',
            'org' => ''
        ]],
        ['str' => '11:00', 'end' => '11:30', 'room' => [
            'topic' => '用拖拉的方式來建立聊天機器人',
            'speaker' => '柯克',
            'org' => 'Chatbot 社群'
        ]],
        ['str' => '11:30', 'end' => '12:00', 'room' => [
            'topic' => 'MOPCON X Meet.jobs',
            'speaker' => 'Meet.jobs',
            'org' => 'MOPCON'
        ]],
        ['str' => '12:00', 'end' => '13:00', 'event' => '午餐'],
        ['str' => '13:00', 'end' => '13:30', 'event' => 'BOF'],
        ['str' => '13:30', 'end' => '14:00', 'room' => [
            'topic' => '開放資料的在地化與結構化',
            'speaker' => '朱庭宏',
            'org' => 'Wikidata 地方學專題社群'
        ]],
        ['str' => '14:00', 'end' => '14:30', 'room' => [
            'topic' => 'Taken - 即刻救援 / 勒索病毒威脅',
            'speaker' => 'Seven',
            'org' => 'PUMO'
        ]],
        ['str' => '14:30', 'end' => '15:00', 'room' => [
            'topic' => '那些軟體品質之間的量子糾纏',
            'speaker' => 'Yenchen Huang',
            'org' => 'KKBOX'
        ]],
        ['str' => '15:00', 'end' => '15:30', 'room' => [
            'topic' => '團隊中的敏捷設計師',
            'speaker' => '謝小雨',
            'org' => 'IxDA Taiwan'
        ]],
        ['str' => '15:30', 'end' => '16:00', 'event' => '下午茶'],
        ['str' => '16:00', 'end' => '16:30', 'room' => [
            'topic' => '如何從技術肥宅轉型成金融型男主管',
            'speaker' => '李健輔 Jeff',
            'org' => '國泰'
        ]],
        ['str' => '16:30', 'end' => '17:00', 'room' => [
            'topic' => 'GitLab Auto DevOps 大解析 - CI/CD 原來可以這樣做',
            'speaker' => 'Cheng Wei Chen',
            'org' => 'GitLab'
        ]],
        ['str' => '17:00', 'end' => '17:30', 'room' => [
            'topic' => 'GitLab Auto DevOps 大解析 - CI/CD 原來可以這樣做',
            'speaker' => 'Cheng Wei Chen',
            'org' => 'GitLab'
        ]],
    ],
    '2020-10-25' => [
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
            'topic' => 'Be the Change，一年6.6萬公里！開啟南台灣票證公司的敏捷旅程',
            'speaker' => 'Hermes',
            'org' => '高雄敏捷'
        ]],
        ['str' => '11:00', 'end' => '11:30', 'room' => [
            'topic' => '敬請期待',
            'speaker' => '敬請期待',
            'org' => 'Dakuo'
        ]],
        ['str' => '11:30', 'end' => '12:00', 'room' => [
            'topic' => '以 Kotlin 快速打造 Mobile Backend',
            'speaker' => '范聖佑',
            'org' => 'Kotlin 社群'
        ]],
        ['str' => '12:00', 'end' => '13:00', 'event' => '午餐'],
        ['str' => '13:00', 'end' => '13:30', 'room' => [
            'topic' => 'Vue Final Modal，開源專案分享',
            'speaker' => 'Hunter Liu',
            'org' => 'Vue.js Taiwan'
        ]],
        ['str' => '13:30', 'end' => '14:00', 'room' => [
            'topic' => '打造一個讓團隊成員勇敢做自己的「青色組織」之旅',
            'speaker' => 'Gipi',
            'org' => '商業思維學院'
        ]],
        ['str' => '14:00', 'end' => '14:30', 'room' => [
            'topic' => '歡迎現場報名',
            'speaker' => '',
            'org' => ''
        ]],
        ['str' => '14:30', 'end' => '15:00', 'room' => [
            'topic' => '軟體工程師養成計畫通',
            'speaker' => '廖洧杰',
            'org' => '火箭隊'
        ]],
        ['str' => '15:00', 'end' => '15:30', 'room' => [
            'topic' => '菜鳥工程師經驗談',
            'speaker' => '火箭隊學長姐們',
            'org' => '火箭隊'
        ]],
        ['str' => '15:30', 'end' => '16:00', 'event' => '下午茶'],
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
