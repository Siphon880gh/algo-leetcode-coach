<?php
declare(strict_types=1);

return [
    'title' => 'Trim a Binary Search Tree: drop whole sides',
    'leetcode' => 669,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: below low means use the trimmed right side, above high means use the trimmed left side, otherwise trim both children. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'related_guide' => 'trim-a-binary-search-tree',
    'tags' => ['trees', 'bst', 'dfs', 'recursion', 'step-by-step'],
];
