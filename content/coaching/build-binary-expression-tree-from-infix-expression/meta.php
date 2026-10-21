<?php
declare(strict_types=1);

return [
    'title' => 'Build Expression Tree From Infix: shunting-yard',
    'leetcode' => 1597,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: operand stack of nodes and operator stack; on an operator pop while the top has precedence ≥ it; parentheses bracket the popping. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Stack',
    'topic' => 'LeetCode · Stack',
    'related_guide' => 'build-binary-expression-tree-from-infix-expression',
    'tags' => ['stack', 'tree', 'string', 'step-by-step'],
];
