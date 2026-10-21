<?php
declare(strict_types=1);

return [
    'title' => 'Decrease Elements To Make Array Zigzag: try both parities',
    'leetcode' => 1144,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: for each choice of valley positions (even or odd), lower each valley below the smaller of its original neighbours, sum the cost, and take the cheaper choice. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'related_guide' => 'decrease-elements-to-make-array-zigzag',
    'tags' => ['greedy', 'arrays', 'step-by-step'],
];
