<?php
declare(strict_types=1);

return [
    'title' => 'Longest Cycle in a Graph: timestamps along each walk',
    'leetcode' => 2360,
    'difficulty' => 'Hard',
    'summary' => 'Walk from every unvisited node, stamping each node with a global clock. If a walk hits a node stamped during the same walk, the cycle length is the clock difference; nodes from older walks end the walk with no new cycle.',
    'category' => 'LeetCode',
    'subcategory' => 'Graph',
    'topic' => 'LeetCode · Graph',
    'kind' => 'algo',
    'tags' => ['depth-first-search', 'breadth-first-search', 'graph', 'topological-sort', 'leetcode'],
    'related_session' => 'longest-cycle-in-a-graph',
];
