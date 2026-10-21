<?php
declare(strict_types=1);

return [
    'title' => 'Sum of Distances in Tree: one root, then reroot',
    'leetcode' => 834,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: compute subtree sizes and the depth sum from root 0, then move the root across each edge with ans[c] = ans[p] − count[c] + (n − count[c]). Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'related_guide' => 'sum-of-distances-in-tree',
    'tags' => ['trees', 'dfs', 'dynamic-programming', 'rerooting', 'step-by-step'],
];
