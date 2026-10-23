<?php
declare(strict_types=1);

return [
    'title' => 'Binary Tree Maximum Path Sum: gain upward, best through',
    'leetcode' => 124,
    'difficulty' => 'Hard',
    'summary' => 'gain(n) = n.val + max(0, gain(left), gain(right)). The best path through n is n.val + max(0, gainL) + max(0, gainR).',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'tags' => ['tree', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'binary-tree-maximum-path-sum',
    'related_session' => 'binary-tree-maximum-path-sum',
];
