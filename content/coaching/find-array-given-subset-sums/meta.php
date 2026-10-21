<?php
declare(strict_types=1);

return [
    'title' => 'Find Array Given Subset Sums: peel one element per round',
    'leetcode' => 1982,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: d = s[1] − s[0], pair x with x + d, keep the side containing 0, record ±d. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Divide and Conquer',
    'topic' => 'LeetCode · Divide and Conquer',
    'related_guide' => 'find-array-given-subset-sums',
    'tags' => ['divide-and-conquer', 'array', 'sorting', 'step-by-step'],
];
