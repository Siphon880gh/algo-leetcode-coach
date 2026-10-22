<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Frequency After Subarray Operation: Kadane for each value',
    'leetcode' => 3434,
    'difficulty' => 'Med',
    'summary' => 'Choosing x turns one value v into k inside the subarray, but any k already there stops being k. For each v, run Kadane on +1 for v and −1 for k; add the best gain to the count of k.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['greedy', 'array', 'hash-table', 'dynamic-programming', 'enumeration', 'prefix-sum', 'leetcode'],
    'related_session' => 'maximum-frequency-after-subarray-operation',
];
