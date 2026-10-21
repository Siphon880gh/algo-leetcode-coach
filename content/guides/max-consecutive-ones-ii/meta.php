<?php
declare(strict_types=1);

return [
    'title' => 'Max Consecutive Ones II: sliding window with at most one zero',
    'leetcode' => 487,
    'difficulty' => 'Med',
    'summary' => 'Longest run of 1s if you may flip at most one 0. Slide a window and count zeros inside; when the count passes 1, move the left edge past the earlier zero. The widest window is the answer. [1,0,1,1,0] → 4. [1,0,1,1,0,1] → 4. Streaming follow-up: remember only the last zero’s index. Not 485 / 1004.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'kind' => 'algo',
    'tags' => ['sliding-window', 'arrays', 'dynamic-programming', 'leetcode'],
    'related_session' => 'max-consecutive-ones-ii',
];
