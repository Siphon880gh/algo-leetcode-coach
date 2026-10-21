<?php
declare(strict_types=1);

return [
    'title' => 'Encode N-ary Tree to Binary Tree: left is first child, right is next sibling',
    'leetcode' => 431,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: encode an N-ary tree as a binary tree and decode it back. left points to the first child; right points to the next sibling. Decode by walking left, then the right chain. Stateless codec. Not 428 / 297. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'tags' => ['trees', 'dfs', 'binary-tree', 'step-by-step'],
    'related_guide' => 'encode-n-ary-tree-to-binary-tree',
];
