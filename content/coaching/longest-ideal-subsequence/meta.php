<?php
declare(strict_types=1);

return [
    'title' => 'Longest Ideal Subsequence: 26 states, clipped window, include the same letter',
    'leetcode' => 2370,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: keep one value per last letter, clip the window at a and z, and include the same letter in it. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'longest-ideal-subsequence',
    'tags' => ['hash-table', 'string', 'dynamic-programming', 'step-by-step'],
];
