<?php
declare(strict_types=1);

return [
    'title' => 'Count the Number of Good Subarrays: shrink while still good',
    'leetcode' => 2537,
    'difficulty' => 'Med',
    'summary' => 'Adding a value x to a window adds cnt[x] new equal pairs. Grow the right end; while the window has at least k pairs, drop from the left. Every start before the left pointer gives a good subarray ending here.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'kind' => 'algo',
    'tags' => ['array', 'hash-table', 'sliding-window', 'leetcode'],
    'related_session' => 'count-the-number-of-good-subarrays',
];
