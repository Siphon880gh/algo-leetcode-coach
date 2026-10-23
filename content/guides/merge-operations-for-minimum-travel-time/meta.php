<?php
declare(strict_types=1);

return [
    'title' => 'Merge Operations for Minimum Travel Time: DP on kept signs',
    'leetcode' => 3538,
    'difficulty' => 'Hard',
    'summary' => 'Merging away signs between two kept signs adds their times to the next kept sign. So the rate on the road after a kept sign c is the sum of time from the previous kept sign + 1 through c. DP over (current kept sign, previous kept sign, merges used).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'dynamic-programming', 'prefix-sum', 'leetcode'],
    'related_session' => 'merge-operations-for-minimum-travel-time',
];
