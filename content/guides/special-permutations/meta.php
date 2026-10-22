<?php
declare(strict_types=1);

return [
    'title' => 'Special Permutations: bitmask DP on the last element',
    'leetcode' => 2741,
    'difficulty' => 'Med',
    'summary' => 'Build permutations left to right with dp[mask][last] = ways to arrange the numbers in mask ending at last. Append j when it divides last or last divides it.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'dynamic-programming', 'bit-manipulation', 'bitmask', 'leetcode'],
    'related_session' => 'special-permutations',
];
