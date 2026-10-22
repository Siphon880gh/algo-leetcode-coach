<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Area Rectangle With Point Constraints II: consecutive pairs and a Fenwick count',
    'leetcode' => 3382,
    'difficulty' => 'Hard',
    'summary' => 'An empty rectangle’s left and right edges are consecutive points in their columns with the same pair of y values. Sweep columns by x, remember the last column where each (y1, y2) pair appeared, and count points in the box with a Fenwick tree: exactly 4 means empty.',
    'category' => 'LeetCode',
    'subcategory' => 'Geometry',
    'topic' => 'LeetCode · Geometry',
    'kind' => 'algo',
    'tags' => ['binary-indexed-tree', 'segment-tree', 'geometry', 'array', 'math', 'sorting', 'leetcode'],
    'related_session' => 'maximum-area-rectangle-with-point-constraints-ii',
];
