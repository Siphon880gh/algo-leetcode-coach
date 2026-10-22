<?php
declare(strict_types=1);

return [
    'title' => 'Minimize XOR: copy num1’s high bits, then fill low zeros',
    'leetcode' => 2429,
    'difficulty' => 'Med',
    'summary' => 'x needs as many set bits as num2. Spend them on num1’s own set bits from the highest down, which cancels the biggest terms of the XOR; any bits left over go into num1’s zero positions from the lowest up.',
    'category' => 'LeetCode',
    'subcategory' => 'Bit Manipulation',
    'topic' => 'LeetCode · Bit Manipulation',
    'kind' => 'algo',
    'tags' => ['greedy', 'bit-manipulation', 'leetcode'],
    'related_session' => 'minimize-xor',
];
