<?php
declare(strict_types=1);

return [
    'title' => 'Elevator Requests III: bitmask DP over the serving order',
    'leetcode' => 4027,
    'difficulty' => 'Hard',
    'summary' => 'Serve the requests in some order. Going straight to the next floor and waiting there for its arrival is never worse, so f[mask][j] = earliest time to have served mask, ending with request j.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['bit-manipulation', 'array', 'dynamic-programming', 'bitmask', 'sorting', 'leetcode'],
    'related_session' => 'elevator-requests-iii',
];
