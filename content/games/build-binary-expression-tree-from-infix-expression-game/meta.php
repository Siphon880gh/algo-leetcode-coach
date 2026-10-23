<?php
declare(strict_types=1);

return [
    'title' => 'Expression Tree From Infix: two stacks',
    'leetcode' => 1597,
    'difficulty' => 'Hard',
    'summary' => 'Shunting-yard: push operands as leaves; on an operator, first combine while the stack top has precedence ≥ it; "(" waits for ")"; combine = pop op and two nodes into a new node.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'tags' => ['tree', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'build-binary-expression-tree-from-infix-expression',
    'related_session' => 'build-binary-expression-tree-from-infix-expression',
];
