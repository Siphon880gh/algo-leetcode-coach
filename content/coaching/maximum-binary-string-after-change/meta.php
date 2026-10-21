<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Binary String: the lone zero',
    'leetcode' => 1702,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: keep the leading ones; the zeros merge into a single 0 at index firstZero + zeros − 1; everything else becomes 1. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'related_guide' => 'maximum-binary-string-after-change',
    'tags' => ['greedy', 'string', 'step-by-step'],
];
