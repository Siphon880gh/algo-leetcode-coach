<?php
declare(strict_types=1);

return [
    'title' => 'Maximize Sum of Weights after Edge Removals: tree DP with top gains',
    'leetcode' => 3367,
    'difficulty' => 'Hard',
    'summary' => 'For each node, keep[v][0/1] = best in v’s subtree when v may keep k − 1 or k child edges. Keeping the edge to child c gains w + keep[c][0] − keep[c][1]; take the largest positive gains.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'kind' => 'algo',
    'tags' => ['tree', 'depth-first-search', 'dynamic-programming', 'sorting', 'leetcode'],
    'related_session' => 'maximize-sum-of-weights-after-edge-removals',
];
