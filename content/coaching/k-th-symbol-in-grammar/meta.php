<?php
declare(strict_types=1);

return [
    'title' => 'K-th Symbol in Grammar: parity of the path',
    'leetcode' => 779,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: each position comes from its parent in the row above, flipping on the second child, so the answer is the parity of popcount(k − 1). Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Recursion',
    'topic' => 'LeetCode · Recursion',
    'related_guide' => 'k-th-symbol-in-grammar',
    'tags' => ['recursion', 'bit-manipulation', 'math', 'step-by-step'],
];
