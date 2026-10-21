<?php
declare(strict_types=1);

return [
    'title' => 'Max Consecutive Ones II: sliding window with at most one zero',
    'leetcode' => 487,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: longest run of 1s with at most one 0 flipped. Slide a window holding at most one zero; when a second zero enters, move the left edge past the earlier zero. [1,0,1,1,0] → 4. Streaming: keep only the last zero index. Not 485 / 1004. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'tags' => ['sliding-window', 'arrays', 'dynamic-programming', 'step-by-step'],
    'related_guide' => 'max-consecutive-ones-ii',
];
