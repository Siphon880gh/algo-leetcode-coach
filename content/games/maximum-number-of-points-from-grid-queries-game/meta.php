<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Number of Points From Grid Queries',
    'leetcode' => 2503,
    'difficulty' => 'Hard',
    'summary' => 'Sort queries. Expand from (0,0) with a min-heap by cell value: for each query, pop every reachable cell with value < q, counting it. The count after expansion answers the query.',
    'category' => 'LeetCode',
    'subcategory' => 'Union Find',
    'topic' => 'LeetCode · Union Find',
    'tags' => ['union-find', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-number-of-points-from-grid-queries',
    'related_session' => 'maximum-number-of-points-from-grid-queries',
];
