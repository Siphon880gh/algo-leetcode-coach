<?php
declare(strict_types=1);

return [
    'title' => 'Maximize Win From Two Segments: best before l, shrink on > k',
    'leetcode' => 2555,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: pair each window with the best segment ending before its left end, and shrink only while the width exceeds k. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'related_guide' => 'maximize-win-from-two-segments',
    'tags' => ['array', 'binary-search', 'sliding-window', 'step-by-step'],
];
