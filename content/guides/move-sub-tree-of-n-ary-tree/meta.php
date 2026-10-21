<?php
declare(strict_types=1);

return [
    'title' => 'Move Sub-Tree of N-Ary Tree: three cases by ancestry',
    'leetcode' => 1516,
    'difficulty' => 'Hard',
    'summary' => 'Find parents of p and q. If p is already q\'s child, stop. If q is inside p\'s subtree, first detach q from its parent and put q where p was. Then detach p and append it to q.',
    'category' => 'LeetCode',
    'subcategory' => 'Tree',
    'topic' => 'LeetCode · Tree',
    'kind' => 'algo',
    'tags' => ['tree', 'dfs', 'leetcode'],
    'related_session' => 'move-sub-tree-of-n-ary-tree',
];
