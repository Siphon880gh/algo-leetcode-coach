<?php
declare(strict_types=1);

return [
    'title' => 'Building Boxes: fill a corner pyramid, then add a staircase',
    'leetcode' => 1739,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: take the largest k with k(k+1)(k+2)/6 ≤ n (floor k(k+1)/2), then add the smallest j floor boxes with j(j+1)/2 ≥ the remainder. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'related_guide' => 'building-boxes',
    'tags' => ['math', 'binary-search', 'greedy', 'step-by-step'],
];
