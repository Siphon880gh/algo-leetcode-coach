<?php
declare(strict_types=1);

return [
    'title' => 'Find Minimum Time to Reach Last Room II: Dijkstra with alternating cost',
    'leetcode' => 3342,
    'difficulty' => 'Med',
    'summary' => 'Moves alternate 1 and 2 seconds, and every move flips the parity of i + j, so a move from (i, j) costs 1 if i + j is even, else 2. Then it is Dijkstra as in part I.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'kind' => 'algo',
    'tags' => ['graph', 'array', 'matrix', 'shortest-path', 'heap', 'leetcode'],
    'related_session' => 'find-minimum-time-to-reach-last-room-ii',
];
