<?php
declare(strict_types=1);

return [
    'title' => 'Find All Good Indices: runs end at i − 1 and start at i + 1, non-strict, precompute',
    'leetcode' => 2420,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: leave index i out of both windows, let equal neighbours keep a run going, and precompute run lengths. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Prefix Sum',
    'topic' => 'LeetCode · Prefix Sum',
    'related_guide' => 'find-all-good-indices',
    'tags' => ['array', 'dynamic-programming', 'prefix-sum', 'step-by-step'],
];
