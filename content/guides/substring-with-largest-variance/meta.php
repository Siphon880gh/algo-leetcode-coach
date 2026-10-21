<?php
declare(strict_types=1);

return [
    'title' => 'Substring With Largest Variance: Kadane for each pair of letters',
    'leetcode' => 2272,
    'difficulty' => 'Hard',
    'summary' => 'For each ordered pair (a, b) of letters, score a as +1 and b as −1 and run Kadane, counting a result only once the window holds a b. Reset only when the sum is negative and another b remains. Take the best over all pairs.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['hash-table', 'string', 'dynamic-programming', 'enumeration', 'leetcode'],
    'related_session' => 'substring-with-largest-variance',
];
