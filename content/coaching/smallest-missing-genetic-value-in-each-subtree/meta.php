<?php
declare(strict_types=1);

return [
    'title' => 'Smallest Missing Genetic Value in Each Subtree: the path from value 1',
    'leetcode' => 2003,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: answer 1 off the path, then walk from the node holding 1 to the root, adding new subtree values and raising the missing pointer. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Tree',
    'topic' => 'LeetCode · Tree',
    'related_guide' => 'smallest-missing-genetic-value-in-each-subtree',
    'tags' => ['tree', 'dfs', 'hash-table', 'step-by-step'],
];
