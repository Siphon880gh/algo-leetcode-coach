<?php
declare(strict_types=1);

return [
    'title' => 'Campus Bikes II: bitmask DP',
    'leetcode' => 1066,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: let a bitmask record the bikes taken, assign workers in order so popcount(mask) names the next worker, and relax dp over unused bikes. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'campus-bikes-ii',
    'tags' => ['dynamic-programming', 'bitmask', 'step-by-step'],
];
