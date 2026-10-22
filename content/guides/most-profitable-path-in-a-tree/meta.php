<?php
declare(strict_types=1);

return [
    'title' => 'Most Profitable Path in a Tree: Bob’s arrival times, then Alice’s DFS',
    'leetcode' => 2467,
    'difficulty' => 'Med',
    'summary' => 'Bob’s route to node 0 is fixed, so record when he reaches each node on it. Alice then walks down from the root: a gate is hers alone if she arrives first, shared if they arrive together, and already opened if Bob was there earlier.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'kind' => 'algo',
    'tags' => ['array', 'tree', 'depth-first-search', 'breadth-first-search', 'graph', 'leetcode'],
    'related_session' => 'most-profitable-path-in-a-tree',
];
