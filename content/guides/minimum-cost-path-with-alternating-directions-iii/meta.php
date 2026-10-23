<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Cost Path with Alternating Directions III: Dijkstra on (cell, parity)',
    'leetcode' => 4003,
    'difficulty' => 'Hard',
    'summary' => 'The cost of a step depends on whether the next action is odd or even, so each cell has two states. Waiting is an edge that flips the parity at a cost of penalty[i][j]. Every cost is non-negative, so Dijkstra works.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'kind' => 'algo',
    'tags' => ['graph', 'array', 'matrix', 'shortest-path', 'heap', 'leetcode'],
    'related_session' => 'minimum-cost-path-with-alternating-directions-iii',
];
