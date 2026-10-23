<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Bitwise OR From Grid: clear bits from the top',
    'leetcode' => 3858,
    'difficulty' => 'Med',
    'summary' => 'Greedily try to keep each bit out of the answer, high to low. A bit can be excluded when every row still has a value avoiding all excluded bits. The answer is every bit not excluded.',
    'category' => 'LeetCode',
    'subcategory' => 'Bit Manipulation',
    'topic' => 'LeetCode · Bit Manipulation',
    'kind' => 'algo',
    'tags' => ['array', 'bit-manipulation', 'matrix', 'leetcode'],
    'related_session' => 'minimum-bitwise-or-from-grid',
];
