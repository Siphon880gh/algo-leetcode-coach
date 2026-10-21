<?php
declare(strict_types=1);

return [
    'title' => 'Shortest Subarray with Sum at Least K: prefix sums and a monotonic deque',
    'leetcode' => 862,
    'difficulty' => 'Hard',
    'summary' => 'With negatives, a sliding window fails. Keep prefix-sum indices in a deque with increasing values: pop the front while it forms a valid subarray with j, and pop the back while it is not smaller than P[j].',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'kind' => 'algo',
    'tags' => ['monotonic-queue', 'prefix-sum', 'sliding-window', 'leetcode'],
    'related_session' => 'shortest-subarray-with-sum-at-least-k',
];
