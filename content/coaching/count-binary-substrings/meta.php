<?php
declare(strict_types=1);

return [
    'title' => 'Count Binary Substrings: neighboring runs',
    'leetcode' => 696,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: compress into run lengths, add min(prev, cur) at every border, and keep only two counters. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Strings',
    'topic' => 'LeetCode · Strings',
    'related_guide' => 'count-binary-substrings',
    'tags' => ['strings', 'two-pointers', 'step-by-step'],
];
