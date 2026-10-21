<?php
declare(strict_types=1);

return [
    'title' => 'Kth Smallest Sum of a Matrix With Sorted Rows: fold rows, keep k',
    'leetcode' => 1439,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: start with sums = [0]; for each row, combine with every element and keep the k smallest. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Heap',
    'topic' => 'LeetCode · Heap',
    'related_guide' => 'find-the-kth-smallest-sum-of-a-matrix-with-sorted-rows',
    'tags' => ['heap', 'matrix', 'step-by-step'],
];
