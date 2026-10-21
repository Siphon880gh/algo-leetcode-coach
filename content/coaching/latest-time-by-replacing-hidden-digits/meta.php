<?php
declare(strict_types=1);

return [
    'title' => 'Latest Time by Replacing Hidden Digits: greedy per position',
    'leetcode' => 1736,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: hour tens ? → 2 if the units digit is ? or ≤ 3, else 1; hour units ? → 3 after a 2, else 9; minutes ? → 5 and 9. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'related_guide' => 'latest-time-by-replacing-hidden-digits',
    'tags' => ['greedy', 'string', 'step-by-step'],
];
