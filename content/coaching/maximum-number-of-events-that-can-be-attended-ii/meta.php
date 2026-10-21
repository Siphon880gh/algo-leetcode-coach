<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Number of Events That Can Be Attended II: DP with binary search',
    'leetcode' => 1751,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: sort by start; f(i, k) = max(skip, value + f(next(i), k − 1)) with next(i) the first event starting after end[i]. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'maximum-number-of-events-that-can-be-attended-ii',
    'tags' => ['dynamic-programming', 'binary-search', 'sorting', 'step-by-step'],
];
