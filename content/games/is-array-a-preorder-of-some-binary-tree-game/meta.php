<?php
declare(strict_types=1);

return [
    'title' => 'Is Array a Preorder: stack of the current path',
    'leetcode' => 2764,
    'difficulty' => 'Med',
    'summary' => 'Keep the root-to-current path on a stack. For each next node, pop until the top is its parent; if the stack empties first, it is not a preorder.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'tags' => ['tree', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'is-array-a-preorder-of-some-binary-tree',
    'related_session' => 'is-array-a-preorder-of-some-binary-tree',
];
