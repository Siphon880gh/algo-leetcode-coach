<?php
declare(strict_types=1);

return [
    'title' => 'Make the XOR of All Segments Equal to Zero: DP over position classes',
    'leetcode' => 1787,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: indices with equal i mod k must be equal; DP over the k classes with XOR states 0 … 1023, each class either taking a present value (size − count) or any value (size, from the best state). Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'make-the-xor-of-all-segments-equal-to-zero',
    'tags' => ['dynamic-programming', 'bit-manipulation', 'step-by-step'],
];
