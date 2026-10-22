<?php
declare(strict_types=1);

return [
    'title' => 'Paths in Matrix Whose Sum Is Divisible by K: DP over remainders',
    'leetcode' => 2435,
    'difficulty' => 'Hard',
    'summary' => 'For each cell keep k counts: the number of paths reaching it with each remainder of the sum mod k. A cell combines the counts from above and from the left, shifted by its own value.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'dynamic-programming', 'matrix', 'leetcode'],
    'related_session' => 'paths-in-matrix-whose-sum-is-divisible-by-k',
];
