<?php
declare(strict_types=1);

return [
    'title' => 'Kth Smallest Instructions: count before choosing',
    'leetcode' => 1643,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: at each step, the number of strings starting with H is C(h − 1 + v, v); choose H if k fits, else V and subtract. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Combinatorics',
    'topic' => 'LeetCode · Combinatorics',
    'related_guide' => 'kth-smallest-instructions',
    'tags' => ['combinatorics', 'math', 'step-by-step'],
];
