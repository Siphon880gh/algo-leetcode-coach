<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Window Subsequence: forward, then backward',
    'leetcode' => 727,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: scan forward to complete s2, scan backward to the tightest start, record the window, and restart after that start. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Two Pointers',
    'topic' => 'LeetCode · Two Pointers',
    'related_guide' => 'minimum-window-subsequence',
    'tags' => ['two-pointers', 'dynamic-programming', 'strings', 'sliding-window', 'step-by-step'],
];
