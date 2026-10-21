<?php
declare(strict_types=1);

return [
    'title' => 'The Number of Passengers in Each Bus II: board in time order with capacity',
    'leetcode' => 2153,
    'difficulty' => 'Hard',
    'summary' => 'Process buses by arrival time. For each, waiting = passengers arrived by then − passengers already boarded; it takes min(capacity, waiting). A recursive CTE (or user variables) carries the running total of boarded passengers.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'kind' => 'algo',
    'tags' => ['sql', 'database', 'recursive-cte', 'leetcode'],
    'related_session' => 'the-number-of-passengers-in-each-bus-ii',
];
