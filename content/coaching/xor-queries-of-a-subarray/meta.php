<?php
declare(strict_types=1);

return [
    'title' => 'XOR Queries of a Subarray: prefix XOR',
    'leetcode' => 1310,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: build p with p[i + 1] = p[i] ^ arr[i], and answer [l, r] as p[r + 1] ^ p[l]. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Prefix Sum',
    'topic' => 'LeetCode · Prefix Sum',
    'related_guide' => 'xor-queries-of-a-subarray',
    'tags' => ['prefix-sum', 'bit-manipulation', 'step-by-step'],
];
