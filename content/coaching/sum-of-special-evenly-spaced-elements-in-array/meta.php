<?php
declare(strict_types=1);

return [
    'title' => 'Evenly-Spaced Sums: split by step size',
    'leetcode' => 1714,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: large steps (y ≥ √n) are walked directly; small steps use suffix sums suf[i] = nums[i] + suf[i + y], built once per distinct small y. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'sum-of-special-evenly-spaced-elements-in-array',
    'tags' => ['dynamic-programming', 'sqrt-decomposition', 'array', 'step-by-step'],
];
