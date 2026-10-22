<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Value Sum by Placing Three Rooks I: keep a few candidates',
    'leetcode' => 3256,
    'difficulty' => 'Hard',
    'summary' => 'An optimal rook can always be swapped into its row’s top 3 cells and then its column’s top 3 among those. With at most 3 per row and column, each of the other two rooks blocks at most 5 candidates, so the best 11 suffice.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'dynamic-programming', 'enumeration', 'matrix', 'leetcode'],
    'related_session' => 'maximum-value-sum-by-placing-three-rooks-i',
];
