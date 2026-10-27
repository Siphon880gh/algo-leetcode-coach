<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Requests Without Violating the Limit',
    'leetcode' => 3851,
    'difficulty' => 'Med',
    'summary' => 'Users are independent. Sort each user\'s times and keep greedily: a request is kept unless the kept requests in [time − window, time] already number k. Dropping the later one never hurts.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'tags' => ['sliding-window', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-requests-without-violating-the-limit',
    'related_session' => 'maximum-requests-without-violating-the-limit',
];
