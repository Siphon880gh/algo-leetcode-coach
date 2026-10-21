<?php
declare(strict_types=1);

return [
    'title' => 'Shortest Path to Get All Keys: BFS over (cell, keys held)',
    'leetcode' => 864,
    'difficulty' => 'Hard',
    'summary' => 'The same cell is a different state with different keys in hand, so BFS over (row, col, key mask). Walls block; a lock blocks unless its key bit is set; stop when the mask has every key.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'kind' => 'algo',
    'tags' => ['bfs', 'bitmask', 'matrix', 'leetcode'],
    'related_session' => 'shortest-path-to-get-all-keys',
];
