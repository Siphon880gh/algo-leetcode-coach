<?php
declare(strict_types=1);

return [
    'title' => 'Parse Lisp Expression',
    'leetcode' => 736,
    'difficulty' => 'Hard',
    'summary' => 'Recursive evaluation with a stack of scopes. A number evaluates to itself, a variable to the innermost binding; "add" and "mult" evaluate both operands; "let" pushes a scope, assigns pairs in order, evaluates the final expression, then pops.',
    'category' => 'LeetCode',
    'subcategory' => 'Stack',
    'topic' => 'LeetCode · Stack',
    'tags' => ['stack', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'parse-lisp-expression',
    'related_session' => 'parse-lisp-expression',
];
