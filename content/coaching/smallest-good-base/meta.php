<?php
declare(strict_types=1);

return [
    'title' => 'Smallest Good Base: try digit counts from longest, solve for the base',
    'leetcode' => 483,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: smallest base k where n is all 1s. n = 1 + k + … + k^m. More digits means a smaller base, so try m from about 60 down to 2 and solve for k (binary search, or floor of the m-th root checked exactly). Fall back to n − 1. "13" → "3". "4681" → "8". Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'tags' => ['math', 'binary-search', 'step-by-step'],
    'related_guide' => 'smallest-good-base',
];
