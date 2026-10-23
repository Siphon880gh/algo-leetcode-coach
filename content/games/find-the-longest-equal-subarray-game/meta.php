<?php
declare(strict_types=1);

return [
    'title' => 'Longest Equal Subarray After k Deletions',
    'leetcode' => 2831,
    'difficulty' => 'Med',
    'summary' => 'For each value, take its positions. A window of positions [i..j] needs (pos[j] − pos[i] + 1) − (j − i + 1) deletions; slide while ≤ k.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'tags' => ['binary-search', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'find-the-longest-equal-subarray',
    'related_session' => 'find-the-longest-equal-subarray',
];
