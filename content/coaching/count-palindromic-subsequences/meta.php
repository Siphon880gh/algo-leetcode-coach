<?php
declare(strict_types=1);

return [
    'title' => 'Count Palindromic Subsequences: mirrored pair after, strictly before the middle',
    'leetcode' => 2484,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: match a b before the middle with b a after it, and keep the before-table to indices strictly left of the middle. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'count-palindromic-subsequences',
    'tags' => ['string', 'dynamic-programming', 'step-by-step'],
];
