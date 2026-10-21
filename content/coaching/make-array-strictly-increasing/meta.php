<?php
declare(strict_types=1);

return [
    'title' => 'Make Array Strictly Increasing: map of last value to operations',
    'leetcode' => 1187,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: sort and dedupe arr2, keep a map from the last value to the fewest operations, and at each index either keep arr1[i] or replace it with the next larger arr2 value. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'make-array-strictly-increasing',
    'tags' => ['dynamic-programming', 'binary-search', 'sorting', 'step-by-step'],
];
