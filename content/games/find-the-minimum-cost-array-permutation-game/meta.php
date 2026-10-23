<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Cost Array Permutation: a cycle starting at 0',
    'leetcode' => 3149,
    'difficulty' => 'Hard',
    'summary' => 'score = Σ |perm[i] − nums[perm[i+1]]| around the cycle. Rotation does not change it, so start at 0. Bitmask DP f(mask, last) = cheapest finish; build the lexicographically smallest optimal order greedily.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'find-the-minimum-cost-array-permutation',
    'related_session' => 'find-the-minimum-cost-array-permutation',
];
