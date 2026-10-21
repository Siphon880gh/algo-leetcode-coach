<?php
declare(strict_types=1);

return [
    'title' => 'Find Duplicate Subtrees: give each subtree a signature',
    'leetcode' => 652,
    'difficulty' => 'Med',
    'summary' => 'Serialize every subtree in post-order (value plus the children\'s signatures, with null markers), count the signatures in a map, and report a root the moment its signature is seen the second time.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'kind' => 'algo',
    'tags' => ['trees', 'dfs', 'hash-table', 'binary-tree', 'leetcode'],
    'related_session' => 'find-duplicate-subtrees',
];
