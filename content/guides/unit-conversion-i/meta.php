<?php
declare(strict_types=1);

return [
    'title' => 'Unit Conversion I: multiply down the tree',
    'leetcode' => 3528,
    'difficulty' => 'Med',
    'summary' => 'The conversions form a tree rooted at unit 0. Walk it with BFS or DFS: each child’s value is its parent’s value times the factor, mod 10^9 + 7.',
    'category' => 'LeetCode',
    'subcategory' => 'Graph',
    'topic' => 'LeetCode · Graph',
    'kind' => 'algo',
    'tags' => ['depth-first-search', 'breadth-first-search', 'graph', 'leetcode'],
    'related_session' => 'unit-conversion-i',
];
