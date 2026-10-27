<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Subarray Length With Distinct Sum at Least K',
    'leetcode' => 3795,
    'difficulty' => 'Med',
    'summary' => 'Sliding window with a count map and the sum of distinct values (a value adds to the sum when its count goes 0 to 1). After adding nums[r], shrink from the left while the distinct sum stays at least k, recording the length.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'tags' => ['sliding-window', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-subarray-length-with-distinct-sum-at-least-k',
    'related_session' => 'minimum-subarray-length-with-distinct-sum-at-least-k',
];
