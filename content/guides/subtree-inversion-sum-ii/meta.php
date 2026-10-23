<?php
declare(strict_types=1);

return [
    'title' => 'Subtree Inversion Sum II: tree DP on parity and nearest inversion',
    'leetcode' => 3949,
    'difficulty' => 'Hard',
    'summary' => 'Each value ends up negated when an odd number of its ancestors (or itself) were inverted. DP on (node, parity from above, distance to the nearest inversion below, capped at k), merging children so that any two inversions stay k apart.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['tree', 'depth-first-search', 'array', 'dynamic-programming', 'leetcode'],
    'related_session' => 'subtree-inversion-sum-ii',
];
