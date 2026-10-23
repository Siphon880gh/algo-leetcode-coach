<?php
declare(strict_types=1);

return [
    'title' => 'Count Subarrays With Cost Less Than or Equal to K: sliding window',
    'leetcode' => 3835,
    'difficulty' => 'Med',
    'summary' => 'For a fixed right end, extending left never lowers max − min or the length, so cost only grows. Slide the left end with two monotonic deques for max and min and add r − l + 1 each step.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'kind' => 'algo',
    'tags' => ['queue', 'array', 'monotonic-queue', 'leetcode'],
    'related_session' => 'count-subarrays-with-cost-less-than-or-equal-to-k',
];
