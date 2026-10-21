<?php
declare(strict_types=1);

return [
    'title' => 'IP to CIDR: largest aligned block that fits',
    'leetcode' => 751,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: work with the IP as an integer, take the lowest set bit as the biggest aligned block, shrink it to fit n, and advance. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Bit Manipulation',
    'topic' => 'LeetCode · Bit Manipulation',
    'related_guide' => 'ip-to-cidr',
    'tags' => ['bit-manipulation', 'math', 'strings', 'step-by-step'],
];
