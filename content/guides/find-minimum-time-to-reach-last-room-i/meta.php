<?php
declare(strict_types=1);

return [
    'title' => 'Find Minimum Time to Reach Last Room I: Dijkstra with waiting',
    'leetcode' => 3341,
    'difficulty' => 'Med',
    'summary' => 'Dijkstra on the grid. Leaving for room v at time t means starting no earlier than moveTime[v], so arrival is max(t, moveTime[v]) + 1.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'kind' => 'algo',
    'tags' => ['graph', 'array', 'matrix', 'shortest-path', 'heap', 'leetcode'],
    'related_session' => 'find-minimum-time-to-reach-last-room-i',
];
