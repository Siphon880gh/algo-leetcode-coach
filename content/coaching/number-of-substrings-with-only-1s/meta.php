<?php
declare(strict_types=1);

return [
    'title' => 'Number of Substrings With Only 1s: run lengths',
    'leetcode' => 1513,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: keep the current run of 1s and add it at each 1 (equivalently L(L+1)/2 per run), mod 1e9+7. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'related_guide' => 'number-of-substrings-with-only-1s',
    'tags' => ['math', 'strings', 'step-by-step'],
];
