<?php
declare(strict_types=1);

return [
    'title' => 'Minimum XOR Path in a Grid: reachable XOR sets',
    'leetcode' => 3882,
    'difficulty' => 'Med',
    'summary' => 'XOR has no greedy order, so keep the set of reachable XOR values (below 1024) at every cell as a bitset and merge from the top and left.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['bit-manipulation', 'array', 'dynamic-programming', 'matrix', 'leetcode'],
    'related_session' => 'minimum-xor-path-in-a-grid',
];
