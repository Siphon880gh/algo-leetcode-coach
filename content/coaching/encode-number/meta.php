<?php
declare(strict_types=1);

return [
    'title' => 'Encode Number: num + 1 in binary, top bit dropped',
    'leetcode' => 1256,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: notice codes are ordered by length then value, add 1 to num, convert to binary, and drop the first bit. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Bit Manipulation',
    'topic' => 'LeetCode · Bit Manipulation',
    'related_guide' => 'encode-number',
    'tags' => ['bit-manipulation', 'math', 'strings', 'step-by-step'],
];
