<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Cost to Flip an Expression: value and flip cost per subexpression',
    'leetcode' => 1896,
    'difficulty' => 'Hard',
    'summary' => 'Each operand carries (value, cost to flip). &: 1&1 → (1, min), 0&0 → (0, min + 1), mixed → (0, 1). |: 0|0 → (0, min), 1|1 → (1, min + 1), mixed → (1, 1). Evaluate left to right with a stack for parentheses.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-cost-to-change-the-final-value-of-expression',
    'related_session' => 'minimum-cost-to-change-the-final-value-of-expression',
];
