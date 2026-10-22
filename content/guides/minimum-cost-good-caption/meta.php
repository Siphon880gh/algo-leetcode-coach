<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Cost Good Caption: DP on letter and run length, then smallest letters',
    'leetcode' => 3441,
    'difficulty' => 'Hard',
    'summary' => 'f(i, c, r) is the least cost for positions i … n − 1 when position i − 1 holds c in a run of length r (capped at 3). Keep c, or switch letter only once r = 3. Rebuild from the left picking the smallest letter that keeps the optimum.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['string', 'dynamic-programming', 'leetcode'],
    'related_session' => 'minimum-cost-good-caption',
];
