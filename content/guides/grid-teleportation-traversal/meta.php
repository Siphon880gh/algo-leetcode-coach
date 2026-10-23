<?php
declare(strict_types=1);

return [
    'title' => 'Grid Teleportation Traversal: 0-1 BFS with portals',
    'leetcode' => 3552,
    'difficulty' => 'Med',
    'summary' => 'Moves cost 1 and teleports cost 0, so use a deque. The first time a portal letter is popped, push every cell with that letter at the same distance and mark the letter used; a shortest path never needs a letter twice.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'kind' => 'algo',
    'tags' => ['breadth-first-search', 'array', 'hash-table', 'matrix', 'leetcode'],
    'related_session' => 'grid-teleportation-traversal',
];
