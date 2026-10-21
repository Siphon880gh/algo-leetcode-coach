<?php
declare(strict_types=1);

return [
    'title' => 'Number of Ways to Arrive at Destination: Dijkstra with path counts',
    'leetcode' => 1976,
    'difficulty' => 'Med',
    'summary' => 'Run Dijkstra from 0 while counting shortest paths: on a strictly shorter distance, copy the count; on an equal distance, add it. The count at n − 1 is the answer.',
    'category' => 'LeetCode',
    'subcategory' => 'Shortest Path',
    'topic' => 'LeetCode · Shortest Path',
    'kind' => 'algo',
    'tags' => ['dijkstra', 'graph', 'dynamic-programming', 'leetcode'],
    'related_session' => 'number-of-ways-to-arrive-at-destination',
];
