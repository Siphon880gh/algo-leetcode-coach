<?php
declare(strict_types=1);

return [
    'title' => 'Closest Leaf in a Binary Tree: BFS on the tree as a graph',
    'leetcode' => 742,
    'difficulty' => 'Med',
    'summary' => 'Record each node\'s parent with one DFS, which turns the tree into an undirected graph. BFS from the node with value k over children and parent; the first leaf dequeued is the closest.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'kind' => 'algo',
    'tags' => ['trees', 'bfs', 'graphs', 'dfs', 'leetcode'],
    'related_session' => 'closest-leaf-in-a-binary-tree',
];
