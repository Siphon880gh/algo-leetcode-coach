<?php
declare(strict_types=1);

return [
    'title' => 'Move Sub-Tree of N-Ary Tree: ancestry cases',
    'leetcode' => 1516,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: find parents; if p is q\'s child, stop; if q is in p\'s subtree, detach q and put it in p\'s slot; detach p otherwise; append p to q. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Tree',
    'topic' => 'LeetCode · Tree',
    'related_guide' => 'move-sub-tree-of-n-ary-tree',
    'tags' => ['tree', 'dfs', 'step-by-step'],
];
