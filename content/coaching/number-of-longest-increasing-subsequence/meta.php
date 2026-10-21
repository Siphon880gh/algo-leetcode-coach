<?php
declare(strict_types=1);

return [
    'title' => 'Number of Longest Increasing Subsequence: replace or add counts',
    'leetcode' => 673,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: keep a length and a count per index, replace the count on a longer extension, add on a tie, then sum over the maximum length. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'number-of-longest-increasing-subsequence',
    'tags' => ['dynamic-programming', 'arrays', 'step-by-step'],
];
