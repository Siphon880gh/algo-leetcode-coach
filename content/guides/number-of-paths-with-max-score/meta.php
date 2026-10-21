<?php
declare(strict_types=1);

return [
    'title' => 'Number of Paths with Max Score: DP of (best, count)',
    'leetcode' => 1301,
    'difficulty' => 'Hard',
    'summary' => 'Fill from S at the bottom-right towards E at the top-left. Each cell takes the best score among its down, right, and down-right neighbours, adds its digit, and sums the path counts of every neighbour that achieves that best.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'matrix', 'leetcode'],
    'related_session' => 'number-of-paths-with-max-score',
];
