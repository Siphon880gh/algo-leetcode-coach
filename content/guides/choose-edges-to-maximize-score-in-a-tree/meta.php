<?php
declare(strict_types=1);

return [
    'title' => 'Choose Edges to Maximize Score in a Tree: matching DP on a rooted tree',
    'leetcode' => 2378,
    'difficulty' => 'Med',
    'summary' => 'For each node keep two values: the best in its subtree when the node is not used by an edge to a child, and the best overall. Using an edge to child c swaps that child’s best for its not-used value plus the edge weight; take the best single swap.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['tree', 'depth-first-search', 'dynamic-programming', 'leetcode'],
    'related_session' => 'choose-edges-to-maximize-score-in-a-tree',
];
