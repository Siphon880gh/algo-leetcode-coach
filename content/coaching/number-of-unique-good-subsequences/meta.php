<?php
declare(strict_types=1);

return [
    'title' => 'Number of Unique Good Subsequences: end-in-1 and end-in-0 counts',
    'leetcode' => 1987,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: on 1 set e1 = e1 + e0 + 1, on 0 set e0 = e1 + e0, add 1 for a lone 0. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'number-of-unique-good-subsequences',
    'tags' => ['dynamic-programming', 'string', 'step-by-step'],
];
