<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Number of Coins for Fruits II: deque over the window',
    'leetcode' => 2969,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: f(i) = prices[i] + the minimum f over the next window, kept by a deque. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'minimum-number-of-coins-for-fruits-ii',
    'tags' => ['array', 'dynamic-programming', 'queue', 'monotonic-queue', 'heap', 'step-by-step'],
];
