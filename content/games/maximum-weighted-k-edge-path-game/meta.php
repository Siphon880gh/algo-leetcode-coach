<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Weighted K-Edge Path',
    'leetcode' => 3543,
    'difficulty' => 'Med',
    'summary' => 'DP by number of edges: reach[j][v] is the set of path sums (all < t) of paths with exactly j edges ending at v. Extend every sum along each edge, drop sums at least t, and read the max at j = k.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-weighted-k-edge-path',
    'related_session' => 'maximum-weighted-k-edge-path',
];
