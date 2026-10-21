<?php
declare(strict_types=1);

return [
    'title' => 'Largest Number After Mutating Substring: start at the first gain',
    'leetcode' => 1946,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: skip until change[d] > d, then mutate while change[d] ≥ d. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'related_guide' => 'largest-number-after-mutating-substring',
    'tags' => ['greedy', 'string', 'step-by-step'],
];
