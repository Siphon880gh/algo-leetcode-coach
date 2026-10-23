<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Subgraph Score in a Tree: rerooting',
    'leetcode' => 3772,
    'difficulty' => 'Hard',
    'summary' => 'down[v] = ±1 for v plus every positive child down. Rerooting: ans[v] = down[v] + max(0, ans[parent] − max(0, down[v])).',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'kind' => 'algo',
    'tags' => ['tree', 'depth-first-search', 'array', 'dynamic-programming', 'leetcode'],
    'related_session' => 'maximum-subgraph-score-in-a-tree',
];
