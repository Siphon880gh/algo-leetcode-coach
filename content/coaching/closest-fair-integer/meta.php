<?php
declare(strict_types=1);

return [
    'title' => 'Closest Fair Integer: skip odd lengths, 0s before 1s, 1 then 0s then 1s',
    'leetcode' => 2417,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: jump past odd lengths, fill after the raised digit with 0s before 1s, and build the longer answer as 1, zeros, then ones. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'related_guide' => 'closest-fair-integer',
    'tags' => ['math', 'enumeration', 'step-by-step'],
];
