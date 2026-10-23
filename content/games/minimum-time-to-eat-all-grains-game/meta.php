<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Time to Eat All Grains',
    'leetcode' => 2604,
    'difficulty' => 'Hard',
    'summary' => 'Binary search time t. Greedily give each hen (left to right) the leftmost uneaten grain: if it is to the left at distance d ≤ t, the hen can still reach max(t − 2d, (t − d)/2) to the right.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'tags' => ['binary-search', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-time-to-eat-all-grains',
    'related_session' => 'minimum-time-to-eat-all-grains',
];
