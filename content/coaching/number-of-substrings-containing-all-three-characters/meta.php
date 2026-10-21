<?php
declare(strict_types=1);

return [
    'title' => 'Number of Substrings Containing All Three Characters: last positions',
    'leetcode' => 1358,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: track the last index of a, b, and c, and for each end add min(last) + 1 valid starts. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'related_guide' => 'number-of-substrings-containing-all-three-characters',
    'tags' => ['sliding-window', 'strings', 'step-by-step'],
];
