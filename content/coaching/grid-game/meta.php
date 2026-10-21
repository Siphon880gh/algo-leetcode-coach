<?php
declare(strict_types=1);

return [
    'title' => 'Grid Game: minimise the larger leftover',
    'leetcode' => 2017,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: for each turn column, robot 2 takes max(top suffix, bottom prefix); minimise over columns in 64-bit. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Prefix Sum',
    'topic' => 'LeetCode · Prefix Sum',
    'related_guide' => 'grid-game',
    'tags' => ['prefix-sum', 'array', 'matrix', 'step-by-step'],
];
