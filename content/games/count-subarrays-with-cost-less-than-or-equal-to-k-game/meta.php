<?php
declare(strict_types=1);

return [
    'title' => 'Count Subarrays With Cost Less Than or Equal to K',
    'leetcode' => 3835,
    'difficulty' => 'Med',
    'summary' => 'For a fixed right end, shrinking from the left never raises the cost, so use two pointers. Monotonic deques give the window max and min; move l right while (max − min) times length > k, then add r − l + 1.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'tags' => ['sliding-window', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'count-subarrays-with-cost-less-than-or-equal-to-k',
    'related_session' => 'count-subarrays-with-cost-less-than-or-equal-to-k',
];
