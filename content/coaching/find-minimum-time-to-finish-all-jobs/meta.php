<?php
declare(strict_types=1);

return [
    'title' => 'Find Minimum Time to Finish All Jobs: subset DP per worker',
    'leetcode' => 1723,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: precompute the sum of every job subset; dp[i][mask] = best max load using i workers for mask, taking min over submasks s of max(dp[i − 1][mask ^ s], sum[s]). Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Backtracking',
    'topic' => 'LeetCode · Backtracking',
    'related_guide' => 'find-minimum-time-to-finish-all-jobs',
    'tags' => ['backtracking', 'binary-search', 'bitmask', 'step-by-step'],
];
