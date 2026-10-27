<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Operations to Stabilize a Binary Tree: slope trick on convex costs',
    'leetcode' => 4082,
    'difficulty' => 'Hard',
    'summary' => 'Treat each subtree\'s cost as a convex function of the node\'s final value, widen it by one for the parent, and store it by breakpoints in two heaps merged small into large.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'kind' => 'algo',
    'tags' => ['tree', 'dynamic-programming', 'heap', 'leetcode'],
    'related_session' => 'minimum-operations-to-stabilize-a-binary-tree',
];
