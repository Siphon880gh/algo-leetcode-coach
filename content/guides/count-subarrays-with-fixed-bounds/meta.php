<?php
declare(strict_types=1);

return [
    'title' => 'Count Subarrays With Fixed Bounds: last positions of min, max and a bad value',
    'leetcode' => 2444,
    'difficulty' => 'Hard',
    'summary' => 'For each right end, track the last index holding minK, the last holding maxK, and the last value outside the bounds. Valid left ends lie after the bad index and at or before both bound positions.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'kind' => 'algo',
    'tags' => ['array', 'queue', 'sliding-window', 'monotonic-queue', 'leetcode'],
    'related_session' => 'count-subarrays-with-fixed-bounds',
];
