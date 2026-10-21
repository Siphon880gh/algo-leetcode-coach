<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Sum of Two Non-Overlapping Subarrays: best left window so far',
    'leetcode' => 1031,
    'difficulty' => 'Med',
    'summary' => 'Either the firstLen window comes first or the secondLen one does. For each order, sweep the right window across the array with prefix sums, keeping the best left window that ends before it.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'prefix-sum', 'sliding-window', 'arrays', 'leetcode'],
    'related_session' => 'maximum-sum-of-two-non-overlapping-subarrays',
];
