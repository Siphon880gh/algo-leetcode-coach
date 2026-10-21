<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Consecutive Cards to Pick Up: nearest repeat',
    'leetcode' => 2260,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: measure i − last + 1, store the newest index of each value, and return −1 with no pair. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'related_guide' => 'minimum-consecutive-cards-to-pick-up',
    'tags' => ['array', 'hash-table', 'sliding-window', 'step-by-step'],
];
