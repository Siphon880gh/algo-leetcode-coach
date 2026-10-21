<?php
declare(strict_types=1);

return [
    'title' => 'Depth of BST Given Insertion Order: neighbours in a sorted set',
    'leetcode' => 1902,
    'difficulty' => 'Med',
    'summary' => 'A new value becomes the child of whichever of its current predecessor or successor is deeper, so depth(x) = 1 + max(depth(pred), depth(succ)). A sorted container finds both in O(log n).',
    'category' => 'LeetCode',
    'subcategory' => 'Ordered Set',
    'topic' => 'LeetCode · Ordered Set',
    'kind' => 'algo',
    'tags' => ['ordered-set', 'binary-search-tree', 'tree', 'leetcode'],
    'related_session' => 'depth-of-bst-given-insertion-order',
];
