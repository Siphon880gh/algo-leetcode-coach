<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Path Cost in a Hidden Grid: explore, then Dijkstra',
    'leetcode' => 1810,
    'difficulty' => 'Med',
    'summary' => 'Map the reachable cells and their entry costs with a backtracking DFS (move, recurse, move back), recording the target. Then run Dijkstra on the map where entering a cell costs its value.',
    'category' => 'LeetCode',
    'subcategory' => 'Shortest Path',
    'topic' => 'LeetCode · Shortest Path',
    'kind' => 'algo',
    'tags' => ['depth-first-search', 'shortest-path', 'interactive', 'leetcode'],
    'related_session' => 'minimum-path-cost-in-a-hidden-grid',
];
