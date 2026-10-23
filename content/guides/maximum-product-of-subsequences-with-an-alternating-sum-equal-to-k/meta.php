<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Product of Subsequences With an Alternating Sum Equal to K: a set of reachable states',
    'leetcode' => 3509,
    'difficulty' => 'Hard',
    'summary' => 'A state is (alternating sum, sign of the next element, product). Products above limit collapse into one over value, because a later 0 can still bring the product back to 0. If |k| exceeds 12 · n, return −1.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'hash-table', 'dynamic-programming', 'leetcode'],
    'related_session' => 'maximum-product-of-subsequences-with-an-alternating-sum-equal-to-k',
];
