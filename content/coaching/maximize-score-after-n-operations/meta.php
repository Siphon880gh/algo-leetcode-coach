<?php
declare(strict_types=1);

return [
    'title' => 'Maximize Score After N Operations: bitmask DP',
    'leetcode' => 1799,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: dp over masks of removed elements; operation index = popcount / 2 + 1; pair the lowest unused element with each other unused one. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Bitmask DP',
    'topic' => 'LeetCode · Bitmask DP',
    'related_guide' => 'maximize-score-after-n-operations',
    'tags' => ['dynamic-programming', 'bitmask', 'math', 'step-by-step'],
];
