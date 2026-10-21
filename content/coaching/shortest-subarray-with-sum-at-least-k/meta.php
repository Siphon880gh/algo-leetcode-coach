<?php
declare(strict_types=1);

return [
    'title' => 'Shortest Subarray with Sum at Least K: monotonic deque of prefix sums',
    'leetcode' => 862,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: with negatives a window fails, so keep prefix-sum indices in an increasing deque, popping the front when it forms a valid subarray and the back when it is not smaller. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'related_guide' => 'shortest-subarray-with-sum-at-least-k',
    'tags' => ['monotonic-queue', 'prefix-sum', 'sliding-window', 'step-by-step'],
];
