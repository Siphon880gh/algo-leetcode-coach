<?php
declare(strict_types=1);

return [
    'title' => 'Shortest Path With At Most K Consecutive Identical Characters: Dijkstra on (node, run)',
    'leetcode' => 3970,
    'difficulty' => 'Med',
    'summary' => 'The state is the node plus the length of the current run of equal labels. Moving to a node with the same label extends the run and is allowed only up to k.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'kind' => 'algo',
    'tags' => ['graph', 'string', 'shortest-path', 'heap', 'leetcode'],
    'related_session' => 'shortest-path-with-at-most-k-consecutive-identical-characters',
];
