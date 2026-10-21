<?php
declare(strict_types=1);

return [
    'title' => 'Longest ZigZag Path in a Binary Tree: direction and length',
    'leetcode' => 1372,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: pass the direction of the last move and the current length; switching direction extends the path, repeating it restarts at length 1. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Tree',
    'topic' => 'LeetCode · Tree',
    'related_guide' => 'longest-zigzag-path-in-a-binary-tree',
    'tags' => ['tree', 'dfs', 'step-by-step'],
];
