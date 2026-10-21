<?php
declare(strict_types=1);

return [
    'title' => 'Max Value of Equation: deque on y − x',
    'leetcode' => 1499,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: rewrite as (yi − xi) + (yj + xj); for each j, drop points with xj − xi > k from the front, use the front, then push (y − x) keeping the deque decreasing. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'related_guide' => 'max-value-of-equation',
    'tags' => ['monotonic-queue', 'sliding-window', 'heap', 'step-by-step'],
];
