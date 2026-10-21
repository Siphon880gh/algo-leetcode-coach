<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Number of Lines to Cover Points: cover collinear points at once',
    'leetcode' => 2152,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: a lone point still needs a line, collinearity is tested with integer cross products, and each line takes every collinear uncovered point. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'minimum-number-of-lines-to-cover-points',
    'tags' => ['dynamic-programming', 'bit-manipulation', 'geometry', 'step-by-step'],
];
