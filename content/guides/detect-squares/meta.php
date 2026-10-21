<?php
declare(strict_types=1);

return [
    'title' => 'Detect Squares: count points, enumerate diagonals',
    'leetcode' => 2013,
    'difficulty' => 'Med',
    'summary' => 'Store a count per point. For a query (x, y), every stored point (a, b) with |a − x| = |b − y| > 0 is a diagonal corner; multiply its count by the counts of (a, y) and (x, b).',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'kind' => 'algo',
    'tags' => ['design', 'hash-table', 'counting', 'leetcode'],
    'related_session' => 'detect-squares',
];
