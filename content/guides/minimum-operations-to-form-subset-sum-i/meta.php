<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Operations to Form Subset Sum I: 0-1 knapsack over reachable values',
    'leetcode' => 4040,
    'difficulty' => 'Med',
    'summary' => 'Multiplying a times and then dividing b times gives x · 2^(a − b) or ⌊x / 2^(b − a)⌋, which |a − b| operations reach directly. So each element offers x · 2^i or ⌊x / 2^i⌋ for i operations, and a knapsack picks at most one option per element.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'leetcode'],
    'related_session' => 'minimum-operations-to-form-subset-sum-i',
];
