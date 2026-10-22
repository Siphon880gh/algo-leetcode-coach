<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Cost of a Path With Special Roads: Dijkstra on road endpoints',
    'leetcode' => 2662,
    'difficulty' => 'Med',
    'summary' => 'Only the start, the target and the special roads’ endpoints matter. Run Dijkstra over the start and road ends, where reaching a road’s end costs the Manhattan distance to its start plus the cheaper of the road and walking.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'kind' => 'algo',
    'tags' => ['graph', 'array', 'shortest-path', 'heap', 'leetcode'],
    'related_session' => 'minimum-cost-of-a-path-with-special-roads',
];
