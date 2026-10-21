<?php
declare(strict_types=1);

return [
    'title' => 'Odd Even Jump: next-jump tables and DP from the right',
    'leetcode' => 975,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: precompute each index\'s odd-jump and even-jump target with sorted order and a stack, then fill odd[i] = even[odd target], even[i] = odd[even target] from the right. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'odd-even-jump',
    'tags' => ['dynamic-programming', 'monotonic-stack', 'sorting', 'step-by-step'],
];
