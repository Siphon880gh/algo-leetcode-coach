<?php
declare(strict_types=1);

return [
    'title' => 'Sum of Subarray Minimums: count where each element is the minimum',
    'leetcode' => 907,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: arr[i] is the minimum of left · right subarrays, with left to the previous strictly smaller element and right to the next smaller-or-equal; monotonic stacks find both. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Monotonic Stack',
    'topic' => 'LeetCode · Monotonic Stack',
    'related_guide' => 'sum-of-subarray-minimums',
    'tags' => ['monotonic-stack', 'dynamic-programming', 'arrays', 'step-by-step'],
];
