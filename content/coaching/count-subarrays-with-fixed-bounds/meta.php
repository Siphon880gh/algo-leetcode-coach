<?php
declare(strict_types=1);

return [
    'title' => 'Count Subarrays With Fixed Bounds: clamp at 0, update both, 64-bit',
    'leetcode' => 2444,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: never add a negative count, update both bound positions when minK = maxK, and keep the total in 64-bit. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'related_guide' => 'count-subarrays-with-fixed-bounds',
    'tags' => ['array', 'queue', 'sliding-window', 'monotonic-queue', 'step-by-step'],
];
