<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Work Sessions: bitmask of finished tasks',
    'leetcode' => 1986,
    'difficulty' => 'Med',
    'summary' => 'dp[mask] = (sessions, time used in the last session), smallest first. Adding a task fits in the current session if time + task at most sessionTime; otherwise it opens a new one.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-number-of-work-sessions-to-finish-the-tasks',
    'related_session' => 'minimum-number-of-work-sessions-to-finish-the-tasks',
];
