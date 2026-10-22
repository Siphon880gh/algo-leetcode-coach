<?php
declare(strict_types=1);

return [
    'title' => 'Count the Number of K-Free Subsets: chains mod k, house robber',
    'leetcode' => 2638,
    'difficulty' => 'Med',
    'summary' => 'Only values with the same remainder mod k can clash. Within a remainder class, sort the values; consecutive ones that differ by exactly k form a chain where adjacent picks are forbidden, which is a house-robber count. Multiply the counts of all classes.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'math', 'dynamic-programming', 'combinatorics', 'sorting', 'leetcode'],
    'related_session' => 'count-the-number-of-k-free-subsets',
];
