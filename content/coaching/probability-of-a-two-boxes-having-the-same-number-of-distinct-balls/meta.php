<?php
declare(strict_types=1);

return [
    'title' => 'Two Boxes, Same Distinct Count: weighted split search',
    'leetcode' => 1467,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: for each colour pick x balls for box 1 with weight C(count, x); count weighted splits with half the balls per box and equal distinct colours; divide by C(total, total/2). Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'related_guide' => 'probability-of-a-two-boxes-having-the-same-number-of-distinct-balls',
    'tags' => ['math', 'combinatorics', 'backtracking', 'step-by-step'],
];
