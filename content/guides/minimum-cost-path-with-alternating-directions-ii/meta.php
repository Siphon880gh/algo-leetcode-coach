<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Cost Path with Alternating Directions II: grid DP with waits',
    'leetcode' => 3603,
    'difficulty' => 'Med',
    'summary' => 'Moves and waits alternate, so every cell on the path except the start and the target is entered and then waited on. Take the cheapest right/down path with cost (i + 1)(j + 1) + waitCost[i][j] per cell.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'dynamic-programming', 'matrix', 'leetcode'],
    'related_session' => 'minimum-cost-path-with-alternating-directions-ii',
];
