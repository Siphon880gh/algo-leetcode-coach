<?php
declare(strict_types=1);

return [
    'title' => 'Difference Between Maximum and Minimum Price Sum: drop one endpoint, tree DP',
    'leetcode' => 2538,
    'difficulty' => 'Hard',
    'summary' => 'Prices are positive, so the cheapest path from a root is the root alone, and the cost is the best path from it minus the root’s price. Over all roots that is the best path with one endpoint removed; a DP keeping each node’s best downward path with and without its far end finds it.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'kind' => 'algo',
    'tags' => ['array', 'dynamic-programming', 'tree', 'depth-first-search', 'leetcode'],
    'related_session' => 'difference-between-maximum-and-minimum-price-sum',
];
