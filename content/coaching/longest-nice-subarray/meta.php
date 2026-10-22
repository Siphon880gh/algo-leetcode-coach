<?php
declare(strict_types=1);

return [
    'title' => 'Longest Nice Subarray: no shared bit in the window, shrink from the left, while not if',
    'leetcode' => 2401,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: test a new number against the whole window, drop numbers from the left instead of restarting, and keep dropping until no bit is shared. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'related_guide' => 'longest-nice-subarray',
    'tags' => ['array', 'bit-manipulation', 'sliding-window', 'step-by-step'],
];
