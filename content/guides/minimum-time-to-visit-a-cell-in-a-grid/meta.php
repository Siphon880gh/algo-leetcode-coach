<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Time to Visit a Cell In a Grid: Dijkstra with back-and-forth waits',
    'leetcode' => 2577,
    'difficulty' => 'Hard',
    'summary' => 'If both neighbours of the start need time above 1 you are stuck. Otherwise you can wait by stepping back and forth, which wastes time in steps of 2. Run Dijkstra where entering a cell early is delayed to its time, plus 1 when the parity is off.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'kind' => 'algo',
    'tags' => ['array', 'breadth-first-search', 'graph', 'heap', 'matrix', 'shortest-path', 'leetcode'],
    'related_session' => 'minimum-time-to-visit-a-cell-in-a-grid',
];
