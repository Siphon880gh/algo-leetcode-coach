<?php
declare(strict_types=1);

return [
    'title' => 'Binary Trees With Factors: count trees per root value',
    'leetcode' => 823,
    'difficulty' => 'Med',
    'summary' => 'Sort the values. dp[x] counts trees rooted at x: 1 for the single node, plus dp[a] · dp[x / a] for every value a that divides x with x / a also present. Sum dp over all values, mod 10⁹ + 7.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'hash-map', 'sorting', 'math', 'leetcode'],
    'related_session' => 'binary-trees-with-factors',
];
