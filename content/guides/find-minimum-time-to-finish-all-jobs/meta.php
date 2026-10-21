<?php
declare(strict_types=1);

return [
    'title' => 'Find Minimum Time to Finish All Jobs: binary search plus backtracking',
    'leetcode' => 1723,
    'difficulty' => 'Hard',
    'summary' => 'Binary search the answer T. To test T, assign jobs (largest first) to workers with backtracking, skipping workers whose current load was already tried at this depth.',
    'category' => 'LeetCode',
    'subcategory' => 'Backtracking',
    'topic' => 'LeetCode · Backtracking',
    'kind' => 'algo',
    'tags' => ['backtracking', 'binary-search', 'bitmask', 'leetcode'],
    'related_session' => 'find-minimum-time-to-finish-all-jobs',
];
