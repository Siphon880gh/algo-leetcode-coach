<?php
declare(strict_types=1);

return [
    'title' => 'Binary Tree Longest Consecutive Sequence II: increasing and decreasing runs meet at a node',
    'leetcode' => 549,
    'difficulty' => 'Med',
    'summary' => 'Longest path where neighbors differ by exactly 1, either increasing or decreasing, and it may bend at a node (child-parent-child). DFS returns (inc, dec): the longest downward runs that go +1 and −1 from each node. At a node, a path is inc + dec − 1. [2,1,3] → 3. [1,2,3] → 2. Not 298.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'kind' => 'algo',
    'tags' => ['trees', 'dfs', 'leetcode'],
    'related_session' => 'binary-tree-longest-consecutive-sequence-ii',
];
