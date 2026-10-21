<?php
declare(strict_types=1);

return [
    'title' => 'Shortest Path to Get All Keys: BFS with a key mask',
    'leetcode' => 864,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: the state is (row, col, keys held); locks need their key bit, keys set a bit, and the first state with every key gives the answer. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'related_guide' => 'shortest-path-to-get-all-keys',
    'tags' => ['bfs', 'bitmask', 'matrix', 'step-by-step'],
];
