<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Moves to Pick K Ones',
    'leetcode' => 3086,
    'difficulty' => 'Hard',
    'summary' => 'Ones at Alice\'s index cost 0, at a neighbor 1, a created one costs 2 (change + swap). Ones further away cost their distance. If changes cover the rest after the best 3-cell neighborhood, use them; otherwise take k − maxChanges real ones by a median-centered window and add 2 per change.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'tags' => ['sliding-window', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-moves-to-pick-k-ones',
    'related_session' => 'minimum-moves-to-pick-k-ones',
];
