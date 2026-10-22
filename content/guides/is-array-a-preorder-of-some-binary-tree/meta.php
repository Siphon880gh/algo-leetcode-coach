<?php
declare(strict_types=1);

return [
    'title' => 'Is Array a Preorder of Some Binary Tree: a stack of the current path',
    'leetcode' => 2764,
    'difficulty' => 'Med',
    'summary' => 'Keep the path from the root to the last node on a stack. Each new node’s parent must be on that path: pop until it is on top, fail if the stack empties, then push the node.',
    'category' => 'LeetCode',
    'subcategory' => 'Stack',
    'topic' => 'LeetCode · Stack',
    'kind' => 'algo',
    'tags' => ['stack', 'tree', 'depth-first-search', 'binary-tree', 'leetcode'],
    'related_session' => 'is-array-a-preorder-of-some-binary-tree',
];
