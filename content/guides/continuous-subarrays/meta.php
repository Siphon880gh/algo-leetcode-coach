<?php
declare(strict_types=1);

return [
    'title' => 'Continuous Subarrays: a window with max − min ≤ 2',
    'leetcode' => 2762,
    'difficulty' => 'Med',
    'summary' => 'Slide a window and track its maximum and minimum with two monotonic deques. Shrink from the left while they differ by more than 2; every start in the window gives a valid subarray ending at r.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'kind' => 'algo',
    'tags' => ['array', 'sliding-window', 'monotonic-queue', 'leetcode'],
    'related_session' => 'continuous-subarrays',
];
