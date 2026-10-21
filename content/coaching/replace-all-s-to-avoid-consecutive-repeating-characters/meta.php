<?php
declare(strict_types=1);

return [
    'title' => 'Replace All ?\'s to Avoid Consecutive Repeats: three letters suffice',
    'leetcode' => 1576,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: scan left to right; for each ?, pick the first of a, b, c that differs from both neighbours (the left one already resolved). Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Strings',
    'topic' => 'LeetCode · Strings',
    'related_guide' => 'replace-all-s-to-avoid-consecutive-repeating-characters',
    'tags' => ['strings', 'greedy', 'step-by-step'],
];
