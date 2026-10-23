<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Average Subarray II: search the average',
    'leetcode' => 644,
    'difficulty' => 'Hard',
    'summary' => 'Binary search avg m: subtract m from every value; a subarray of length ≥ k with average ≥ m exists iff some prefix[j] − min(prefix[i], i ≤ j − k) ≥ 0.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'tags' => ['binary-search', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-average-subarray-ii',
    'related_session' => 'maximum-average-subarray-ii',
];
