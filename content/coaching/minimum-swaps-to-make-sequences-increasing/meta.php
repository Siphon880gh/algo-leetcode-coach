<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Swaps To Make Sequences Increasing: keep or swap',
    'leetcode' => 801,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: two DP states per index, transitions from the straight order and the crossed order, and the minimum at the end. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'minimum-swaps-to-make-sequences-increasing',
    'tags' => ['dynamic-programming', 'arrays', 'step-by-step'],
];
