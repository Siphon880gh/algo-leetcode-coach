<?php
declare(strict_types=1);

return [
    'title' => 'Delete Nodes And Return Forest: post-order with a root flag',
    'leetcode' => 1110,
    'difficulty' => 'Med',
    'summary' => 'Traverse bottom-up. When a node is deleted, its surviving children become new roots; a node becomes a root when it survives and its parent was deleted or it is the original root.',
    'category' => 'LeetCode',
    'subcategory' => 'Tree',
    'topic' => 'LeetCode · Tree',
    'kind' => 'algo',
    'tags' => ['trees', 'dfs', 'hash-table', 'leetcode'],
    'related_session' => 'delete-nodes-and-return-forest',
];
