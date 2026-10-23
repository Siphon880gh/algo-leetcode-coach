<?php
declare(strict_types=1);

return [
    'title' => 'Shortest Path in a Weighted Tree: Euler tour and a range-add BIT',
    'leetcode' => 3515,
    'difficulty' => 'Hard',
    'summary' => 'The distance to x is the sum of edge weights on its root path. Changing an edge by d changes every node in the child’s subtree by d, which is a contiguous range in the Euler tour; a Fenwick tree adds to a range and reads a point.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'kind' => 'algo',
    'tags' => ['tree', 'depth-first-search', 'binary-indexed-tree', 'segment-tree', 'array', 'leetcode'],
    'related_session' => 'shortest-path-in-a-weighted-tree',
];
