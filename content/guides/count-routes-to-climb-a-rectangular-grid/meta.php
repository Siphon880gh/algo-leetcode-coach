<?php
declare(strict_types=1);

return [
    'title' => 'Count Routes to Climb a Rectangular Grid: row DP with prefix sums',
    'leetcode' => 3797,
    'difficulty' => 'Hard',
    'summary' => 'For each cell keep two counts: arrived by moving up (or starting), and arrived by a same-row move. An up move reaches columns within ⌊√(d² − 1)⌋; a same-row move reaches columns within d and is allowed only after an up move. Prefix sums make each row O(m).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'dynamic-programming', 'matrix', 'prefix-sum', 'leetcode'],
    'related_session' => 'count-routes-to-climb-a-rectangular-grid',
];
