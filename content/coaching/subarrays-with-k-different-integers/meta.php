<?php
declare(strict_types=1);

return [
    'title' => 'Subarrays with K Different Integers: exactly from at most',
    'leetcode' => 992,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: exactly k distinct = atMost(k) − atMost(k − 1), and atMost is a sliding window that adds right − left + 1 at each step. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'related_guide' => 'subarrays-with-k-different-integers',
    'tags' => ['sliding-window', 'hash-table', 'two-pointers', 'step-by-step'],
];
