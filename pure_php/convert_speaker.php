<?php

/**
 * $ php convert_speaker.php speakers.tsv speaker.json
 */

$tagTrans = [
    'ai'                     => 'AI',
    'arvr'                   => 'AR/VR',
    'blockchain'             => 'Blockchain',
    'cloud_service'          => 'Cloud Service',
    'devops'                 => 'DevOps',
    'iot'                    => 'IoT',
    'mobile_app'             => 'Mobile App',
    'startup'                => 'Startup',
    'ui/ux'                  => 'UI/UX',
    'web_development'        => 'Web Development',
    'web3'                   => 'Web3',
    'quant'                  => 'Quant',
    'security'               => 'Security',
    'cross_platform'         => 'Cross-platform',
    'data_science'           => 'Data Science',
    'domain_driven_design'   => 'Domain-Driven Design',
    'agile'                  => 'Agile',
    'panel'                  => 'Panel',
    'project_management'     => 'Project Management',
    'fin_tech'               => 'FinTech',
    'qa'                     => 'QA',
    'data_analyzing'         => 'Data Analyzing',
    '5g/6g'                  => '5G / 6G',
    'business_thinking'      => 'Business Thinking',
    'social_engagement'      => '社會參與',
    'career_development'     => '職涯發展',
    'digital_transformation' => '數位轉型',
    'remote_work'            => '遠距',
    'community'              => 'Community',
    'open_source'            => 'Open Source',
];

$tagCollect = [];

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

    if (!in_array(trim($result[46]), ['關閉前台修改', '已確認'])) {
        continue;
    }

    array_walk_recursive($result, function (&$value) {
        $value = str_replace(array('\\x22', '\\x27', '\\n'), array("'", '"', "\n"), $value);
    });

    echo $result[1];

    echo "\n";
    // tag filter empty
    $result[28] = $result[28] == '' ? [] : explode(',', $result[28]);
    // convert keynote
    $result[48] = $result[48] === '是';
    // tags transform
    $tags = $result[28];
    $tagItem = [];
    foreach ($tags as $tagKey => $tag) {
         //convert tag
        $tag = strtolower($tag);
        $tag = preg_replace('/ /', '_', $tag);
        $tag = preg_replace('/-/', '_', $tag);

        $tagSet = [
            'color' => [
                'web' => "#51A3D3",
                'mobile' => "#51A3D3"
            ],
            'name' => $tagTrans[$tag]
        ];
        $tagItem[] = $tagSet;
        if (!isset($tagCollect[$tag])) {
            $tagCollect[$tag] = $tagSet;
        }
    }
    $newData = [
        'name' => $result[1],
        'name_e' => $result[2],
        'speaker_id' => $speaker_id,
        'company' => $result[4],
        'company_e' => $result[5],
        'job_title' => $result[6],
        'job_title_e' => $result[7],
        'bio' => $result[11],
        'bio_e' => $result[12],
        'img' =>
        [
            'web' => 'api/'. date('Y') .'/speaker/images/speaker_' . (string) $speaker_id,
            'mobile' => 'api/'. date('Y') .'/speaker/images/speaker_' . (string) $speaker_id
        ],
        'link_fb' => $result[14],
        'link_github' => $result[15],
        'link_twitter' => $result[16],
        'link_other' => $result[17],
        'link_slide' => '', //$result[18],
        'topic' => $result[24],
        'topic_e' => $result[25],
        'summary' => $result[26],
        'summary_e' => $result[27],
        "community_partner" => "",
        'is_keynote' => $result[48],
        "is_online" => false,
        'recordable' => true, //$result[33] == '否' ? false : true,
        'level' => explode('-', $result[29])[0],
        'tags' => $tagItem,
        'target' => $result[30], // 目標會眾
        'target_e' => $result[31], // 目標會眾(英文)
        'prior_knowledge' => $result[32], // 先備知識
        'prior_knowledge_e' => $result[33], // 先備知識(英文)
        'expected_gain' => $result[34], // 預期收穫
        'expected_gain_e' => $result[35] // 預期收穫(英文)
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
file_put_contents(str_replace('.json', '-tags.json', $target), json_encode(array_values($tagCollect), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
