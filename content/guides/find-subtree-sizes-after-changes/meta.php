<?php
declare(strict_types=1);

return [
    'title' => 'Find Subtree Sizes After Changes: nearest same-letter ancestor via stacks',
    'leetcode' => 3331,
    'difficulty' => 'Med',
    'summary' => 'During one DFS keep a stack of ancestors per letter. A node’s new parent is the top of its letter’s stack, if any. Then compute subtree sizes on the new tree.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'kind' => 'algo',
    'tags' => ['tree', 'depth-first-search', 'array', 'hash-table', 'string', 'leetcode'],
    'related_session' => 'find-subtree-sizes-after-changes',
];
