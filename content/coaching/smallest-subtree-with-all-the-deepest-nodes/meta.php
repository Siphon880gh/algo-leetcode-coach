<?php
declare(strict_types=1);

return [
    'title' => 'Smallest Subtree with all the Deepest Nodes: depth and candidate together',
    'leetcode' => 865,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: a post-order DFS returns (depth, node); equal child depths make the current node the answer for its subtree, otherwise pass up the deeper side. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'related_guide' => 'smallest-subtree-with-all-the-deepest-nodes',
    'tags' => ['trees', 'depth-first-search', 'recursion', 'step-by-step'],
];
