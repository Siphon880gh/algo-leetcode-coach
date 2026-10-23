<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Sum of M Non-Overlapping Subarrays II: penalty search on the count',
    'leetcode' => 3957,
    'difficulty' => 'Hard',
    'summary' => 'The best total with exactly j subarrays is concave in j. So charge λ per subarray, solve the unlimited problem with one sliding-max DP, and binary search λ until at most m subarrays are used.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['queue', 'array', 'binary-search', 'dynamic-programming', 'prefix-sum', 'sliding-window', 'monotonic-queue', 'leetcode'],
    'related_session' => 'maximum-sum-of-m-non-overlapping-subarrays-ii',
];
