<?php
declare(strict_types=1);

return [
    'title' => 'Search in a BST: one comparison per level',
    'leetcode' => 700,
    'difficulty' => 'Easy',
    'summary' => 'At each node: equal → found. Target smaller → only the left subtree can hold it. Bigger → only the right. Reaching null means it is not in the tree.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'tags' => ['tree', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'search-in-a-binary-search-tree',
    'related_session' => 'search-in-a-binary-search-tree',
];
