<?php
declare(strict_types=1);

return [
    'title' => 'Smallest Sufficient Team: DP over skill masks',
    'leetcode' => 1125,
    'difficulty' => 'Hard',
    'summary' => 'There are at most 16 skills, so a bitmask fits all of them. dp[mask] is the smallest team covering mask; each person extends every reachable mask with their own skills.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'bitmask', 'leetcode'],
    'related_session' => 'smallest-sufficient-team',
];
