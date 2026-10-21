<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Cost to Change the Final Value of Expression: (value, flip cost)',
    'leetcode' => 1896,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: carry (value, cost) per operand, combine left to right using the operator rules, use a stack for parentheses. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Stack',
    'topic' => 'LeetCode · Stack',
    'related_guide' => 'minimum-cost-to-change-the-final-value-of-expression',
    'tags' => ['stack', 'dynamic-programming', 'string', 'step-by-step'],
];
