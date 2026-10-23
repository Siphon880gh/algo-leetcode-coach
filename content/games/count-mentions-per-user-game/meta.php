<?php
declare(strict_types=1);

return [
    'title' => 'Count Mentions per User: process events in time order',
    'leetcode' => 3433,
    'difficulty' => 'Med',
    'summary' => 'Sort events by timestamp, with OFFLINE before MESSAGE at the same time. OFFLINE marks a user offline until t + 60. "ALL" mentions everyone, "HERE" only online users, and idX tokens mention that user (repeats count).',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'tags' => ['math', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'count-mentions-per-user',
    'related_session' => 'count-mentions-per-user',
];
