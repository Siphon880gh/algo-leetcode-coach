<?php
declare(strict_types=1);

return [
    'title' => 'Number of Nodes With Value One: flip parity per node, push it down',
    'leetcode' => 2445,
    'difficulty' => 'Med',
    'summary' => 'Only the parity of how often each node is queried matters. A node’s final value is the XOR of those parities along the path from the root, so one pass from the root down computes every value.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'kind' => 'algo',
    'tags' => ['array', 'tree', 'depth-first-search', 'breadth-first-search', 'binary-tree', 'leetcode'],
    'related_session' => 'number-of-nodes-with-value-one',
];
