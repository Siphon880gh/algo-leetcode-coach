<?php
declare(strict_types=1);

return [
    'title' => 'Substring With Largest Variance: Kadane per ordered pair',
    'leetcode' => 2272,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: score only windows holding the minor letter, reset only while another one remains, and try both orders of each pair. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'substring-with-largest-variance',
    'tags' => ['hash-table', 'string', 'dynamic-programming', 'enumeration', 'step-by-step'],
];
