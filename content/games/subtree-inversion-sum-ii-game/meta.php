<?php
declare(strict_types=1);

return [
    'title' => 'Subtree Inversion Sum II',
    'leetcode' => 3949,
    'difficulty' => 'Hard',
    'summary' => 'Now any two inverted nodes, not just ancestor pairs, must be at least k apart. Root the tree and run a DP that, for each node, tracks the parity of inversions above it and the depth of the nearest inverted node inside its subtree, so siblings\' choices can be checked against each other.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'tags' => ['tree', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'subtree-inversion-sum-ii',
    'related_session' => 'subtree-inversion-sum-ii',
];
