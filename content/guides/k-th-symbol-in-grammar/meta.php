<?php
declare(strict_types=1);

return [
    'title' => 'K-th Symbol in Grammar: count the flips on the path',
    'leetcode' => 779,
    'difficulty' => 'Med',
    'summary' => 'Each row is the previous row with every 0 → 01 and 1 → 10, so position k comes from position ceil(k / 2) in the row above, flipped when k is even. The answer is the parity of the set bits of k − 1.',
    'category' => 'LeetCode',
    'subcategory' => 'Recursion',
    'topic' => 'LeetCode · Recursion',
    'kind' => 'algo',
    'tags' => ['recursion', 'bit-manipulation', 'math', 'leetcode'],
    'related_session' => 'k-th-symbol-in-grammar',
];
