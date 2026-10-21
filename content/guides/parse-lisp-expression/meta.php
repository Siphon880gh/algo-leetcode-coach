<?php
declare(strict_types=1);

return [
    'title' => 'Parse Lisp Expression: recursive evaluation with a scope stack',
    'leetcode' => 736,
    'difficulty' => 'Hard',
    'summary' => 'Tokenize, then evaluate recursively. Numbers return themselves, variables look up the innermost scope, add and mult evaluate two operands, and let pushes a new scope, assigns pairs in order, and evaluates its last expression.',
    'category' => 'LeetCode',
    'subcategory' => 'Recursion',
    'topic' => 'LeetCode · Recursion',
    'kind' => 'algo',
    'tags' => ['recursion', 'parsing', 'stack', 'hash-map', 'strings', 'leetcode'],
    'related_session' => 'parse-lisp-expression',
];
