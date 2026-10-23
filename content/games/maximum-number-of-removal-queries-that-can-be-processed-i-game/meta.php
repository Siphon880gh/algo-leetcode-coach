<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Removal Queries I: which ends have been removed?',
    'leetcode' => 3018,
    'difficulty' => 'Hard',
    'summary' => 'dp[i][j] = most queries processed when nums[i..j] remain (removing only from the ends). Coming from [i−1, j] removes nums[i−1] (counts if it is ≥ the next query); from [i, j+1] removes nums[j+1]. Finish with one last element.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-number-of-removal-queries-that-can-be-processed-i',
    'related_session' => 'maximum-number-of-removal-queries-that-can-be-processed-i',
];
