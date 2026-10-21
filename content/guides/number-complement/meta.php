<?php
declare(strict_types=1);

return [
    'title' => 'Number Complement: XOR with an all-ones mask of the same length',
    'leetcode' => 476,
    'difficulty' => 'Easy',
    'summary' => 'Flip every bit of num’s binary form, ignoring leading zeros. Build mask = 2^(bit length) − 1 (all ones as wide as num) and return num XOR mask. 5 (101) → 2 (010). 1 → 0. Do not use ~num alone — it flips the leading zeros too. Same as 1009.',
    'category' => 'LeetCode',
    'subcategory' => 'Bit Manipulation',
    'topic' => 'LeetCode · Bit Manipulation',
    'kind' => 'algo',
    'tags' => ['bit-manipulation', 'leetcode'],
    'related_session' => 'number-complement',
];
