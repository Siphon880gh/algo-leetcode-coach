<?php
declare(strict_types=1);

return [
    'title' => 'Count Unreachable Pairs of Nodes in an Undirected Graph: component sizes',
    'leetcode' => 2316,
    'difficulty' => 'Med',
    'summary' => 'Find the size of every connected component with union-find or DFS. Nodes in different components cannot reach each other, so add size × (nodes counted so far) for each component in turn.',
    'category' => 'LeetCode',
    'subcategory' => 'Union Find',
    'topic' => 'LeetCode · Union Find',
    'kind' => 'algo',
    'tags' => ['depth-first-search', 'breadth-first-search', 'union-find', 'graph', 'leetcode'],
    'related_session' => 'count-unreachable-pairs-of-nodes-in-an-undirected-graph',
];
