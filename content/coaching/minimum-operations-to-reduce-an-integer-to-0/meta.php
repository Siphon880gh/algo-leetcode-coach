<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Operations to Reduce an Integer to 0: add on 11, subtract on 01',
    'leetcode' => 2571,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: add 1 when the low bits are 11, and subtract 1 for a lone low 1. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'related_guide' => 'minimum-operations-to-reduce-an-integer-to-0',
    'tags' => ['dynamic-programming', 'greedy', 'bit-manipulation', 'step-by-step'],
];
