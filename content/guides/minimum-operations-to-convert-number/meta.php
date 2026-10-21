<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Operations to Convert Number: BFS over 0 … 1000',
    'leetcode' => 2059,
    'difficulty' => 'Med',
    'summary' => 'BFS from start over values 0 … 1000. From x, try x + v, x − v and x ^ v for every v; reaching goal ends the search even if the value is out of range, but only in-range values are expanded.',
    'category' => 'LeetCode',
    'subcategory' => 'Graph',
    'topic' => 'LeetCode · Graph',
    'kind' => 'algo',
    'tags' => ['bfs', 'graph', 'array', 'leetcode'],
    'related_session' => 'minimum-operations-to-convert-number',
];
