<?php
declare(strict_types=1);

return [
    'title' => 'Number of Subarrays Having Even Product: starts up to the last even, begin at −1',
    'leetcode' => 2495,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: add last + 1 for each end, counting the starts that include an even number, and start last at −1. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'related_guide' => 'number-of-subarrays-having-even-product',
    'tags' => ['array', 'math', 'dynamic-programming', 'step-by-step'],
];
