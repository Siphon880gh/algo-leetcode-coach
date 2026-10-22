<?php
declare(strict_types=1);

return [
    'title' => 'Choose Edges to Maximize Score in a Tree: free and best per node',
    'leetcode' => 2378,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: keep a free value and a best value per node, match a node to at most one child, and skip swaps that lose weight. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'choose-edges-to-maximize-score-in-a-tree',
    'tags' => ['tree', 'depth-first-search', 'dynamic-programming', 'step-by-step'],
];
