<?php
declare(strict_types=1);

return [
    'title' => 'Complete Binary Tree Inserter: a queue of nodes with a free slot',
    'leetcode' => 919,
    'difficulty' => 'Med',
    'summary' => 'In level order, the nodes that can still take a child form a contiguous tail. Keep them in a queue: insert under the front node, pop it once it has two children, and enqueue the new node.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'kind' => 'algo',
    'tags' => ['trees', 'bfs', 'design', 'leetcode'],
    'related_session' => 'complete-binary-tree-inserter',
];
