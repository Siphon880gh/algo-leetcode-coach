<?php
declare(strict_types=1);

return [
    'title' => 'Maximize Score After N Operations: bitmask DP',
    'leetcode' => 1799,
    'difficulty' => 'Hard',
    'summary' => 'dp[mask] = best score after removing the elements in mask (an even count). The next operation index is popcount / 2 + 1; pair the lowest unused element with every other unused one.',
    'category' => 'LeetCode',
    'subcategory' => 'Bitmask DP',
    'topic' => 'LeetCode · Bitmask DP',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'bitmask', 'math', 'leetcode'],
    'related_session' => 'maximize-score-after-n-operations',
];
