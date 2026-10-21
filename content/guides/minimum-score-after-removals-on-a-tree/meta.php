<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Score After Removals on a Tree: subtree XORs and ancestry',
    'leetcode' => 2322,
    'difficulty' => 'Hard',
    'summary' => 'Root the tree, compute every subtree XOR and Euler entry and exit times. Removing the edges above u and v gives three parts whose XORs depend only on whether one of u and v is an ancestor of the other; try all pairs.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'kind' => 'algo',
    'tags' => ['array', 'bit-manipulation', 'tree', 'depth-first-search', 'leetcode'],
    'related_session' => 'minimum-score-after-removals-on-a-tree',
];
