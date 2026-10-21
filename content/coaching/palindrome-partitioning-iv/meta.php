<?php
declare(strict_types=1);

return [
    'title' => 'Palindrome Partitioning IV: palindrome table plus two cuts',
    'leetcode' => 1745,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: fill isPal[i][j] bottom-up, then try every pair of cuts and check the three pieces. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'palindrome-partitioning-iv',
    'tags' => ['dynamic-programming', 'string', 'step-by-step'],
];
