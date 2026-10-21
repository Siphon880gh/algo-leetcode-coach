<?php
declare(strict_types=1);

return [
    'title' => 'Smallest Integer Divisible by K: remainders only',
    'leetcode' => 1015,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: rule out k divisible by 2 or 5, then grow the repunit through r = (r · 10 + 1) % k for at most k steps. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'related_guide' => 'smallest-integer-divisible-by-k',
    'tags' => ['math', 'hash-table', 'step-by-step'],
];
