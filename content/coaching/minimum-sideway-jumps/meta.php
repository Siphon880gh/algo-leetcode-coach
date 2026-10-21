<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Sideway Jumps: three-lane DP',
    'leetcode' => 1824,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: dp per lane, starting [1, 0, 1]; at each point block the obstacle lane, then each free lane takes min(dp) + 1. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'minimum-sideway-jumps',
    'tags' => ['dynamic-programming', 'greedy', 'array', 'step-by-step'],
];
