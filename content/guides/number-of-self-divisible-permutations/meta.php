<?php
declare(strict_types=1);

return [
    'title' => 'Number of Self-Divisible Permutations: bitmask over used values',
    'leetcode' => 2992,
    'difficulty' => 'Med',
    'summary' => 'Fill positions in order. With a mask of used values, the next position is popcount(mask) + 1, so f[mask] counts the ways to reach it and each unused coprime value extends it.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['bit-manipulation', 'array', 'math', 'dynamic-programming', 'backtracking', 'bitmask', 'number-theory', 'leetcode'],
    'related_session' => 'number-of-self-divisible-permutations',
];
