<?php
declare(strict_types=1);

return [
    'title' => 'Minimum ASCII Delete Sum for Two Strings: weighted deletions',
    'leetcode' => 712,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: dp over suffixes, keep equal characters for free, delete one side at its ASCII cost, and seed the borders with full sums. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'minimum-ascii-delete-sum-for-two-strings',
    'tags' => ['dynamic-programming', 'strings', 'step-by-step'],
];
