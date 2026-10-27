<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Operations to Stabilize a Binary Tree',
    'leetcode' => 4082,
    'difficulty' => 'Hard',
    'summary' => 'Post-order DP: cost[u][x] = abs(x − val[u]) plus, for each child, the cheapest child cost at x − 1, x or x + 1. Values never need to leave the range [min, max] of the tree. The fast version keeps each cost curve in slope-trick heaps.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'tags' => ['tree', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-operations-to-stabilize-a-binary-tree',
    'related_session' => 'minimum-operations-to-stabilize-a-binary-tree',
];
