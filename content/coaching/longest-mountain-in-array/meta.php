<?php
declare(strict_types=1);

return [
    'title' => 'Longest Mountain in Array: count the rise and the fall',
    'leetcode' => 845,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: track up and down lengths in one pass, reset when a new rise follows a fall or on equal neighbors, and record up + down + 1 when both are positive. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Two Pointers',
    'topic' => 'LeetCode · Two Pointers',
    'related_guide' => 'longest-mountain-in-array',
    'tags' => ['two-pointers', 'dynamic-programming', 'arrays', 'step-by-step'],
];
