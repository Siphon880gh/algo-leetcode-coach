<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Time to Transport All Individuals: Dijkstra over (left group, stage)',
    'leetcode' => 3594,
    'difficulty' => 'Hard',
    'summary' => 'A state is who is still at the base and the current stage. From it, send any group of at most k, and if anyone is left, bring one person back. Dijkstra on total time finds the answer.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'kind' => 'algo',
    'tags' => ['bit-manipulation', 'graph', 'array', 'bitmask', 'shortest-path', 'heap', 'leetcode'],
    'related_session' => 'minimum-time-to-transport-all-individuals',
];
