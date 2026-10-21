<?php
declare(strict_types=1);

return [
    'title' => 'Parse Lisp Expression: scopes on a stack',
    'leetcode' => 736,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: evaluate by form, push a scope for each let, assign pairs in order, and tell the body apart by what follows it. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Recursion',
    'topic' => 'LeetCode · Recursion',
    'related_guide' => 'parse-lisp-expression',
    'tags' => ['recursion', 'parsing', 'stack', 'hash-map', 'strings', 'step-by-step'],
];
