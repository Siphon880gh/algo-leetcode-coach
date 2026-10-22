<?php
declare(strict_types=1);

return [
    'title' => 'Sum of Consecutive Subarrays: running counts for each direction',
    'leetcode' => 3284,
    'difficulty' => 'Med',
    'summary' => 'For each end index keep, per direction, how many consecutive subarrays end there and the total of their sums. Extending by x adds x once per subarray. Singletons are in both directions, so subtract them once.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'two-pointers', 'dynamic-programming', 'leetcode'],
    'related_session' => 'sum-of-consecutive-subarrays',
];
