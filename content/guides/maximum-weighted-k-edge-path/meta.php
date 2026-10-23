<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Weighted K-Edge Path: sets of reachable sums',
    'leetcode' => 3543,
    'difficulty' => 'Med',
    'summary' => 't ≤ 600, so for each node keep the set of sums below t reachable by paths with exactly j edges ending there (a bitset works). Extend every set along every edge k times.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['graph', 'hash-table', 'dynamic-programming', 'leetcode'],
    'related_session' => 'maximum-weighted-k-edge-path',
];
