<?php
declare(strict_types=1);

return [
    'title' => 'Longest Path With Different Adjacent Characters: two best child chains',
    'leetcode' => 2246,
    'difficulty' => 'Hard',
    'summary' => 'Post-order over the tree. For each node, among children with a different character, keep the two longest downward chains; the path through the node is their sum + 1, and the node passes the longest + 1 up.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'kind' => 'algo',
    'tags' => ['array', 'string', 'tree', 'depth-first-search', 'graph', 'topological-sort', 'leetcode'],
    'related_session' => 'longest-path-with-different-adjacent-characters',
];
