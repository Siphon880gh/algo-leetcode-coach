<?php
declare(strict_types=1);

return [
    'title' => 'Bus Routes: BFS over buses, not stops',
    'leetcode' => 815,
    'difficulty' => 'Hard',
    'summary' => 'The cost is the number of buses taken, so BFS where each level is one more bus. Map each stop to the routes through it; from the current routes, every stop on them leads to new routes. Mark routes and stops as visited.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'kind' => 'algo',
    'tags' => ['graphs', 'bfs', 'hash-map', 'leetcode'],
    'related_session' => 'bus-routes',
];
