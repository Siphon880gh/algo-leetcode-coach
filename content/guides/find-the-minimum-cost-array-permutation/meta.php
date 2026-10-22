<?php
declare(strict_types=1);

return [
    'title' => 'Find the Minimum Cost Array Permutation: bitmask DP on a cycle',
    'leetcode' => 3149,
    'difficulty' => 'Hard',
    'summary' => 'The score walks a cycle, so rotations tie and the smallest answer starts with 0. Run a DP over (used mask, last) for the cheapest finish, then rebuild the path choosing the smallest next index that keeps the optimum.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['bit-manipulation', 'array', 'dynamic-programming', 'bitmask', 'leetcode'],
    'related_session' => 'find-the-minimum-cost-array-permutation',
];
