<?php
declare(strict_types=1);

return [
    'title' => 'Change the Root: flip pointers along the leaf-to-root path',
    'leetcode' => 1666,
    'difficulty' => 'Med',
    'summary' => 'Walk from the leaf up. At each node cur (not the old root): its left child (if any) moves to the right, and its old parent becomes its left child (detaching cur from that parent).',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'tags' => ['tree', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'change-the-root-of-a-binary-tree',
    'related_session' => 'change-the-root-of-a-binary-tree',
];
