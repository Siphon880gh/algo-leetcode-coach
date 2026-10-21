<?php
declare(strict_types=1);

return [
    'title' => 'Number of Ways to Stay in the Same Place After Some Steps: capped DP',
    'leetcode' => 1269,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: dp over positions, where each step stays, moves left, or moves right, and cap positions at min(arrLen, steps / 2 + 1) because you must walk back. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'number-of-ways-to-stay-in-the-same-place-after-some-steps',
    'tags' => ['dynamic-programming', 'step-by-step'],
];
