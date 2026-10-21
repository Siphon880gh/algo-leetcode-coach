<?php
declare(strict_types=1);

return [
    'title' => 'Find K-Length Substrings With No Repeated Characters: window',
    'leetcode' => 1100,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: slide a window, shrink it while the new letter repeats or the window is longer than k, and count every window of exactly k letters. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'related_guide' => 'find-k-length-substrings-with-no-repeated-characters',
    'tags' => ['sliding-window', 'hash-table', 'strings', 'step-by-step'],
];
