<?php
declare(strict_types=1);

return [
    'title' => 'Flip Tree to Match Voyage: flip when the left child mismatches',
    'leetcode' => 971,
    'difficulty' => 'Med',
    'summary' => 'Preorder DFS with a pointer into voyage. If the node mismatches, fail. If the left child exists and is not the next voyage value, flip this node (visit right first).',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'tags' => ['tree', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'flip-binary-tree-to-match-preorder-traversal',
    'related_session' => 'flip-binary-tree-to-match-preorder-traversal',
];
