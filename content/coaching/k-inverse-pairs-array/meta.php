<?php
declare(strict_types=1);

return [
    'title' => 'K Inverse Pairs Array: insert the largest value',
    'leetcode' => 629,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: DP on (i, j), where placing i adds 0 to i − 1 pairs, then a sliding window over the previous row. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'k-inverse-pairs-array',
    'tags' => ['dynamic-programming', 'prefix-sum', 'math', 'step-by-step'],
];
