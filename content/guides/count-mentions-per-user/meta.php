<?php
declare(strict_types=1);

return [
    'title' => 'Count Mentions Per User: sort events, offline first on ties',
    'leetcode' => 3433,
    'difficulty' => 'Med',
    'summary' => 'Sort events by timestamp, with OFFLINE before MESSAGE at the same time. Store when each user is back online (offline time + 60); HERE counts users whose return time is at most the message time.',
    'category' => 'LeetCode',
    'subcategory' => 'Simulation',
    'topic' => 'LeetCode · Simulation',
    'kind' => 'algo',
    'tags' => ['array', 'math', 'sorting', 'simulation', 'leetcode'],
    'related_session' => 'count-mentions-per-user',
];
