<?php
declare(strict_types=1);

return [
    'title' => 'Sliding Subarray Beauty: counts of negatives in the window',
    'leetcode' => 2653,
    'difficulty' => 'Med',
    'summary' => 'Values lie in [−50, 50], so keep a count per value for the current window. For each window, walk the counts from −50 upward until x negatives are passed; if they run out, the beauty is 0.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'kind' => 'algo',
    'tags' => ['array', 'hash-table', 'sliding-window', 'leetcode'],
    'related_session' => 'sliding-subarray-beauty',
];
