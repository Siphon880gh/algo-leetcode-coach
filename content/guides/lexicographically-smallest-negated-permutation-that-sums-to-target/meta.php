<?php
declare(strict_types=1);

return [
    'title' => 'Lexicographically Smallest Negated Permutation that Sums to Target: negate the largest first',
    'leetcode' => 3752,
    'difficulty' => 'Med',
    'summary' => 'With all signs +, the sum is S = n(n + 1)/2. Negating a set of total D gives S − 2D, so D = (S − target)/2. Pick the negated set greedily from n down, put the negatives first (largest magnitude first), then the positives in increasing order.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'array', 'math', 'two-pointers', 'sorting', 'leetcode'],
    'related_session' => 'lexicographically-smallest-negated-permutation-that-sums-to-target',
];
