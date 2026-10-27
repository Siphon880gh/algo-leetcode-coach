<?php
declare(strict_types=1);

return [
    'title' => 'Minimum K to Reduce Array Within Limit',
    'leetcode' => 3824,
    'difficulty' => 'Med',
    'summary' => 'nonPositive(k) = Σ ⌈x / k⌉ shrinks as k grows while k² grows, so the condition is monotone. Binary search the smallest k with Σ ⌈x / k⌉ ≤ k².',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'tags' => ['binary-search', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-k-to-reduce-array-within-limit',
    'related_session' => 'minimum-k-to-reduce-array-within-limit',
];
