<?php
declare(strict_types=1);

return [
    'title' => 'Change the Root of a Binary Tree: reverse the leaf-to-root path',
    'leetcode' => 1666,
    'difficulty' => 'Med',
    'summary' => 'Iterate up from the leaf, carrying the previous node. For each cur: detach cur from its parent, move cur.left to cur.right if present, set cur.left = old parent, fix parent pointers; finally make the old root a child and clear the new root\'s parent.',
    'category' => 'LeetCode',
    'subcategory' => 'Tree',
    'topic' => 'LeetCode · Tree',
    'kind' => 'algo',
    'tags' => ['tree', 'binary-tree', 'leetcode'],
    'related_session' => 'change-the-root-of-a-binary-tree',
];
