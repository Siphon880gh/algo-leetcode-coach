<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Operations to Reduce an Integer to 0: runs of ones',
    'leetcode' => 2571,
    'difficulty' => 'Med',
    'summary' => 'Look at the low bits. If the lowest two bits are 11, add 1 (merges a run of ones); if only the lowest bit is 1, subtract 1. Each add/subtract is one operation; then shift right.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-operations-to-reduce-an-integer-to-0',
    'related_session' => 'minimum-operations-to-reduce-an-integer-to-0',
];
