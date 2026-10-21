<?php
declare(strict_types=1);

return [
    'title' => 'Matchsticks to Square: four buckets, longest first, prune hard',
    'leetcode' => 473,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: use every stick once to make a square. Total must divide by 4 and no stick may exceed the side. Sort descending and place each stick on one of 4 sides without overflowing; skip sides equal to an earlier one. [1,1,2,2,2] → true. [3,3,3,3,4] → false. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Backtracking',
    'topic' => 'LeetCode · Backtracking',
    'tags' => ['backtracking', 'bitmask', 'dynamic-programming', 'step-by-step'],
    'related_guide' => 'matchsticks-to-square',
];
