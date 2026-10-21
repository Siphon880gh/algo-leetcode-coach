<?php
declare(strict_types=1);

return [
    'title' => 'Parsing A Boolean Expression: reduce at each )',
    'leetcode' => 1106,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: push characters except commas, and on each closing parenthesis pop values back to the opening one, apply the operator below it, and push the result. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Stack',
    'topic' => 'LeetCode · Stack',
    'related_guide' => 'parsing-a-boolean-expression',
    'tags' => ['stack', 'strings', 'recursion', 'step-by-step'],
];
