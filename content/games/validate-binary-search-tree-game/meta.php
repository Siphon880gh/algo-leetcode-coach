<?php
declare(strict_types=1);

return [
    'title' => 'Validate BST: every node inherits bounds',
    'leetcode' => 98,
    'difficulty' => 'Med',
    'summary' => 'Pass down (low, high). Going left lowers high to the parent\'s value; going right raises low. A node is valid only if low < val < high, not just compared to its parent.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'tags' => ['tree', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'validate-binary-search-tree',
    'related_session' => 'validate-binary-search-tree',
];
