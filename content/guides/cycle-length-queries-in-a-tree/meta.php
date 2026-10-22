<?php
declare(strict_types=1);

return [
    'title' => 'Cycle Length Queries in a Tree: climb the larger label',
    'leetcode' => 2509,
    'difficulty' => 'Hard',
    'summary' => 'The new edge closes a cycle through the tree path between a and b, plus the edge itself. In this numbering the parent of v is v / 2, so repeatedly halve the larger label until they meet and count the steps.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'kind' => 'algo',
    'tags' => ['array', 'tree', 'binary-tree', 'lowest-common-ancestor', 'leetcode'],
    'related_session' => 'cycle-length-queries-in-a-tree',
];
