<?php
declare(strict_types=1);

return [
    'title' => 'Delete Nodes And Return Forest: post-order with a root flag',
    'leetcode' => 1110,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: pass down whether the parent was deleted, add surviving nodes with a deleted parent to the forest, and return null for deleted nodes so parents unlink them. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Tree',
    'topic' => 'LeetCode · Tree',
    'related_guide' => 'delete-nodes-and-return-forest',
    'tags' => ['trees', 'dfs', 'hash-table', 'step-by-step'],
];
