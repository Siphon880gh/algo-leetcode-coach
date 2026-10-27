<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Skips to Arrive on Time: time in units of 1 divided by speed',
    'leetcode' => 1883,
    'difficulty' => 'Hard',
    'summary' => 'Scale time by speed to stay in integers. dp[j] = least scaled time after these roads with j skips. Not skipping rounds up to the next multiple of speed; skipping does not. The answer is the least j with dp[j] at most hoursBefore times speed.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-skips-to-arrive-at-meeting-on-time',
    'related_session' => 'minimum-skips-to-arrive-at-meeting-on-time',
];
