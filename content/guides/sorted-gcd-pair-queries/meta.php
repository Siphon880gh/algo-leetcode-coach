<?php
declare(strict_types=1);

return [
    'title' => 'Sorted GCD Pair Queries: exact-gcd pair counts, then prefix search',
    'leetcode' => 3312,
    'difficulty' => 'Hard',
    'summary' => 'For each g from the largest value down, pairs whose gcd is a multiple of g number C(c, 2), where c counts multiples of g. Subtract the counts for 2g, 3g, … to get exact gcd g, prefix-sum, and binary search each query.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'kind' => 'algo',
    'tags' => ['array', 'hash-table', 'math', 'binary-search', 'combinatorics', 'counting', 'number-theory', 'prefix-sum', 'leetcode'],
    'related_session' => 'sorted-gcd-pair-queries',
];
