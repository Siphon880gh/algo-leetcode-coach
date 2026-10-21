<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Skips to Arrive at Meeting on Time: DP in integer units',
    'leetcode' => 1883,
    'difficulty' => 'Hard',
    'summary' => 'dp[k] = earliest arrival after the roads so far using k skips, measured in distance units (time × speed) to stay exact. Resting rounds up to a multiple of speed; skipping does not. Return the smallest k with dp[k] ≤ hoursBefore · speed.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'leetcode'],
    'related_session' => 'minimum-skips-to-arrive-at-meeting-on-time',
];
