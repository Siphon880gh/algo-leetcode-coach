<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Time for K Connected Components',
    'leetcode' => 3608,
    'difficulty' => 'Med',
    'summary' => 'Removing edges with time ≤ t only helps, so the component count grows with t. Check candidate times (0 and every edge time, sorted): rebuild with the surviving edges and stop at the first t with at least k components.',
    'category' => 'LeetCode',
    'subcategory' => 'Union Find',
    'topic' => 'LeetCode · Union Find',
    'tags' => ['union-find', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-time-for-k-connected-components',
    'related_session' => 'minimum-time-for-k-connected-components',
];
