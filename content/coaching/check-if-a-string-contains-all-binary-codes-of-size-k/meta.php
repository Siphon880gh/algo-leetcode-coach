<?php
declare(strict_types=1);

return [
    'title' => 'All Binary Codes of Size K: distinct windows',
    'leetcode' => 1461,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: collect every length-k window (rolling k-bit hash) and compare the number of distinct ones to 2^k. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'related_guide' => 'check-if-a-string-contains-all-binary-codes-of-size-k',
    'tags' => ['hash-table', 'bit-manipulation', 'sliding-window', 'step-by-step'],
];
