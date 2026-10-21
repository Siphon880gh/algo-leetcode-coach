<?php
declare(strict_types=1);

return [
    'title' => 'Number Complement: XOR with an all-ones mask of the same length',
    'leetcode' => 476,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: flip every bit of num’s binary form, ignoring leading zeros. mask = 2^(bit length) − 1, answer = num XOR mask. 5 (101) → 2 (010). 1 → 0. Not ~num alone. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Bit Manipulation',
    'topic' => 'LeetCode · Bit Manipulation',
    'tags' => ['bit-manipulation', 'step-by-step'],
    'related_guide' => 'number-complement',
];
