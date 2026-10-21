<?php
declare(strict_types=1);

return [
    'title' => 'Count Negative Numbers in a Sorted Matrix: staircase',
    'leetcode' => 1351,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: start at the bottom-left; a negative value means the rest of the row is negative, so add it and move up; otherwise move right. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Matrix',
    'topic' => 'LeetCode · Matrix',
    'related_guide' => 'count-negative-numbers-in-a-sorted-matrix',
    'tags' => ['matrix', 'two-pointers', 'step-by-step'],
];
