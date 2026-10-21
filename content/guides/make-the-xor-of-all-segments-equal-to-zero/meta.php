<?php
declare(strict_types=1);

return [
    'title' => 'Make the XOR of All Segments Equal to Zero: DP over position classes',
    'leetcode' => 1787,
    'difficulty' => 'Hard',
    'summary' => 'All size-k windows XOR to 0 iff nums is k-periodic with the first k XORing to 0. Group indices by i mod k; dp[x] = min changes for the first groups to XOR to x. Each group either takes a value already in it (cost size − count) or any value (cost size, from the best previous state).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'bit-manipulation', 'leetcode'],
    'related_session' => 'make-the-xor-of-all-segments-equal-to-zero',
];
