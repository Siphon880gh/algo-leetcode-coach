<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Difficulty of a Job Schedule: where does the last day start?',
    'leetcode' => 1335,
    'difficulty' => 'Hard',
    'summary' => 'dp[d][i] = least difficulty doing the first i jobs in d days = min over j of dp[d−1][j] + max(jobs j to i−1). Fewer jobs than days: −1.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-difficulty-of-a-job-schedule',
    'related_session' => 'minimum-difficulty-of-a-job-schedule',
];
