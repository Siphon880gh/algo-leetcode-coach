<?php
declare(strict_types=1);

return [
    'title' => 'Add One Row to Tree: rewire the nodes at depth − 1',
    'leetcode' => 623,
    'difficulty' => 'Med',
    'summary' => 'Depth 1 makes a new root. Otherwise find every node at depth − 1 and give it two new children; the old left subtree hangs under the new left node, the old right under the new right.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'kind' => 'algo',
    'tags' => ['trees', 'bfs', 'dfs', 'binary-tree', 'leetcode'],
    'related_session' => 'add-one-row-to-tree',
];
