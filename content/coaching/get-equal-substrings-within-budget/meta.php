<?php
declare(strict_types=1);

return [
    'title' => 'Get Equal Substrings Within Budget: shrinking window',
    'leetcode' => 1208,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: cost per index is |s[i] − t[i]|, grow the window right, shrink from the left while over budget, and track the longest. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'related_guide' => 'get-equal-substrings-within-budget',
    'tags' => ['sliding-window', 'strings', 'step-by-step'],
];
