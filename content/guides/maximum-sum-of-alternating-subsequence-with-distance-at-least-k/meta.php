<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Sum of Alternating Subsequence With Distance at Least K: DP with two Fenwick trees',
    'leetcode' => 3915,
    'difficulty' => 'Hard',
    'summary' => 'up[i] is the best sum ending at i after a step up, down[i] after a step down. Index j becomes usable once i − j ≥ k; insert it then into a prefix-max Fenwick tree by value and a suffix-max one.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['segment-tree', 'array', 'dynamic-programming', 'leetcode'],
    'related_session' => 'maximum-sum-of-alternating-subsequence-with-distance-at-least-k',
];
