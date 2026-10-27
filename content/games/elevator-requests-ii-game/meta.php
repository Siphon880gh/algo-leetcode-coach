<?php
declare(strict_types=1);

return [
    'title' => 'Elevator Requests II',
    'leetcode' => 4023,
    'difficulty' => 'Hard',
    'summary' => 'The served floors always form a contiguous range around the start in sorted order, so use interval DP: dp[l][r][side] = least penalty once requests l to r are served and the elevator stands at the left or right end. Each move costs its distance times the number of requests still waiting.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'elevator-requests-ii',
    'related_session' => 'elevator-requests-ii',
];
