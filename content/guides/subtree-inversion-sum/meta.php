<?php
declare(strict_types=1);

return [
    'title' => 'Subtree Inversion Sum: tree DP on distance and parity',
    'leetcode' => 3544,
    'difficulty' => 'Hard',
    'summary' => 'State (node, distance to the nearest inverted ancestor capped at k, parity of inversions above). A node may be inverted only when that distance is at least k; take the better of inverting or not.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'kind' => 'algo',
    'tags' => ['tree', 'depth-first-search', 'array', 'dynamic-programming', 'leetcode'],
    'related_session' => 'subtree-inversion-sum',
];
