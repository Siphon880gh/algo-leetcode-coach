<?php
declare(strict_types=1);

return [
    'title' => 'Shortest Path in a Hidden Grid: explore with DFS, then BFS',
    'leetcode' => 1778,
    'difficulty' => 'Med',
    'summary' => 'First map the reachable cells with a backtracking DFS using relative coordinates (move, recurse, move back). Then BFS on the discovered map from the start to the recorded target.',
    'category' => 'LeetCode',
    'subcategory' => 'Graph',
    'topic' => 'LeetCode · Graph',
    'kind' => 'algo',
    'tags' => ['depth-first-search', 'breadth-first-search', 'interactive', 'leetcode'],
    'related_session' => 'shortest-path-in-a-hidden-grid',
];
