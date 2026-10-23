<?php
declare(strict_types=1);

return [
    'title' => 'Find Minimum Time to Finish All Jobs',
    'leetcode' => 1723,
    'difficulty' => 'Hard',
    'summary' => 'Sort jobs descending and backtrack assigning each job to a worker; prune when a worker exceeds the best answer, and skip workers with the same current load (and stop after the first empty worker).',
    'category' => 'LeetCode',
    'subcategory' => 'Backtracking',
    'topic' => 'LeetCode · Backtracking',
    'tags' => ['backtracking', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'find-minimum-time-to-finish-all-jobs',
    'related_session' => 'find-minimum-time-to-finish-all-jobs',
];
