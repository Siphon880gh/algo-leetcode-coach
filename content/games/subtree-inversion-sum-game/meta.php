<?php
declare(strict_types=1);

return [
    'title' => 'Subtree Inversion Sum',
    'leetcode' => 3544,
    'difficulty' => 'Hard',
    'summary' => 'Tree DP with state (node, edges since the last inverted ancestor capped at k, current sign). A node may be inverted only when that distance is at least k; inverting flips the sign for its whole subtree and resets the distance.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'tags' => ['tree', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'subtree-inversion-sum',
    'related_session' => 'subtree-inversion-sum',
];
