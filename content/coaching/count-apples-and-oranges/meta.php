<?php
declare(strict_types=1);

return [
    'title' => 'Count Apples and Oranges: boxes plus their chests',
    'leetcode' => 1715,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: LEFT JOIN boxes to chests on the chest id, then sum box counts plus IFNULL of chest counts. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'related_guide' => 'count-apples-and-oranges',
    'tags' => ['sql', 'join', 'step-by-step'],
];
