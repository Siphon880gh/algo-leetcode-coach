<?php
declare(strict_types=1);

return [
    'title' => 'Lowest Common Ancestor of a Binary Tree III: parent-pointer intersection',
    'leetcode' => 1650,
    'difficulty' => 'Med',
    'summary' => 'Treat the paths to the root as two linked lists that meet at the LCA. Walk two pointers up; when one hits null, restart it at the other node. They meet after at most two passes.',
    'category' => 'LeetCode',
    'subcategory' => 'Tree',
    'topic' => 'LeetCode · Tree',
    'kind' => 'algo',
    'tags' => ['tree', 'two-pointers', 'hash-set', 'leetcode'],
    'related_session' => 'lowest-common-ancestor-of-a-binary-tree-iii',
];
