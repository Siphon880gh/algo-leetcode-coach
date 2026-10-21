<?php
declare(strict_types=1);

return [
    'title' => 'Swim in Rising Water: minimize the highest cell on the path',
    'leetcode' => 778,
    'difficulty' => 'Hard',
    'summary' => 'The time needed for a path is the largest elevation on it. Find the path that minimizes that maximum with Dijkstra keyed by the running max, or binary search the time with a BFS, or union cells in order of elevation until the corners connect.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'kind' => 'algo',
    'tags' => ['graphs', 'dijkstra', 'heap', 'binary-search', 'union-find', 'matrix', 'leetcode'],
    'related_session' => 'swim-in-rising-water',
];
