<?php
declare(strict_types=1);

return [
    'title' => 'Binary Tree Pruning: postorder removal of zero-only subtrees',
    'leetcode' => 814,
    'difficulty' => 'Med',
    'summary' => 'Prune the children first, then remove the current node if both children are gone and its value is 0. A postorder recursion that returns the (possibly null) subtree does it in one pass.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'kind' => 'algo',
    'tags' => ['trees', 'dfs', 'recursion', 'leetcode'],
    'related_session' => 'binary-tree-pruning',
];
