<?php
declare(strict_types=1);

return [
    'title' => 'Make the Prefix Sum Non-negative: move the most negative, include the current one',
    'leetcode' => 2599,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: when the sum dips below 0, move the most negative value seen so far, counting the current one. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Heap',
    'topic' => 'LeetCode · Heap',
    'related_guide' => 'make-the-prefix-sum-non-negative',
    'tags' => ['array', 'greedy', 'heap', 'step-by-step'],
];
