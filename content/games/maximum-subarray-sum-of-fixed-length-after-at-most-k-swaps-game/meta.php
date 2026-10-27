<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Subarray Sum of Fixed Length After At Most K Swaps',
    'leetcode' => 4087,
    'difficulty' => 'Med',
    'summary' => 'Fix the window. Each useful swap trades one inside value for one outside value, so sort the inside ascending and the outside descending, then trade while outside[j] − inside[j] is positive, up to k trades. Try every window.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'tags' => ['greedy', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-subarray-sum-of-fixed-length-after-at-most-k-swaps',
    'related_session' => 'maximum-subarray-sum-of-fixed-length-after-at-most-k-swaps',
];
