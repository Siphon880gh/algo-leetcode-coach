<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Unlocked Indices to Sort Nums: spans that must open',
    'leetcode' => 3431,
    'difficulty' => 'Med',
    'summary' => 'A 3 can never pass a 1, so a 3 before a 1 means −1. Otherwise every 2 must cross every later 1, and every 3 must cross every later 2: unlock each locked index in [first 2, last 1) and in [first 3, last 2).',
    'category' => 'LeetCode',
    'subcategory' => 'Arrays',
    'topic' => 'LeetCode · Arrays',
    'kind' => 'algo',
    'tags' => ['array', 'hash-table', 'leetcode'],
    'related_session' => 'minimum-unlocked-indices-to-sort-nums',
];
