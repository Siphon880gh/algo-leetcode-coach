<?php
declare(strict_types=1);

return [
    'title' => 'Game Play Analysis I: GROUP BY player, MIN(event_date)',
    'leetcode' => 511,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: first login date per player. GROUP BY player_id with MIN(event_date) AS first_login. Sample → 1: 2016-03-01, 2: 2017-06-25, 3: 2016-03-02. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Database',
    'topic' => 'LeetCode · Database',
    'tags' => ['database', 'sql', 'aggregation', 'step-by-step'],
    'related_guide' => 'game-play-analysis-i',
];
