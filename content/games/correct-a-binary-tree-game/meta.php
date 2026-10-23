<?php
declare(strict_types=1);

return [
    'title' => 'Correct a Binary Tree: BFS right to left',
    'leetcode' => 1660,
    'difficulty' => 'Med',
    'summary' => 'BFS each level from right to left, remembering visited nodes. A node whose right child was already seen (on this level) is the defective one: remove it from its parent.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'tags' => ['tree', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'correct-a-binary-tree',
    'related_session' => 'correct-a-binary-tree',
];
