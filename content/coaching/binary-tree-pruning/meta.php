<?php
declare(strict_types=1);

return [
    'title' => 'Binary Tree Pruning: decide after the children',
    'leetcode' => 814,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: prune both subtrees first, then drop the node if it is 0 with no children left. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'related_guide' => 'binary-tree-pruning',
    'tags' => ['trees', 'dfs', 'recursion', 'step-by-step'],
];
