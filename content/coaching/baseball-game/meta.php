<?php
declare(strict_types=1);

return [
    'title' => 'Baseball Game: keep valid scores on a stack',
    'leetcode' => 682,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: push numbers, + pushes the top two summed, D pushes double the top, C pops, and the answer is the stack sum. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Stack',
    'topic' => 'LeetCode · Stack',
    'related_guide' => 'baseball-game',
    'tags' => ['stack', 'simulation', 'step-by-step'],
];
