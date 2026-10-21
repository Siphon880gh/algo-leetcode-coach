<?php
declare(strict_types=1);

return [
    'title' => 'Minimize the Difference Between Target and Chosen Elements: bounded reachable sums',
    'leetcode' => 1981,
    'difficulty' => 'Med',
    'summary' => 'Keep the set of reachable sums row by row. Sums above target only matter through the smallest one, so keep all sums ≤ target plus the single smallest sum above it.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'matrix', 'leetcode'],
    'related_session' => 'minimize-the-difference-between-target-and-chosen-elements',
];
