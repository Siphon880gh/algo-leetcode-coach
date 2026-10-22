<?php
declare(strict_types=1);

return [
    'title' => 'Count the Number of Square-Free Subsets: skip squares, double for ones',
    'leetcode' => 2572,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: drop values divisible by a square, and give the 1s a factor of 2 to the power of their count. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Bitmask DP',
    'topic' => 'LeetCode · Bitmask DP',
    'related_guide' => 'count-the-number-of-square-free-subsets',
    'tags' => ['array', 'math', 'dynamic-programming', 'bit-manipulation', 'bitmask', 'step-by-step'],
];
