<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Requests Without Violating the Limit: greedy per user',
    'leetcode' => 3851,
    'difficulty' => 'Med',
    'summary' => 'Handle each user on their own. Sort their times and keep a request whenever fewer than k kept requests fall in the window ending at it; otherwise drop it. Dropping the later request is never worse.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'kind' => 'algo',
    'tags' => ['greedy', 'array', 'hash-table', 'sorting', 'sliding-window', 'leetcode'],
    'related_session' => 'maximum-requests-without-violating-the-limit',
];
