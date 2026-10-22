<?php
declare(strict_types=1);

return [
    'title' => 'Largest Palindromic Number: no leading zeros, any odd digit in the middle, 0 if empty',
    'leetcode' => 2384,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: strip leading zeros from the half, pick the largest digit with an odd count as the middle, and return 0 when nothing is left. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'related_guide' => 'largest-palindromic-number',
    'tags' => ['hash-table', 'string', 'greedy', 'counting', 'step-by-step'],
];
