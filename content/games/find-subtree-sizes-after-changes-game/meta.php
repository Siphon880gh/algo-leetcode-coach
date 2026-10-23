<?php
declare(strict_types=1);

return [
    'title' => 'Subtree Sizes After Changes: nearest same-letter ancestor',
    'leetcode' => 3331,
    'difficulty' => 'Med',
    'summary' => 'DFS keeping, per letter, a stack of ancestors. Node x\'s new parent is the top of its letter\'s stack (if any). Then compute subtree sizes in the new tree.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'tags' => ['tree', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'find-subtree-sizes-after-changes',
    'related_session' => 'find-subtree-sizes-after-changes',
];
