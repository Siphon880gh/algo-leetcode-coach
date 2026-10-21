<?php
declare(strict_types=1);

return [
    'title' => 'Sum of Square Numbers: squeeze from 0 and √c',
    'leetcode' => 633,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: two pointers a = 0 and b = ⌊√c⌋, raise a when the sum is small, lower b when big, and allow a = b. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Two Pointers',
    'topic' => 'LeetCode · Two Pointers',
    'related_guide' => 'sum-of-square-numbers',
    'tags' => ['two-pointers', 'math', 'binary-search', 'step-by-step'],
];
