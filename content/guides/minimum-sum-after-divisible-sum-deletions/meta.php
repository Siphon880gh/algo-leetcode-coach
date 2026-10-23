<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Sum After Divisible Sum Deletions: DP over prefix remainders',
    'leetcode' => 3654,
    'difficulty' => 'Med',
    'summary' => 'Deleted pieces always add up to a multiple of k, so the kept elements are what is left after removing disjoint blocks with sums ≡ 0. f[i] = min(f[i − 1] + a[i], best f at an earlier prefix with the same remainder).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'hash-table', 'dynamic-programming', 'prefix-sum', 'leetcode'],
    'related_session' => 'minimum-sum-after-divisible-sum-deletions',
];
